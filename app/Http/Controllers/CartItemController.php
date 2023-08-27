<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartItemController extends Controller
{
    public function cartItemAdd($id, Request $request)
    {

        $product= Product::find($id);
        $user= request()->session()->get('user');
      

        if( request()->session()->get('cart_id') == null ) {
            $cart_id= $this->cartAdd($product, $user, $request);
            $request->session()->put(['cart_id'=> $cart_id]);
        }else{
            $cart_id= request()->session()->get('cart_id');
            $this->cartUpdate($cart_id, $product, $request);
        }       
        
        
        CartItem::create([
            'price'=> $product->price,
            'total_itens'=> $request->qtd,
            'cart_id'=> $cart_id,
            'product_id'=> $product->id
        ]);


        return redirect('list_catalog');
    }

    public function cartList(Request $request)
    {
        $list= DB::table('cart_itens as ci')
                   ->select('p.name as name', 'ci.total_itens as total_itens', 'ci.price as price')
                   ->join('products as p', 'ci.product_id', '=', 'p.id')
                   ->get();


        /*           
        $tt_price= 0;
        $tt_itens= 0;

        foreach($list as $item){
            $tt_price+= $item->price;
            $tt_itens+= $item->total_itens;
        }
        */

        $cart= Carts::where('user_id', $request->session()->get('user')->id )->first();

        /*
        $request->session()->put(['list'=> $list, 'tt_price'=>$tt_price, 'tt_itens'=> $tt_itens]);

        return view('cart-list', ['list'=> $list, 'tt_price'=>$tt_price, 'tt_itens'=> $tt_itens]);
        */

        return view( 'cart-list', [ 'list'=> $list, 'tt_price'=> $cart->total_price, 'tt_itens'=> $cart->total_itens ]  );
    }



    public function cartAdd($product, $user, $request)
    {
        
        $cart= Carts::create([
            'user_id'=> $user->id,
            'total_itens'=> $request->qtd,
            'total_price'=> ( $product->price * $request->qtd )
        ]);

        return $cart->id;

    }


    public function cartUpdate($cart_id, $product, $request)
    {
        $cart= Carts::find($cart_id);

        $cart->total_price+= ( $product->price * $request->qtd );
        $cart->total_itens+= $request->qtd;

        $cart->update();

    }
}
