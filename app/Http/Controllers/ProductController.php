<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    
    public function product($id)
    {
        $product= Product::find($id);

        return view('product', ['product'=> $product]);
    }



}