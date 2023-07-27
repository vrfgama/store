<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function address(Request $request)
    {   
        //***
        $user= User::find(1);
        $request->session()->put(['user'=>$user]);
        $user2= $request->session()->get('user');
        //***

        $address= Address::find($user2->id);

        $request->session()->put(['address'=>$address]);
        
        return view('checkout-address',['address'=>$address]);
    }


    public function payment(Request $request)
    {
        $user= $request->session()->get('user');
        $credit_card= CreditCard::find(['user_id'=>$user->id]);

        return view('payment', ['credit_card'=>$credit_card]);

    }


    public function finish(Request $request)
    {
        
        $address= $request->session()->get('address');
        $tt_price= $request->session()->get('tt_price');
        $tt_itens= $request->session()->get('tt_itens');
        $user= $request->session()->get('user');

        $credit_card= CreditCard::where(['user_id'=>$user->id])->first();
        $cart= CartItem::where(['cart_id'=>1])->get();

        $order= Order::create([
            'user_id'=> $user->id,
            'total_price'=> $tt_price,
            'total_itens'=> $tt_itens,
            'credit_card_id'=> $credit_card->id,
            'delivery_address_id'=> $address->id
        ]);

                
        foreach($cart as $cart){

            OrderItem::create([
                'product_id'=> $cart->product_id,
                'price'=> $cart->price,
                'total_itens'=> $cart->total_itens,
                'order_id'=> $order->id
            ]);

        }

        return view('success');
    }
}
