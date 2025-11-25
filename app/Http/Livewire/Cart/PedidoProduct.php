<?php

namespace App\Http\Livewire\Cart;

class PedidoProduct {
    public $id;
    public $name;
    public $quantity;
    public $price;
    public $comercio_id;

    function __construct($id, $name, $price, $quantity, $comercio_id){
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->comercio_id = $comercio_id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getComercio_id()
    {
        return $this->comercio_id;
    }
    public function setComercio_id($comercio_id)
    {
        $this->comercio_id = $comercio_id;
    }
}