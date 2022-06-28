import React from 'react';
import tw from 'twin.macro';

export default () => {
    return (
        <>
            <div css={tw`md:w-1/2 h-full bg-neutral-600`}>
                <div css={tw`flex flex-col`}>
                    <h2 css={tw`py-4 px-6 font-bold`}>例子</h2>
                    <div css={tw`flex py-4 px-6 bg-neutral-500`}>
                        <div css={tw`w-1/2`}>*/5 * * * *</div>
                        <div css={tw`w-1/2`}>每 5 分钟</div>
                    </div>
                    <div css={tw`flex py-4 px-6`}>
                        <div css={tw`w-1/2`}>0 */1 * * *</div>
                        <div css={tw`w-1/2`}>每小时</div>
                    </div>
                    <div css={tw`flex py-4 px-6 bg-neutral-500`}>
                        <div css={tw`w-1/2`}>0 8-12 * * *</div>
                        <div css={tw`w-1/2`}>每天的某时</div>
                    </div>
                    <div css={tw`flex py-4 px-6`}>
                        <div css={tw`w-1/2`}>0 0 * * *</div>
                        <div css={tw`w-1/2`}>一天只运行一次</div>
                    </div>
                    <div css={tw`flex py-4 px-6 bg-neutral-500`}>
                        <div css={tw`w-1/2`}>0 0 * * MON</div>
                        <div css={tw`w-1/2`}>每周一</div>
                    </div>
                </div>
            </div>
            <div css={tw`md:w-1/2 h-full bg-neutral-600`}>
                <h2 css={tw`py-4 px-6 font-bold`}>特殊字符</h2>
                <div css={tw`flex flex-col`}>
                    <div css={tw`flex py-4 px-6 bg-neutral-500`}>
                        <div css={tw`w-1/2`}>*</div>
                        <div css={tw`w-1/2`}>任填</div>
                    </div>
                    <div css={tw`flex py-4 px-6`}>
                        <div css={tw`w-1/2`}>,</div>
                        <div css={tw`w-1/2`}>值分隔符</div>
                    </div>
                    <div css={tw`flex py-4 px-6 bg-neutral-500`}>
                        <div css={tw`w-1/2`}>-</div>
                        <div css={tw`w-1/2`}>范围变量</div>
                    </div>
                    <div css={tw`flex py-4 px-6`}>
                        <div css={tw`w-1/2`}>/</div>
                        <div css={tw`w-1/2`}>步长变量</div>
                    </div>
                </div>
            </div>
        </>
    );
};
