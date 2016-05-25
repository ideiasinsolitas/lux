<?php
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

    public function setUserId($id)
    {
        $this->user_id = $id;
        return $this;
    }

    public function load()
    {
        $config = $this->dao->getDefaultConfig();
        if ($this->user_id) {
            $config = array_merge($config, $this->dao->getUserConfig($this->user_id));
        }
        $this->config = $config;
        return $this;
    }

    public function all()
    {
        return $this->config;
    }

    public function get($key = null)
    {
        if (!$key) {
            return $this->config;
        }
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        throw new \Exception("Error Processing Request", 1);
    }
}
