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

    public function __construct(ConfigDAOContract $dao)
    {
        $this->config = [];
        $this->dao = $dao;
    }

    public function load()
    {
        $config = $this->dao->getDefaultConfig();
        if (\Auth::user()) {
            $config = array_merge($config, $this->dao->getUserConfig(\Auth::user()->id));
        }
<<<<<<< HEAD
        $this->config = $config;
>>>>>>> core-develop
=======
        foreach ($config as $item) {
            if (is_array($item)) {
                $this->config[$item['key']] = $item['value'];
            } elseif (is_object($item)) {
                $this->config[$item->key] = $item->value;
            }
        }
        return $this;
>>>>>>> develop
    }

    public function all()
    {
        return $this->config;
    }

    public function get($key = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
