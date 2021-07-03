<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repos = [
       \App\Contracts\UserContract::class       => \App\Repositories\UserRepository::class,
       \App\Contracts\AdminContract::class      => \App\Repositories\AdminRepository::class,
       \App\Contracts\CenterContract::class     => \App\Repositories\CenterRepository::class,
       \App\Contracts\EvaluationContract::class => \App\Repositories\EvaluationRepository::class,
       \App\Contracts\StudentContract::class    => \App\Repositories\StudentRepository::class,
       \App\Contracts\SkillContract::class    => \App\Repositories\SkillRepository::class,
       \App\Contracts\TaskContract::class    => \App\Repositories\TaskRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register() : void
    {
        foreach ($this->repos as $abstract => $concrete)
        {
            $this->app->singleton($abstract,$concrete);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
