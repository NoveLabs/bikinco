<?php

namespace App\Repositories;

use App\Http\Models\CustomerWork;

class CustomerWorkRepo
{
    private $customerWork;

    public function __construct()
    {
        $this->customerWork = new CustomerWork;
    }

    public function save($data)
    {
        return $this->customerWork->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->customerWork->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->customerWork->find($id);


        return $a->delete($id);
    }

    public function get()
    {
        return $this->customerWork->get();
    }

    public function filter($name, $data)
    {
        $a = $this->customerWork->where($name, $data);


        return $a->get();
    }
}
