<?php

namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $product_repository;

    public function __construct(ProductRepository $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    public function getProduct()
    {
        return $this->product_repository->getProduct();
    }
}