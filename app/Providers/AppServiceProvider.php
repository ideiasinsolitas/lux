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

        $domains = array(
            'Config',
            'Type',
            'User',
            'Auth',
            'Notification',
            'Token'
        );

        foreach ($domains as $domain) {
            if (!interface_exists("App\DAL\Core\Sys\Contracts\\{$domain}DAOContract")) {
                throw new \Exception("Contract ${domain}DAOContract not Found", 1);
            }

            if (!class_exists("App\DAL\Core\Sys\\{$domain}DAO")) {
                throw new \Exception("Class ${domain}DAO not Found", 1);
            }

            $this->app->bind("App\DAL\Core\Sys\Contracts\\{$domain}DAOContract", "App\DAL\Core\Sys\\{$domain}DAO");
        }
        
        $this->app->bind("Illuminate\Contracts\Auth\Guard", "App\Services\Auth\AuthService");
        $this->app->bind("Illuminate\Contracts\Auth\UserProvider", "App\Services\Auth\UserAuthProvider");

        if ($this->app->environment() == 'local') {
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }
}
