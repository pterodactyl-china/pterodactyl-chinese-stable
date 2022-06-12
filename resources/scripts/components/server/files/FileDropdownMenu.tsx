import React, { memo, useRef, useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
    faBoxOpen,
    faCopy,
    faEllipsisH,
    faFileArchive,
    faFileCode,
    faFileDownload,
    faLevelUpAlt,
    faPencilAlt,
    faTrashAlt,
    IconDefinition,
} from '@fortawesome/free-solid-svg-icons';
import RenameFileModal from '@/components/server/files/RenameFileModal';
import { ServerContext } from '@/state/server';
import { join } from 'path';
import deleteFiles from '@/api/server/files/deleteFiles';
import SpinnerOverlay from '@/components/elements/SpinnerOverlay';
import copyFile from '@/api/server/files/copyFile';
import Can from '@/components/elements/Can';
import getFileDownloadUrl from '@/api/server/files/getFileDownloadUrl';
import useFlash from '@/plugins/useFlash';
import tw from 'twin.macro';
import { FileObject } from '@/api/server/files/loadDirectory';
import useFileManagerSwr from '@/plugins/useFileManagerSwr';
import DropdownMenu from '@/components/elements/DropdownMenu';
import styled from 'styled-components/macro';
import useEventListener from '@/plugins/useEventListener';
import compressFiles from '@/api/server/files/compressFiles';
import decompressFiles from '@/api/server/files/decompressFiles';
import isEqual from 'react-fast-compare';
import ConfirmationModal from '@/components/elements/ConfirmationModal';
import ChmodFileModal from '@/components/server/files/ChmodFileModal';

type ModalType = 'rename' | 'move' | 'chmod';

const StyledRow = styled.div<{ $danger?: boolean }>`
    ${tw`p-2 flex items-center rounded`};
    ${props => props.$danger ? tw`hover:bg-red-100 hover:text-red-700` : tw`hover:bg-neutral-100 hover:text-neutral-700`};
`;

interface RowProps extends React.HTMLAttributes<HTMLDivElement> {
    icon: IconDefinition;
    title: string;
    $danger?: boolean;
}

const Row = ({ icon, title, ...props }: RowProps) => (
    <StyledRow {...props}>
        <FontAwesomeIcon icon={icon} css={tw`text-xs`} fixedWidth/>
        <span css={tw`ml-2`}>{title}</span>
    </StyledRow>
);

const FileDropdownMenu = ({ file }: { file: FileObject }) => {
    const onClickRef = useRef<DropdownMenu>(null);
    const [ showSpinner, setShowSpinner ] = useState(false);
    const [ modal, setModal ] = useState<ModalType | null>(null);
    const [ showConfirmation, setShowConfirmation ] = useState(false);

    const uuid = ServerContext.useStoreState(state => state.server.data!.uuid);
    const { mutate } = useFileManagerSwr();
    const { clearAndAddHttpError, clearFlashes } = useFlash();
    const directory = ServerContext.useStoreState(state => state.files.directory);

    useEventListener(`pterodactyl:files:ctx:${file.key}`, (e: CustomEvent) => {
        if (onClickRef.current) {
            onClickRef.current.triggerMenu(e.detail);
        }
    });

    const doDeletion = () => {
        clearFlashes('files');

        // For UI speed, immediately remove the file from the listing before calling the deletion function.
        // If the delete actually fails, we'll fetch the current directory contents again automatically.
        mutate(files => files.filter(f => f.key !== file.key), false);

        deleteFiles(uuid, directory, [ file.name ]).catch(error => {
            mutate();
            clearAndAddHttpError({ key: 'files', error });
        });
    };

    const doCopy = () => {
        setShowSpinner(true);
        clearFlashes('files');

        copyFile(uuid, join(directory, file.name))
            .then(() => mutate())
            .catch(error => clearAndAddHttpError({ key: 'files', error }))
            .then(() => setShowSpinner(false));
    };

    const doDownload = () => {
        setShowSpinner(true);
        clearFlashes('files');

        getFileDownloadUrl(uuid, join(directory, file.name))
            .then(url => {
                // @ts-ignore
                window.location = url;
            })
            .catch(error => clearAndAddHttpError({ key: 'files', error }))
            .then(() => setShowSpinner(false));
    };

    const doArchive = () => {
        setShowSpinner(true);
        clearFlashes('files');

        compressFiles(uuid, directory, [ file.name ])
            .then(() => mutate())
            .catch(error => clearAndAddHttpError({ key: 'files', error }))
            .then(() => setShowSpinner(false));
    };

    const doUnarchive = () => {
        setShowSpinner(true);
        clearFlashes('files');

        decompressFiles(uuid, directory, file.name)
            .then(() => mutate())
            .catch(error => clearAndAddHttpError({ key: 'files', error }))
            .then(() => setShowSpinner(false));
    };

    return (
        <>
            <ConfirmationModal
                visible={showConfirmation}
                title={`删除文件 ${file.isFile ? '文件' : '目录'}?`}
                buttonText={`是,删除 ${file.isFile ? '文件' : '目录'}`}
                onConfirmed={doDeletion}
                onModalDismissed={() => setShowConfirmation(false)}
            >
                删除文件是永久性操作，您无法撤消此操作。
            </ConfirmationModal>
            <DropdownMenu
                ref={onClickRef}
                renderToggle={onClick => (
                    <div css={tw`p-3 hover:text-white`} onClick={onClick}>
                        <FontAwesomeIcon icon={faEllipsisH}/>
                        {modal ?
                            modal === 'chmod' ?
                                <ChmodFileModal
                                    visible
                                    appear
                                    files={[ { file: file.name, mode: file.modeBits } ]}
                                    onDismissed={() => setModal(null)}
                                />
                                :
                                <RenameFileModal
                                    visible
                                    appear
                                    files={[ file.name ]}
                                    useMoveTerminology={modal === 'move'}
                                    onDismissed={() => setModal(null)}
                                />
                            : null
                        }
                        <SpinnerOverlay visible={showSpinner} fixed size={'large'}/>
                    </div>
                )}
            >
                <Can action={'file.update'}>
                    <Row onClick={() => setModal('rename')} icon={faPencilAlt} title={'重命名'}/>
                    <Row onClick={() => setModal('move')} icon={faLevelUpAlt} title={'移动'}/>
                    <Row onClick={() => setModal('chmod')} icon={faFileCode} title={'权限'}/>
                </Can>
                {file.isFile &&
                <Can action={'file.create'}>
                    <Row onClick={doCopy} icon={faCopy} title={'复制'}/>
                </Can>
                }
                {file.isArchiveType() ?
                    <Can action={'file.create'}>
                        <Row onClick={doUnarchive} icon={faBoxOpen} title={'解压'}/>
                    </Can>
                    :
                    <Can action={'file.archive'}>
                        <Row onClick={doArchive} icon={faFileArchive} title={'压缩'}/>
                    </Can>
                }
                {file.isFile &&
                    <Row onClick={doDownload} icon={faFileDownload} title={'下载'}/>
                }
                <Can action={'file.delete'}>
                    <Row onClick={() => setShowConfirmation(true)} icon={faTrashAlt} title={'删除'} $danger/>
                </Can>
            </DropdownMenu>
        </>
    );
};

export default memo(FileDropdownMenu, isEqual);