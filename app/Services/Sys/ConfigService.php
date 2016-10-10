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

    public function load()
    {
        $config = $this->dao->getDefaultConfig();
        if (\Auth::user()) {
            $config = array_merge($config, $this->dao->getUserConfig(\Auth::user()->id));
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
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
