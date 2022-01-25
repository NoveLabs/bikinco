<?php

namespace App\Repositories;

use App\Http\Models\Cities;

class CitiesRepo
{
    private $city;

    public function __construct()
    {
        $this->city = new Cities;
    }

    public function save($data)
    {
        return $this->city->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->city->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->city->find($a);


        return $a->delete();
    }

    public function get()
    {
        return $this->city->get();
    }

    public function filter($name, $param)
    {
        $a = $this->city->where($name, $param);

        return $a->get();
    }
}
