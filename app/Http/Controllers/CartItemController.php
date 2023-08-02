<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartItemController extends Controller
{
    public function cartAdd($id, Request $request)
    {
        $product= Product::find($id);
        /*
        $cart= Carts::create([
            'user_id'=> 1,
            'total_itens'=> 1,
            'total_price'=> 1
        ]);*/
        
        
        CartItem::create([
            'price'=> $product->price,
            'total_itens'=> 1,
            'cart_id'=> 1,//$cart->id,
            'product_id'=> $product->id
        ]);

        return redirect()->back()->with('erro', 'erro');
    }

    public function list(Request $request)
    {
        $list= DB::table('cart_itens as ci')
                   ->select('p.name as name', 'ci.total_itens as total_itens', 'ci.price as price')
                   ->join('products as p', 'ci.product_id', '=', 'p.id')
                   ->get(); 


        $tt_price= 0;
        $tt_itens= 0;

        foreach($list as $item){
            $tt_price+= $item->price;
            $tt_itens+= $item->total_itens;
        }

        $request->session()->put(['list'=> $list, 'tt_price'=>$tt_price, 'tt_itens'=> $tt_itens]);

        return view('cart-list', ['list'=> $list, 'tt_price'=>$tt_price, 'tt_itens'=> $tt_itens]);
    }
}
