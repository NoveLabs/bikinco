<?php


namespace App\Repositories;

use App\Http\Models\Order;

class OrderRepo
{
    private $o;

    public function __construct()
    {
        $this->o = new Order;
    }

    public function create($data)
    {
        return $this->o->create($data);

    }

    public function update($id, $data)
    {
        $a = $this->o->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->o - find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->o->get();
    }

    public function filter($name, $param)
    {
        $a = $this->o->where($name, $param);

        return $a->get();
    }

    public function invoicePayments($id)
    {
        return $this->o->with('customer', 'orderItems.hasProduct.hasSubCategories')
            ->whereNull('orders.deleted_at')
            ->where('orders.id', $id)
            ->first();
            
    }
}
