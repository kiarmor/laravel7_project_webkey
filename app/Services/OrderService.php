<?php

namespace App\Services;
use App\Repositories\OrderRepository;

class OrderService
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function saveOrder($request)
    {
        $save = $this->repository->saveOrder($request);

        return $save;
    }

}