<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class IntelServiceProvider extends ServiceProvider
{
    protected $domains;

    public function boot()
    {

    }
    
    public function register()
    {
        $this->name = "Intel";

        $this->packages = array(
            'GeoLocation' => [
                'Place',
                'Address'
            ],
            'RealEstate' => [
                'Estate'
            ],
            'Timeline' => [
                'Event',
                'Calendar'
            ]
        );

        foreach ($this->packages as $package => $entities) {
            foreach ($entities as $entity) {
                if (!interface_exists("App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract")) {
                    throw new \Exception("Contract App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract not Found", 1);
                }

                if (!class_exists("App\DAL\\$this->name\\$package\\{$entity}DAO")) {
                    throw new \Exception("Class App\DAL\\$this->name\\$package\\{$entity}DAO", 1);
                }

                $this->app->bind("App\DAL\\$this->name\\$package\Contracts\\{$entity}DAOContract", "App\DAL\\$this->name\\$package\\{$entity}DAO");
            }
        }
    }
}
