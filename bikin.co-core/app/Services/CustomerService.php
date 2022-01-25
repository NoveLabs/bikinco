<?php

namespace App\Services;

use App\Repositories\CustomerRepo as Customer;
use App\Repositories\CustomerWorkRepo as Cluster;

class CustomerService
{
    private $customer;
    private $cluster;

    public function __construct()
    {
        $this->customer = new Customer;
        $this->cluster = new Cluster;
    }

    public function createCustomer($data)
    {
        return $this->customer->save($data);
    }

    public function updateCustomer($id, $data)
    {
        return $this->customer->update($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->customer->delete($id);
    }

    public function getAllCustomers()
    {
        return $this->customer->get();
    }

    public function filterCustomersWhere($name, $param)
    {
        return $this->customer->filter($name, $param);
    }


    // Cluster

    public function createCluster($data)
    {
        return $this->cluster->save($data);
    }

    public function updateCluster($id, $data)
    {
        return $this->cluster->update($id, $data);
    }

    public function deleteCluster($id)
    {
        return $this->cluster->delete($id);
    }

    public function getAllClusters()
    {
        return $this->cluster->get();
    }

    public function filterClustersWhere($name, $param)
    {
        return $this->cluster->filter($name, $param);
    }
}
