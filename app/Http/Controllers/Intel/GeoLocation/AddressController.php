<?php

namespace App\Http\Controllers\Core\GeoLocation;

use App\Models\GeoLocation\Address;
use App\Repositories\Core\GeoLocation\AddressRepository;

use App\Http\Requests\Core\GeoLocation\CreateAddressRequest;
use App\Http\Requests\Core\GeoLocation\EditAddressRequest;
use App\Http\Requests\Core\GeoLocation\UpdateAddressRequest;
use App\Http\Requests\Core\GeoLocation\DeleteAddressRequest;
use App\Http\Requests\Core\GeoLocation\StoreAddressRequest;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    protected $addresses;
    
    public function __construct(AddressRepository $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($page = 1)
    {
        $result = [];
        $result['result'] = $this->addresses->getAddressesPaginated(config('geolocation.address.default_per_page'))->items();
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
        $result['result'] = $this->addresses->findOrFail($id, true);
        $result['status'] = 'OK';
        return response()->json($result);
    }
}
