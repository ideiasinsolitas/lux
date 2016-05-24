<?php

namespace App\Http\Controllers\Core\GeoLocation;

use App\Models\GeoLocation\Place;
use App\Http\Requests\Core\GeoLocation\CreatePlaceRequest;
use App\Http\Requests\Core\GeoLocation\EditPlaceRequest;
use App\Http\Requests\Core\GeoLocation\UpdatePlaceRequest;
use App\Http\Requests\Core\GeoLocation\DeletePlaceRequest;
use App\Http\Requests\Core\GeoLocation\StorePlaceRequest;
use App\Http\Controllers\Controller;

use App\Repositories\Core\GeoLocation\PlaceDAO;
use App\Repositories\Core\GeoLocation\AddressDAO;

use App\Services\LocationConverter;
use App\Services\ResponseHandler;

class PlaceController extends Controller
{
    /**
     * [$places description]
     * @var PlaceDAO
     */
    protected $places;

    /**
     * [$addresses description]
     * @var AddressDAO
     */
    protected $addresses;

    /**
     * [$location description]
     * @var LocationConverter
     */
    protected $location;

    /**
     * /
     * @param PlaceDAO   $places    [description]
     * @param AddressDAO $addresses [description]
     * @param LocationConverter $location  [description]
     */
    public function __construct(ResponseHandler $handler, PlaceDAO $places, AddressDAO $addresses, LocationConverter $location)
    {
        $handler->setPrefix('intel.geolocation');
        $this->handler = $handler;
        $this->places = $places;
        $this->addresses = $addresses;
        $this->location = $location;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('intel.geolocation.app');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $place = $this->places->getPlacesPaginated(config('geolocation.address.default_per_page'))->items();
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $place = $this->places->findOrFail($id, true);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $request [description]
     * @return Response          [description]
     */
    private function handleFormInput($request)
    {
        $placeKeys = [
            'name',
            'description',
            'additional_info',
            'address_id',
            'user_id',
        ];
        $placeInput = $request->only($placeKeys);
        $addressKeys = [
            'street',
            'number',
            'zipcode',
            'district_id',
            'city_id',
        ];
        $addressInput = $request->only($addressKeys);

        return [$placeInput, $addressInput];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StorePlaceRequest $request)
    {
        list($placeInput, $addressInput) = $this->handleFormInput($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, DeletePlaceRequest $request)
    {
        $this->places->delete($id);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  DeletePlaceRequest $request [description]
     * @return Response                      [description]
     */
    public function deleteMany(DeletePlaceRequest $request)
    {
        $var = $request->only('ids');
        $ids = $var['ids'];
        $place = $this->places->deleteMany($ids);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getAddressesPaginated()
    {
        $place = $this->addresses->getAddressesPaginated(config('geolocation.address.default_per_page'))->items();
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getAddress($id)
    {
        $place = $this->addresses->findOrFail($id, true);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @return Response [description]
     */
    public function getAllCountries()
    {
        $place = $this->addresses->getAllCountries();
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @return Response             [description]
     */
    public function getProvinces($country_id)
    {
        $place = $this->addresses->getProvincesByCountryId($country_id);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $province_id [description]
     * @return Response              [description]
     */
    public function getCities($province_id)
    {
        $place = $this->addresses->getCitiesByProvinceId($province_id);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @return Response             [description]
     */
    public function getCitiesByCountry($country_id)
    {
        $place = $this->addresses->getCitiesByCountryId($country_id);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $city_id [description]
     * @return Response          [description]
     */
    public function getDistricts($city_id)
    {
        $place = $this->addresses->getDistrictsByCityId($city_id);
        return $this->handler
            ->apiResponse($place);
    }

    /**
     * /
     * @param  [type] $zipcode [description]
     * @return Response          [description]
     */
    public function completeAddress($address)
    {
        return $this->handler
            ->apiResponse($place);
    }
}
