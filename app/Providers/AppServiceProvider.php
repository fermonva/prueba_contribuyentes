<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\ContribuyenteRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\ContribuyenteRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ContribuyenteRepositoryInterface::class, ContribuyenteRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Usuario') ? true : null;
        });
    }
}
