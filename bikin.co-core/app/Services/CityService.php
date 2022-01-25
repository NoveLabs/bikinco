<?php


namespace App\Services;

use App\Repositories\CitiesRepo as Cities;

class CityService
{
    private $city;

    public function __construct()
    {
        $this->city = new Cities;
    }

    public function createCity($data)
    {
        return $this->city->save($data);
    }

    public function updateCity($id, $data)
    {
        return $this->city->update($id, $data);
    }

    public function deleteCity($id)
    {
        return $this->city->delete($id);
    }

    public function getAllCities()
    {
        return $this->city->get();
    }

    public function filterCitiesWhere($name, $param)
    {
        return $this->city->filter($name, $param);
    }
}
