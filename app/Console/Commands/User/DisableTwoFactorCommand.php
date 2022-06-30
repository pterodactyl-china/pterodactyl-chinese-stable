<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

namespace Pterodactyl\Console\Commands\User;

use Illuminate\Console\Command;
use Pterodactyl\Contracts\Repository\UserRepositoryInterface;

class DisableTwoFactorCommand extends Command
{
    /**
     * @var string
     */
    protected $description = '在面板中为特定用户禁用双重身份验证.';

    /**
     * @var \Pterodactyl\Contracts\Repository\UserRepositoryInterface
     */
    protected $repository;

    /**
     * @var string
     */
    protected $signature = 'p:user:disable2fa {--email= : 禁用双重身份验证的用户的电子邮件.}';

    /**
     * DisableTwoFactorCommand constructor.
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Handle command execution process.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function handle()
    {
        if ($this->input->isInteractive()) {
            $this->output->warning(trans('command/messages.user.2fa_help_text'));
        }

        $email = $this->option('email') ?? $this->ask(trans('command/messages.user.ask_email'));
        $user = $this->repository->setColumns(['id', 'email'])->findFirstWhere([['email', '=', $email]]);

        $this->repository->withoutFreshModel()->update($user->id, [
            'use_totp' => false,
            'totp_secret' => null,
        ]);
        $this->info(trans('command/messages.user.2fa_disabled', ['email' => $user->email]));
    }
}
