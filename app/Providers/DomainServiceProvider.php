<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\UserRepository;
use App\Domain\User\User;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Domain\User\UserRepository', function () {
            $user = new User;

            return new UserRepository($user);
        });
    }
}
