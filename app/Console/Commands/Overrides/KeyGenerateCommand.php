<?php

namespace Pterodactyl\Console\Commands\Overrides;

use Illuminate\Foundation\Console\KeyGenerateCommand as BaseKeyGenerateCommand;

class KeyGenerateCommand extends BaseKeyGenerateCommand
{
    /**
     * Override the default Laravel key generation command to throw a warning to the user
     * if it appears that they have already generated an application encryption key.
     */
    public function handle()
    {
        if (!empty(config('app.key')) && $this->input->isInteractive()) {
            $this->output->warning('看来您已经配置了应用程序加密密钥。继续此过程，覆盖该密钥并导致任何现有加密数据的数据损坏。除非你知道自己在做什么，否则不要继续.');
            if (!$this->confirm('我理解执行此命令的后果，并承担所有加密数据丢失的责任.')) {
                return;
            }

            if (!$this->confirm('确实要继续吗? 更改应用程序加密密钥将导致数据丢失.')) {
                return;
            }
        }

        parent::handle();
    }
}
