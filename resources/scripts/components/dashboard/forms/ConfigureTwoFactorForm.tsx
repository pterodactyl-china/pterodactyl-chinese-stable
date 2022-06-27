import React, { useState } from 'react';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import SetupTwoFactorModal from '@/components/dashboard/forms/SetupTwoFactorModal';
import DisableTwoFactorModal from '@/components/dashboard/forms/DisableTwoFactorModal';
import tw from 'twin.macro';
import Button from '@/components/elements/Button';

export default () => {
    const [visible, setVisible] = useState(false);
    const isEnabled = useStoreState((state: ApplicationStore) => state.user.data!.useTotp);

    return (
        <div>
            {visible &&
                (isEnabled ? (
                    <DisableTwoFactorModal visible={visible} onModalDismissed={() => setVisible(false)} />
                ) : (
                    <SetupTwoFactorModal visible={visible} onModalDismissed={() => setVisible(false)} />
                ))}
            <p css={tw`text-sm`}>
                {isEnabled
                    ? '你的账户目前已启用双重认证登录'
                    : '你的账户目前并未启用双重认证登录，点击以下按钮以配置双重认证登录.'}
            </p>
            <div css={tw`mt-6`}>
                <Button color={'red'} isSecondary onClick={() => setVisible(true)}>
                    {isEnabled ? '已禁用' : '已启用'}
                </Button>
            </div>
        </div>
    );
};
