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
        foreach ($config as $item) {
            if (is_array($item)) {
                $this->config[$item['key']] = $item['value'];
            } elseif (is_object($item)) {
                $this->config[$item->key] = $item->value;
            }
        }
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
