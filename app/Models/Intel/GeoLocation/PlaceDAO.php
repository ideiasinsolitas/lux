<?php

namespace App\Repositories\Core\GeoLocation;

use App\Models\GeoLocation\Place\Place;
use App\Models\GeoLocation\Address\Address;
use App\Repositories\Core\GeoLocation\Place\PlaceDAOContract;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPlaceDAO
 * @package App\Repositories\Place
 */
class PlaceDAO
{
    public function __construct()
    {
        $this->model = 'Place';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        $place = Place::with(['address'])->find($id);

        if (! is_null($place)) {
            return $place;
        }

        throw new GeneralException('That place does not exist.');
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPlacesPaginated($per_page = 20, $order_by = 'created_at', $sort = 'desc')
    {
        return Place::with(['address'])->orderBy($order_by, $sort)->simplePaginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPlacesPaginated($per_page = 20)
    {
        return Place::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPlaces($order_by = 'created_at', $sort = 'desc')
    {
        return Place::with(['address'])->orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws PlaceNeedsRolesException
     */
    public function create($placeInput)
    {
        $place = new Place;
        $place->name = $placeInput['name'];
        $place->description = $placeInput['description'];
        $place->additional_info = $placeInput['additional_info'];
        $place->user_id = $placeInput['user_id'];
        $place->address_id = $placeInput['address_id'];

        if ($place->save()) {
            return $place;
        }
        throw new GeneralException("There was a problem creating this place. Please try again.");
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $placeInput)
    {
        $place = $this->findOrFail($id);

        if ($place->update($placeInput, $id)) {
            return true;
        }
        throw new GeneralException("There was a problem updating this place. Please try again.");
    }
}
