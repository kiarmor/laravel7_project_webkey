<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Product as Product;

class ProductRepository
{

    public function getProduct()
    {
        $product = DB::table('products')->get();

        return $product;
    }

}