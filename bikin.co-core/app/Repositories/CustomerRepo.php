<?php


namespace App\Repositories;

use App\Http\Models\Customer;

class CustomerRepo
{
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer;
    }

    public function save($data)
    {
        return $this->customer->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->customer->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->customer->find($id);


        return $a->delete($id);
    }

    public function get()
    {
        return $this->customer->get();
    }

    public function filter($name, $data)
    {
        $a = $this->customer->where($name, $data);;

        return $a->get();
    }
}
