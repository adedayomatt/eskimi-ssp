<?php
namespace Modules\Campaign;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CampaignServiceProvider extends ServiceProvider
{
    public const PREFIX = 'campaigns';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Map campaign routes
        $this->mapRoute();
        $this->mapApiRoute();

        // Load campaign migrations
        $this->loadMigrationsFrom(__DIR__. '/Migrations');
    }

    /**
     * Define the "web" routes for the module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRoute()
    {
        Route::middleware('web')
            ->prefix(self::PREFIX)
            ->name('campaign.')
            ->group(dirname(__FILE__). DIRECTORY_SEPARATOR. 'Routes/web.php');
    }

     /**
     * Define the "api" routes for the api.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapApiRoute()
    {
        Route::middleware('api')
            ->prefix('api/'.self::PREFIX)
            ->group(dirname(__FILE__). DIRECTORY_SEPARATOR. 'Routes/api.php');
    }
}
