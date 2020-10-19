<?php

namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $product_repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $product_repository
     */
    public function __construct(ProductRepository $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    /**
     * @return bool|\Illuminate\Support\Collection
     */
    public function getProduct()
    {
        return $this->product_repository->getProduct();
    }
}