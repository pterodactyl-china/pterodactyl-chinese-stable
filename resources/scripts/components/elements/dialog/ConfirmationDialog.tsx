import React from 'react';
import { Dialog } from '@/components/elements/dialog/index';
import { DialogProps } from '@/components/elements/dialog/Dialog';
import { Button } from '@/components/elements/button/index';

type ConfirmationProps = Omit<DialogProps, 'description' | 'children'> & {
    children: React.ReactNode;
    confirm?: string | undefined;
    onConfirmed: (e: React.MouseEvent<HTMLButtonElement, MouseEvent>) => void;
};

export default ({ confirm = '好的', children, onConfirmed, ...props }: ConfirmationProps) => {
    return (
        <Dialog {...props} description={typeof children === 'string' ? children : undefined}>
            {typeof children !== 'string' && children}
            <Dialog.Buttons>
                <Button.Text onClick={props.onClose}>取消</Button.Text>
                <Button.Danger onClick={onConfirmed}>{confirm}</Button.Danger>
            </Dialog.Buttons>
        </Dialog>
    );
};
