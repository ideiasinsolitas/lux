<?php namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class AccessServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method
     */
    public function boot()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
        $this->registerFacade();
        $this->registerBindings();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAccess()
    {
        $this->app->bind('access', function ($app) {
            return new Access($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
        
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Access', \App\Services\Access\Facades\Access::class);
        });
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
        $this->app->bind(
            \App\Repositories\Front\Auth\AuthenticationContract::class,
            \App\Repositories\Front\Auth\EloquentAuthenticationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Front\User\UserContract::class,
            \App\Repositories\Front\User\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Core\User\UserContract::class,
            \App\Repositories\Core\User\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Core\Access\Role\RoleRepositoryContract::class,
            \App\Repositories\Core\Access\Role\EloquentRoleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Core\Permission\PermissionRepositoryContract::class,
            \App\Repositories\Core\Permission\EloquentPermissionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Core\Permission\Group\PermissionGroupRepositoryContract::class,
            \App\Repositories\Core\Permission\Group\EloquentPermissionGroupRepository::class
        );

        $this->app->bind(
            \App\Repositories\Core\Permission\Dependency\PermissionDependencyRepositoryContract::class,
            \App\Repositories\Core\Permission\Dependency\EloquentPermissionDependencyRepository::class
        );
    }

    /**
     * Register the blade extender to use new blade sections
     */
    protected function registerBladeExtensions()
    {
        /**
         * Role based blade extensions
         * Accepts either string of Role Name or Role ID
         */
        Blade::directive('role', function ($role) {
            return "<?php if (access()->hasRole{$role}): ?>";
        });

        /**
         * Accepts array of names or id's
         */
        Blade::directive('roles', function ($roles) {
            return "<?php if (access()->hasRoles{$roles}): ?>";
        });

        Blade::directive('needsroles', function ($roles) {
            return "<?php if (access()->hasRoles(".$roles.", true)): ?>";
        });

        /**
         * Permission based blade extensions
         * Accepts wither string of Permission Name or Permission ID
         */
        Blade::directive('permission', function ($permission) {
            return "<?php if (access()->can{$permission}): ?>";
        });

        /**
         * Accepts array of names or id's
         */
        Blade::directive('permissions', function ($permissions) {
            return "<?php if (access()->canMultiple{$permissions}): ?>";
        });

        Blade::directive('needspermissions', function ($permissions) {
            return "<?php if (access()->canMultiple(".$permissions.", true)): ?>";
        });

        /**
         * Generic if closer to not interfere with built in blade
         */
        Blade::directive('endauth', function () {
            return "<?php endif; ?>";
        });
    }
}
