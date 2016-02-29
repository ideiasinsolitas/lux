<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Core\ConfigDAO;

class ConfigService
{
    protected $config;
    protected $configDAO;

    public function __construct(ConfigDAO $configDAO)
    {
        $this->config = [];
        $this->configDAO = $configDAO;
    }

    public function autoload()
    {
        $this->config = $this->configDAO->func();
    }

    public function loadAll()
    {
        $this->config = $this->configDAO->func();
    }

    public function load($key)
    {
        $this->config[$key] = $this->configDAO->func($key);
    }

    public function all()
    {
        return $this->config;
    }

    public function get($key)
    {
        return $this->config[$key];
    }
}
