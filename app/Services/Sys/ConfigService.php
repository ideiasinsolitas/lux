<?php
namespace App\Services\Sys;

use App\DAL\Core\Sys\ConfigDAO;

class ConfigService
{
    protected $user_id;
    protected $config;
    protected $dao;

    public function __construct(ConfigDAO $dao, $user_id = null)
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
