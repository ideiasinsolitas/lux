<?php

namespace App\Http\Controllers\Core\GeoLocation;

use App\Models\GeoLocation\Place;
use App\Http\Requests\Core\GeoLocation\CreatePlaceRequest;
use App\Http\Requests\Core\GeoLocation\EditPlaceRequest;
use App\Http\Requests\Core\GeoLocation\UpdatePlaceRequest;
use App\Http\Requests\Core\GeoLocation\DeletePlaceRequest;
use App\Http\Requests\Core\GeoLocation\StorePlaceRequest;
use App\Http\Controllers\Controller;
use App\Services\LocationConverter;

use App\Repositories\Core\GeoLocation\PlaceRepository;
use App\Repositories\Core\GeoLocation\AddressRepository;

class PlaceController extends Controller
{
    /**
     * [$places description]
     * @var PlaceRepository
     */
    protected $places;

    /**
     * [$addresses description]
     * @var AddressRepository
     */
    protected $addresses;

    /**
     * [$location description]
     * @var LocationConverter
     */
    protected $location;

    /**
     * /
     * @param PlaceRepository   $places    [description]
     * @param AddressRepository $addresses [description]
     * @param LocationConverter $location  [description]
     */
    public function __construct(PlaceRepository $places, AddressRepository $addresses, LocationConverter $location)
    {
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
        return view('backend.geolocation.app');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($page = 1)
    {
        $result = [];
        $result['result'] = $this->places->getPlacesPaginated(config('geolocation.address.default_per_page'))->items();
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result = [];
        $place = $this->places->findOrFail($id, true);
        $result['result'] = $place;
        $result['result']['user_name'] = isset($place->user) ? $place->user->name : null;
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $request [description]
     * @return Response          [description]
     */
    private function handleInsertUpdateRequests($request)
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
        list($placeInput, $addressInput) = $this->handleInsertUpdateRequests($request);
        $address = $this->addresses->getOrCreate($addressInput);
        $placeInput['address_id'] = $address->id;
        $placeInput['user_id'] = 1;

        $place = $this->places->create($placeInput);

        $result = ['message' => trans("alerts.place.created"), 'status' => 'OK', 'id' => $place->id];
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdatePlaceRequest $request)
    {
        list($placeInput, $addressInput) = $this->handleInsertUpdateRequests($request);
        $address = $this->addresses->getOrCreate($addressInput);
        $placeInput['address_id'] = $address->id;

        $this->places->update($id, $placeInput);

        $result = ['message' => trans("alerts.place.updated"), 'status' => 'OK', 'id' => $id];
        return response()->json($result);
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
        $result = ['message' => trans("alerts.place.deleted"), 'status' => 'OK', 'id' => $id];
        return response()->json($result);
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
        $this->places->deleteMany($ids);
        $result = ['message' => trans("alerts.place.deleted"), 'status' => 'OK', 'id' => $ids];
        return response()->json($result);
    }

    /**
     * /
     * @return Response [description]
     */
    public function getAllCountries()
    {
        $result = [];
        $result['result'] = $this->addresses->getAllCountries();
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @return Response             [description]
     */
    public function getProvinces($country_id)
    {
        $result = [];
        $result['result'] = $this->addresses->getProvincesByCountryId($country_id);
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $province_id [description]
     * @return Response              [description]
     */
    public function getCities($province_id)
    {
        $result = [];
        $result['result'] = $this->addresses->getCitiesByProvinceId($province_id);
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @return Response             [description]
     */
    public function getCitiesByCountry($country_id)
    {
        $result = [];
        $result['result'] = $this->addresses->getCitiesByCountryId($country_id);
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $city_id [description]
     * @return Response          [description]
     */
    public function getDistricts($city_id)
    {
        $result = [];
        $result['result'] = $this->addresses->getDistrictsByCityId($city_id);
        $result['status'] = 'OK';
        return response()->json($result);
    }

    /**
     * /
     * @param  [type] $zipcode [description]
     * @return Response          [description]
     */
    public function completeAddress($address)
    {
        $result = [];
        $result['status'] = 'OK';
        $result['result'] = $this->location->completeAdress($address);
        return response()->json($result);
    }
}
