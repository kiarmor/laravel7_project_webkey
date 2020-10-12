<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Product as Product;

class ProductRepository
{

    public function getProduct()
    {
        //$product = DB::table('products')->get();
        $product = Product::where('id', 1)->get(); //TODO: изменить запрос к базе

        return $product;
    }

}