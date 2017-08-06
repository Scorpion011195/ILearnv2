<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\BaseService;
use App\Repositories\BaseRepository;
use App\Services\DictionaryService;
use App\Repositories\DictionaryRepository;
use App\Services\UserService;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(BaseRepository::class, BaseService::class);
        $this->app->singleton(DictionaryRepository::class, DictionaryService::class);
        $this->app->singleton(UserRepository::class, UserService::class);
    }
}
