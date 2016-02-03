<?php namespace App\Models\Intel\GeoLocation\Province\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait ProvinceAttribute
{

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->can('edit-provinces')) {
            return '<a href="'.route('admin.geolocation.province.edit', $this->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('crud.edit_button') . '"></i></a>';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->can('delete-provinces')) {
            return '<a href="'.route('admin.geolocation.province.destroy', $this->id).'" class="btn btn-xs btn-danger" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="' . trans('crud.delete_button') . '"></i></a>';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute().' '.$this->getDeleteButtonAttribute();
    }
}
