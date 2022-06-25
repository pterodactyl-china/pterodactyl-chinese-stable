import React from 'react';
import Can from '@/components/elements/Can';
import { ServerError } from '@/components/elements/ScreenBlock';

export interface RequireServerPermissionProps {
    permissions: string | string[]
}

const RequireServerPermission: React.FC<RequireServerPermissionProps> = ({ children, permissions }) => {
    return (
        <Can
            action={permissions}
            renderOnError={
                <ServerError
                    title={'权限不足'}
                    message={'您没有访问该页面的权限.'}
                />
            }
        >
            {children}
        </Can>
    );
};

export default RequireServerPermission;
