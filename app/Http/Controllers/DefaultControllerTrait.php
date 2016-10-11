<?php

namespace App\Http\Controllers;

trait DefaultControllerTrait
{
    protected function saveEntityHash($key, $hash)
    {
        session()->set($key, $hash);
    }

    protected function clearEntityHash($key)
    {
        session()->remove($key);
    }

    protected function setEntityState($key, $entity)
    {
        if ($entity->id > 0) {
            $session = session();
            $savedHash = $session->get($key);
            $entityHash = $entity->getHash();
            if ($savedHash && $entityHash && $savedHash === $entityHash) {
                $entity->setState("CLEAN");
            }
            $entity->setState("DIRTY");
        } else {
            $entity->setState("NEW");
        }
        return $entity;
    }
}
