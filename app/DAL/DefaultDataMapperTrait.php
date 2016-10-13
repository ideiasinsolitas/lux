<?php

namespace App\DAL;

use App\DAL\Exceptions\MappingException;

trait DefaultDataMapperTrait
{
    protected $filters = array();
    protected $_model_id = null;
    protected $mode = "EAGER";

    protected function insert($record)
    {
        $result = $this->dao->insert($record);
        $this->checkDAOBoolResult($result, true);
        $this->addMessage('info', 'record inserted');
    }

    protected function update($record, $id)
    {
        unset($record['created']);
        unset($record['id']);
        $result = $this->dao->update($record, (int) $id);
        $this->checkDAOBoolResult($result);
        $this->addMessage('info', 'record updated');
    }

    public function save(AbstractEntity $model)
    {
        $state = $model->getState();
        $data = $this->mapEntity($model);
        unset($data['_state']);
        $record = $this->processRecordInput($data);
        
        // use below line in production
        // if (!$model->id && $state === "NEW") {
        // use below line for testing
        if ($state === "NEW") {
            // hack para Nodable; retirar daqui
            if (method_exists($this->dao, 'createNode')) {
                $node_id = $this->dao->createNode();
                $model->node_id = $node_id;
                $record['node_id'] = $node_id;
            }

            $this->insert($record);
            $model->id = $this->dao->getLastInsertId();

            $this->trigger('inserted', $model);
        
        } elseif ($model->id > 0 && $state === "DIRTY") {
            $this->update($record, $model->id);
            $this->trigger('updated', $model);
        }

        if (method_exists($this, 'saveRelationships')) {
            $this->saveRelationships($model);
            $msg = "relationships updated";
            // $this->addMessage('info', $msg);
        }
    }

    public function remove(AbstractEntity $model)
    {
        $state = $model->getState();
        $data = $this->mapEntity($model);
        if ($state === "REMOVED") {
            $result = $this->dao->delete($model->id);
            $this->checkDAOBoolResult($result, true);
            
            if (method_exists($this, 'deleteRelationships')) {
                $this->deleteRelationships($model);
            }
            $this->trigger('removed', $id);
        }
    }
 
    // fetch

    protected function addRelationshipsToEntity($entity)
    {
        if (method_exists($this, "fetchRelationships") && $this->mode === "EAGER") {
            $relationships = $this->fetchRelationships($entity);
            foreach ($relationships as $name => $relationship) {
                $entity->$name = $relationship;
            }
        }
        return $entity;
    }

    public function fetchAll()
    {
        $list = $this->dao->getAll($this->filters);
        $collection = $this->createEntityCollection($list);
        $collection = $collection->map(function ($item) {
            return $this->addRelationshipsToEntity($item);
        });
        return $collection;
    }

    public function fetchById($id)
    {
        $this->filters['id'] = $id;
        $record = $this->dao->getOne($this->filters);
        $entity = $this->createEntity($record);
        $entity = $this->addRelationshipsToEntity($entity);
        return $entity;
    }

    // Mapper utils

    public function mapEntity(AbstractEntity $model)
    {
        return $model->toArray();
    }

    public function createEntity($data)
    {
        $class = self::ENTITY_CLASS;
        return $class::hydrate($data);
    }

    public function createEntityCollection($list)
    {
        $collection = new EntityCollection();
        foreach ($list as $item) {
            $entity = $this->createEntity($item);
            $collection->push($entity);
        }
        return $collection;
    }

    public function getEntityId()
    {
        if ($this->_model_id === null) {
            throw new MappingException("model id not set", 1);
        }
        return $this->_model_id;
    }

    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    public function setLazy()
    {
        $this->mode = "LAZY";
    }

    public function setEager()
    {
        $this->mode = "EAGER";
    }

    // Mapper Internals

    protected function checkDAOBoolResult($result, $strict = false)
    {
        if ($result !== 0 && $result !== "0" && !$result) {
            $msg = "Database operation failed.";
            $this->addMessage('error', $msg);
            throw new MappingException($msg);
        }
        if ($result === 0 || $result === "0") {
            $msg = "Database not modified.";
            if ($strict) {
                $this->addMessage('error', $msg);
                throw new MappingException($msg, 1);
            } else {
                $this->addMessage('info', $msg);
            }
        }
        if (intval($result) > 0) {
            $msg = "Database has been modified.";
            $this->addMessage('info', $msg);
        }
    }

    protected function _filterModifier($value)
    {
        return $value === false || is_array($value) || is_object($value) ? false : true;
    }

    protected function processRecordInput($record)
    {
        $newRecord = [];
        if ($record instanceof \stdClass) {
            $record = (array) $record;
        } elseif ($record instanceof AbstractEntity) {
            $record = $record->toArray();
        }

        if (!is_array(($record))) {
            throw new MappingException("record should be an array by now...", 1);
        }

        // __CLASS__ :: _filterModified
        $filtered = array_filter($record, array($this, '_filterModifier'));
        
        if (empty($filtered)) {
            throw new MappingException("record cannot be empty", 1);
        }
        return $filtered;
    }

    // dev/debug

    protected function trigger($name, $data)
    {
        switch ($name) {
            case 'inserted':
                $this->addMessage('info', __CLASS__ . " inserted an item");
//                $class = self::INSERTED_EVENT;
                break;
            case 'updated':
                $this->addMessage('info', __CLASS__ . " updated an item");
//                $class = self::UPDATED_EVENT;
                break;
            case 'removed':
                $this->addMessage('info', __CLASS__ . " removed an item");
//                $class = self::REMOVED_EVENT;
                break;
            default:
                throw new MappingException("Error Processing Request", 1);
                break;
        }
        
        /*
        if (class_exists($class)) {
            $event = new $class($data);
            \Event::fire($event);
        }
        */
       
        return true;
    }
}
