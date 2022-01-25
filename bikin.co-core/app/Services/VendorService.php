<?php


namespace App\Services;

use App\Repositories\VendorRepo as Vendor;

class VendorService
{
    private $v;

    public function __construct()
    {
        $this->v = new Vendor;
    }

    public function createVendor($data)
    {
        return $this->v->create($data);
    }

    public function updateVendor($id, $data)
    {
        return $this->v->update($id, $data);
    }

    public function deleteVendor($id)
    {
        return $this->v->delete($id);
    }

    public function getAllVendors()
    {
        return $this->v->get();
    }

    public function filterVendorsWhere($name, $param)
    {
        return $this->v->filter($name, $param);
    }

}
