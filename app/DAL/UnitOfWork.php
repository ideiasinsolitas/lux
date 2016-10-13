<?php

namespace App\DAL;

use Illuminate\Support\Facades\DB;

use App\DAL\Contracts\ObjectStorageContract;

class UnitOfWork
{
    protected $mapper;
    protected $storage;

    public function __construct(AbstractDataMapper $mapper, ObjectStorageContract $storage)
    {
        $this->mapper = $mapper;
        $this->storage = $storage;
    }

    public function getDataMapper()
    {
        return $this->mapper;
    }

    public function getObjectStorage()
    {
        return $this->storage;
    }

    public function register(AbstractEntity $entity)
    {
        $this->storage->attach($entity, $entity->getState());
        return $this;
    }
    
    public function commit()
    {
        DB::beginTransaction();
        foreach ($this->storage as $entity) {
            $state = $this->storage[$entity];
            switch ($state) {
                // case "CLEAN":
                case "NEW":
                case "DIRTY":
                    $this->mapper->save($entity);
                    break;
                case "REMOVED":
                    $this->mapper->remove($entity);
                    break;
                default:
                    break;
            }
        }
        $this->clear();
        DB::commit();
    }
    
    public function rollback()
    {
        DB::rollBack();
    }
    
    public function clear()
    {
        $this->storage->clear();
        return $this;
    }
}
