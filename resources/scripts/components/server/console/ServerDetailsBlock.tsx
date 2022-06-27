import React, { useEffect, useState } from 'react';
import {
    faClock,
    faCloudDownloadAlt,
    faCloudUploadAlt,
    faHdd,
    faMemory,
    faMicrochip,
    faWifi,
} from '@fortawesome/free-solid-svg-icons';
import { bytesToString, ip, mbToBytes } from '@/lib/formatters';
import { ServerContext } from '@/state/server';
import { SocketEvent, SocketRequest } from '@/components/server/events';
import UptimeDuration from '@/components/server/UptimeDuration';
import StatBlock from '@/components/server/console/StatBlock';
import useWebsocketEvent from '@/plugins/useWebsocketEvent';
import classNames from 'classnames';

type Stats = Record<'memory' | 'cpu' | 'disk' | 'uptime' | 'rx' | 'tx', number>;

const getBackgroundColor = (value: number, max: number | null): string | undefined => {
    const delta = !max ? 0 : value / max;

    if (delta > 0.8) {
        if (delta > 0.9) {
            return 'bg-red-500';
        }
        return 'bg-yellow-500';
    }

    return undefined;
};

const ServerDetailsBlock = ({ className }: { className?: string }) => {
    const [stats, setStats] = useState<Stats>({ memory: 0, cpu: 0, disk: 0, uptime: 0, tx: 0, rx: 0 });

    const status = ServerContext.useStoreState((state) => state.status.value);
    const connected = ServerContext.useStoreState((state) => state.socket.connected);
    const instance = ServerContext.useStoreState((state) => state.socket.instance);
    const limits = ServerContext.useStoreState((state) => state.server.data!.limits);
    const allocation = ServerContext.useStoreState((state) => {
        const match = state.server.data!.allocations.find((allocation) => allocation.isDefault);

        return !match ? 'n/a' : `${match.alias || ip(match.ip)}:${match.port}`;
    });

    useEffect(() => {
        if (!connected || !instance) {
            return;
        }

        instance.send(SocketRequest.SEND_STATS);
    }, [instance, connected]);

    useWebsocketEvent(SocketEvent.STATS, (data) => {
        let stats: any = {};
        try {
            stats = JSON.parse(data);
        } catch (e) {
            return;
        }

        setStats({
            memory: stats.memory_bytes,
            cpu: stats.cpu_absolute,
            disk: stats.disk_bytes,
            tx: stats.network.tx_bytes,
            rx: stats.network.rx_bytes,
            uptime: stats.uptime || 0,
        });
    });

    return (
        <div className={classNames('grid grid-cols-6 gap-2 md:gap-4', className)}>
            <StatBlock icon={faWifi} title={'连接地址'}>
                {allocation}
            </StatBlock>
            <StatBlock
                icon={faClock}
                title={'运行时间'}
                color={getBackgroundColor(status === 'running' ? 0 : status !== 'offline' ? 9 : 10, 10)}
            >
                {stats.uptime > 0 ? <UptimeDuration uptime={stats.uptime / 1000} /> : '离线'}
            </StatBlock>
            <StatBlock
                icon={faMicrochip}
                title={'CPU 负载'}
                color={getBackgroundColor(stats.cpu, limits.cpu)}
                description={
                    limits.cpu
                        ? `此服务器允许使用 ${limits.cpu}% 的 CPU 处理资源.`
                        : '此服务器可无限制使用 CPU 处理资源.'
                }
            >
                {status === 'offline' ? <span className={'text-gray-400'}>离线</span> : `${stats.cpu.toFixed(2)}%`}
            </StatBlock>
            <StatBlock
                icon={faMemory}
                title={'运行内存'}
                color={getBackgroundColor(stats.memory / 1024, limits.memory * 1024)}
                description={
                    limits.memory
                        ? `此服务器允许使用 ${bytesToString(mbToBytes(limits.memory))} 的运行内存.`
                        : '此服务器可无限制使用运行内存资源.'
                }
            >
                {status === 'offline' ? <span className={'text-gray-400'}>离线</span> : bytesToString(stats.memory)}
            </StatBlock>
            <StatBlock
                icon={faHdd}
                title={'存储空间'}
                color={getBackgroundColor(stats.disk / 1024, limits.disk * 1024)}
                description={
                    limits.disk
                        ? `此服务器允许使用 ${bytesToString(mbToBytes(limits.disk))} 的存储空间.`
                        : '此服务器可无限制使用存储空间资源.'
                }
            >
                {bytesToString(stats.disk)}
            </StatBlock>
            <StatBlock
                icon={faCloudDownloadAlt}
                title={'网络流量 (接收)'}
                description={'您的服务器自启动以来收到的网络流量总量.'}
            >
                {status === 'offline' ? <span className={'text-gray-400'}>离线</span> : bytesToString(stats.tx)}
            </StatBlock>
            <StatBlock
                icon={faCloudUploadAlt}
                title={'网络流量 (发送)'}
                description={
                    '您的服务器自启动以来向广域网发送的总流量.'
                }
            >
                {status === 'offline' ? <span className={'text-gray-400'}>离线</span> : bytesToString(stats.rx)}
            </StatBlock>
        </div>
    );
};

export default ServerDetailsBlock;
