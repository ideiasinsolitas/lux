<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractEntity;

class File extends AbstractEntity
{

    protected $filepath;
    protected $filename;
    protected $mimetype;
    protected $extension;
    protected $width;
    protected $height;

    public function setFilepath($value)
    {
        $this->filepath = $this->checkValueType($value, 'string');
    }

    public function getFilepath()
    {
        return $this->filepath;
    }

    public function setFilename($value)
    {
        $this->filename = $this->checkValueType($value, 'string');
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setMimetype($value)
    {
        $this->mimetype = $this->checkValueType($value, 'string');
    }

    public function getMimetype()
    {
        return $this->mimetype;
    }

    public function setExtension($value)
    {
        $this->extension = $this->checkValueType($value, 'string');
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setWidth($value)
    {
        $this->width = $this->checkValueType($value, 'float');
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setHeight($value)
    {
        $this->height = $this->checkValueType($value, 'float');
    }

    public function getHeight()
    {
        return $this->height;
    }
}
