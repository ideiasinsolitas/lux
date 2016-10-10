<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Ticket extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Description,
        Properties\Activity,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted,
        Properties\Nodable;

    protected $responsible;

    protected $customer;

    protected $project;

    protected $problem_url;

    protected $comments;

    public function setResponsible($value)
    {
        $this->responsible = $this->createEntity($value, "\App\DAL\Core\Sys\User");
    }

    public function getResponsible()
    {
        return $this->responsible === null ? $this->responsible : new \App\DAL\Core\Sys\User();
    }

    public function setCustomer($value)
    {
        $this->customer = $this->createEntity($value, "\App\DAL\Core\Sys\User");
    }

    public function getCustomer()
    {
        return $this->customer === null ? $this->customer : new \App\DAL\Core\Sys\User();
    }

    public function setProject($value)
    {
        $this->project = $this->createEntity($value, "\App\DAL\Business\ProjectManagement\Project");
    }

    public function getProject()
    {
        return $this->project === null ? $this->project : new \App\DAL\Business\ProjectManagement\Project();
    }

    public function setProblemUrl($value)
    {
        $this->problem_url = $this->checkValueType($value, 'string');
    }

    public function getProblemUrl()
    {
        return $this->problem_url || "";
    }

    public function setComments($comments)
    {
        $this->comments = $this->createEntityCollection($comments, 'App\DAL\Core\Interaction\Comment');
    }

    public function getComments()
    {
        return $this->comments;
    }
}
