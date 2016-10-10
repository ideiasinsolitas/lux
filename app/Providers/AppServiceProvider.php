<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
    
    public function register()
    {
        $name = "Core";

        $packages = array(
            'Sys' => [
                'User',
                'Notification',
                'Config',
                'Type'
            ],
            'SiteBuilding' => [
            ],
            'Interaction' => [
                'Comment',
            ],
            'Taxonomy' => [
            ]
        );

        // $this->_register($name, $packages);

        foreach ($packages as $package => $entities) {
            foreach ($entities as $entity) {
                // entity exists?
                if (!class_exists("App\DAL\\$name\\$package\\{$entity}")) {
                    throw new \Exception("Class App\DAL\\$name\\$package\\{$entity} not found.", 1);
                }
                
                // bind DAO
                if (!interface_exists("App\DAL\\$name\\$package\Contracts\\{$entity}DAOContract")) {
                    throw new \Exception("Contract App\DAL\\$name\\$package\Contracts\\{$entity}DAOContract not found", 1);
                }

                if (!class_exists("App\DAL\\$name\\$package\\{$entity}DAO")) {
                    throw new \Exception("Class App\DAL\\$name\\$package\\{$entity}DAO not found.", 1);
                }

                $this->app->bind("App\DAL\\$name\\$package\Contracts\\{$entity}DAOContract", "App\DAL\\$name\\$package\\{$entity}DAO");

                // bind DataMapper
                $isInterface = interface_exists("App\DAL\\$name\\$package\Contracts\\{$entity}DataMapperContract");
                $isClass = class_exists("App\DAL\\$name\\$package\\{$entity}DataMapper");

                if ($isInterface && $isClass) {
                    $this->app->bind("App\DAL\\$name\\$package\Contracts\\{$entity}DataMapperContract", "App\DAL\\$name\\$package\\{$entity}DataMapper");
                }
            }
        }
    }
}
