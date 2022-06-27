`import React, { memo } from 'react';
import { ServerContext } from '@/state/server';
import Can from '@/components/elements/Can';
import ContentContainer from '@/components/elements/ContentContainer';
import tw from 'twin.macro';
import ServerContentBlock from '@/components/elements/ServerContentBlock';
import isEqual from 'react-fast-compare';
import Spinner from '@/components/elements/Spinner';
import Features from '@feature/Features';
import Console from '@/components/server/console/Console';
import StatGraphs from '@/components/server/console/StatGraphs';
import PowerButtons from '@/components/server/console/PowerButtons';
import ServerDetailsBlock from '@/components/server/console/ServerDetailsBlock';

export type PowerAction = 'start' | 'stop' | 'restart' | 'kill';

const ServerConsoleContainer = () => {
    const name = ServerContext.useStoreState((state) => state.server.data!.name);
    const description = ServerContext.useStoreState((state) => state.server.data!.description);
    const isInstalling = ServerContext.useStoreState((state) => state.server.data!.isInstalling);
    const isTransferring = ServerContext.useStoreState((state) => state.server.data!.isTransferring);
    const eggFeatures = ServerContext.useStoreState((state) => state.server.data!.eggFeatures, isEqual);

    return (
        <ServerContentBlock title={'控制台'} className={'flex flex-col gap-2 sm:gap-4'}>
            <div className={'flex gap-4 items-end'}>
                <div className={'hidden sm:block flex-1'}>
                    <h1 className={'font-header text-2xl text-gray-50 leading-relaxed line-clamp-1'}>{name}</h1>
                    <p className={'text-sm line-clamp-2'}>{description}</p>
                </div>
                <div className={'flex-1'}>
                    <Can action={['control.start', 'control.stop', 'control.restart']} matchAny>
                        <PowerButtons className={'flex sm:justify-end space-x-2'} />
                    </Can>
                </div>
            </div>
            <div className={'grid grid-cols-4 gap-2 sm:gap-4'}>
                <ServerDetailsBlock className={'col-span-4 lg:col-span-1 order-last lg:order-none'} />
                <div className={'col-span-4 lg:col-span-3'}>
                    <Spinner.Suspense>
                        <Console />
                    </Spinner.Suspense>
                </div>
                {isInstalling ? (
                    <div css={tw`mt-4 rounded bg-yellow-500 p-3`}>
                        <ContentContainer>
                            <p css={tw`text-sm text-yellow-900`}>
                                此服务器实例当前正在运行其安装过程，大多数操作都是
                                不可用的。
                            </p>
                        </ContentContainer>
                    </div>
                ) : isTransferring ? (
                    <div css={tw`mt-4 rounded bg-yellow-500 p-3`}>
                        <ContentContainer>
                            <p css={tw`text-sm text-yellow-900`}>
                                此服务器实例当前正在转移到另一个节点服务器，所有操作
                                都不可用。
                            </p>
                        </ContentContainer>
                    </div>
                ) : null}
            </div>
            <div className={'grid grid-cols-1 md:grid-cols-3 gap-2 sm:gap-4'}>
                <Spinner.Suspense>
                    <StatGraphs />
                </Spinner.Suspense>
            </div>
            <Features enabled={eggFeatures} />
        </ServerContentBlock>
    );
};

export default memo(ServerConsoleContainer, isEqual);
