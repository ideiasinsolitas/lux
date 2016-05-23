<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {

        $daos = array(
            'Config',
            'Type',
            'User',
            'Auth',
            'Notification',
            'Token'
        );

        foreach ($daos as $dao) {
            if (!interface_exists("App\DAL\Core\Sys\Contracts\\{$dao}DAOContract")) {
                throw new \Exception("Contract ${dao}DAOContract not Found", 1);
            }

            if (!class_exists("App\DAL\Core\Sys\\{$dao}DAO")) {
                throw new \Exception("Class ${dao}DAO not Found", 1);
            }

            $this->app->bind("App\DAL\Core\Sys\Contracts\\{$dao}DAOContract", "App\DAL\Core\Sys\\{$dao}DAO");
        }

        if ($this->app->environment() == 'local') {
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }
}
