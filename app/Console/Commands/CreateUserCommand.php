<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--t|token= : Токен пользователя.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually creates a new laravel user.';

    public function handle(): void
    {
        $nameToken = $this->getNameToken();

        $admin = $this->ask('Администратор? [Y/N]', 'N') === 'Y';

        try {
            $user = new User;
            $user->is_admin = $admin;
            $user->save();
            $token = $user->createToken($nameToken);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return;
        }

        // Success message
        $this->info('Пользователь успешно создан!');
        $this->info('Токен для пользователя: ' . $token->plainTextToken);
    }

    private function getNameToken(): string
    {
        /** @var ?string */
        $nameToken = $this->option('token');

        if (is_null($nameToken)) {
            /** @var string */
            $nameToken = $this->ask('Укажите название токена.', 'default');
        }

        return $nameToken;
    }
}
