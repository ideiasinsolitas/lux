<?php

namespace App\Repositories\Core\GeoLocation;

use App\Models\GeoLocation\Coordinate\Coordinate;
use App\Models\GeoLocation\Address\Address;
use App\Models\GeoLocation\District\District;
use App\Models\GeoLocation\City\City;
use App\Models\GeoLocation\Province\Province;
use App\Models\GeoLocation\Country\Country;

use App\Exceptions\GeneralException;

/**
 * Class EloquentAddressDAO
 * @package App\Repositories\Address
 */
class AddressDAO
{

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        $address = Address::with(['coordinate', 'district', 'city'])->find($id);

        if (! is_null($address)) {
            return $address;
        }

        throw new GeneralException('That address does not exist.');
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getAddressesPaginated($per_page = 20, $order_by = 'id', $sort = 'asc')
    {
        return Address::with(['coordinate', 'district', 'city'])->orderBy($order_by, $sort)->simplePaginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllAddresses($order_by = 'id', $sort = 'asc')
    {
        return Address::with(['coordinate', 'district', 'city'])->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  string $order_by [description]
     * @param  string $sort     [description]
     * @return [type]           [description]
     */
    public function getAllCountries($order_by = 'id', $sort = 'asc')
    {
        return Country::orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @param  string $order_by   [description]
     * @param  string $sort       [description]
     * @return [type]             [description]
     */
    public function getProvincesByCountryId($country_id, $order_by = 'id', $sort = 'asc')
    {
        return Province::where('country_id', $country_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $country_id [description]
     * @param  string $order_by   [description]
     * @param  string $sort       [description]
     * @return [type]             [description]
     */
    public function getCitiesByCountryId($country_id, $order_by = 'id', $sort = 'asc')
    {
        return City::where('country_id', $country_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $province_id [description]
     * @param  string $order_by    [description]
     * @param  string $sort        [description]
     * @return [type]              [description]
     */
    public function getCitiesByProvinceId($province_id, $order_by = 'id', $sort = 'asc')
    {
        return City::where('province_id', $province_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $city_id  [description]
     * @param  string $order_by [description]
     * @param  string $sort     [description]
     * @return [type]           [description]
     */
    public function getDistrictsByCityId($city_id, $order_by = 'id', $sort = 'asc')
    {
        return District::where('city_id', $city_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $district_id [description]
     * @param  string $order_by    [description]
     * @param  string $sort        [description]
     * @return [type]              [description]
     */
    public function getAdressesByDistrictId($district_id, $order_by = 'id', $sort = 'asc')
    {
        return Address::where('district_id', $district_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $city_id  [description]
     * @param  string $order_by [description]
     * @param  string $sort     [description]
     * @return [type]           [description]
     */
    public function getAddressesByCityId($city_id, $order_by = 'id', $sort = 'asc')
    {
        return Address::where('city_id', $city_id)->orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  [type] $addressInput [description]
     * @return [type]               [description]
     */
    public function exists($addressInput)
    {
        // exists
        return Address::where('street', $addressInput['street'])
            ->where('number', $addressInput['number'])
            ->where('zipcode', $addressInput['zipcode'])
            ->first();
    }

    /**
     * /
     * @param  [type] $coordinateInput [description]
     * @return [type]                  [description]
     */
    public function coordinateExists($coordinateInput)
    {
        // exists
        return Address::where('lat', $coordinateInput['lat'])
            ->where('lon', $coordinateInput['lon'])
            ->first();
    }

    /**
     * /
     * @param  [type] $district [description]
     * @return [type]           [description]
     */
    public function districtExists($district)
    {
        // exists
        return Address::where('name', $district)->first();
    }

    /**
     * /
     * @param  [type] $addressInput [description]
     * @return [type]               [description]
     */
    public function getOrCreate($addressInput)
    {
        $address = $this->exists($addressInput);
        if (!$address) {
            $address = new Address;
            $address->street = $addressInput['street'];
            $address->number = $addressInput['number'];
            $address->zipcode = $addressInput['zipcode'];
            $address->city_id = $addressInput['city_id'];
            $address->save();
        }
        return $address;
    }

    /**
     * /
     * @param  [type] $address [description]
     * @return [type]          [description]
     */
    public function getStringAddress($address)
    {
        return $address->street . ', ' . $address->number . ' - ' . $address->city->name . ' - ' . $address->zipcode . ' - Brasil';
    }

    /**
     * /
     * @param  [type] $address [description]
     * @return [type]          [description]
     */
    public function getOrCreateCoordinate($address)
    {

        $coordinate = $this->coordinateExists($coordinate);
        if (!$coordinate) {
            $coordinate = new Coordinate;
            $coordinate->street = $coordinate['lat'];
            $coordinate->city_id = $coordinate['lon'];
            $coordinate->save();
        }
        return $coordinate;
    }

    /**
     * /
     * @param  [type] $district [description]
     * @return [type]           [description]
     */
    public function getOrCreateDistrict($district)
    {
        $district = $this->districtExists($district);
        if (!$district) {
            $district = new District;
            $district->name = $district;
            $district->save();
        }
        return $district;
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $address = $this->findOrFail($id);
        if ($address->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this address. Please try again.");
    }
}
