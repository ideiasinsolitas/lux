<?php
<<<<<<< HEAD
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
=======
namespace App\Services\Sys;

use App\DAL\Core\Sys\Contracts\ConfigDAOContract;

class ConfigService
{
    protected $user_id;
    protected $config;
    protected $dao;

    public function __construct(ConfigDAOContract $dao, $user_id = null)
    {
        $this->user_id = (int) $user_id;
        $this->config = [];
        $this->dao = $dao;
        $this->load();
    }

    protected function load()
    {
        $config = $this->dao->getDefaultConfig();
        if ($this->user_id) {
            $config = array_merge($config, $this->dao->getUserConfig($this->user_id));
        }
        $this->config = $config;
>>>>>>> core-develop
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
