<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class PublishingServiceProvider extends ServiceProvider
{
    protected $domains;

    public function boot()
    {

    }

    public function register()
    {
        $this->name = "Publishing";

        $this->packages = array(
            'ContentManagement' => [
                'Content',
                'Issue',
                'Publication',
                'Publisher'
            ]
        );

        foreach ($this->packages as $package => $entities) {
            foreach ($entities as $entity) {
                if (!interface_exists("App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract")) {
                    throw new \Exception("Contract App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract not Found", 1);
                }

                if (!class_exists("App\DAL\\$this->name\\$package\\{$entity}DAO")) {
                    throw new \Exception("Class App\DAL\\$this->name\\$package\\{$entity}DAO not found.", 1);
                }

                $this->app->bind("App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract", "App\DAL\\$this->name\\$package\\{$entity}DAO");
            }
        }
    }
}
