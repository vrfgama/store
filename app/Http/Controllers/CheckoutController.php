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
    public function showAdresses(Request $request)
    {   

        $user= $request->session()->get('user');
        $adresses= Address::where(['user_id'=>$user->id])->get();
        
        //dar opção de inserir outro endereço de entrega
        
        return view('checkout-address',['adresses'=>$adresses]);
    }


    public function confirmAddress($id, Request $request)
    {
        $address= Address::find($id);
        $request->session()->put(['address'=>$address]);

        return redirect('checkout_show_payment');
    }


    public function showPayment(Request $request)
    {   
        $user= $request->session()->get('user');
        $credit_card= CreditCard::find(['user_id'=>$user->id]);

        //dar opção de inserir outro cartão de crédito e guardar o cartão na sessão somente após a confirmação 

        return view('payment', ['credit_card'=>$credit_card]);

    }


    public function confirmPayment($id, Request $request)
    {
        $credit_card= CreditCard::find($id);
        $request->session()->put(['credit_card'=>$credit_card]);
        
        return redirect( 'checkout_finish' );
    }


    public function finish(Request $request)
    {
        
        $address= $request->session()->get('address');
        /*
        $tt_price= $request->session()->get('tt_price');
        $tt_itens= $request->session()->get('tt_itens');
        */
        $cart_itens= $request->session()->get('cart');
        $tt_price= $cart_itens->total_price;
        $tt_itens= $cart_itens->total_itens;

        $user= $request->session()->get('user');

        //$credit_card= CreditCard::where(['user_id'=>$user->id])->first();
        $credit_card= $request->session()->get('credit_card');

        $cart_id= $request->session()->get('cart_id');
        $cart= CartItem::where(['cart_id'=>$cart_id])->get();


        $order= Order::create([
            'user_id'=> $user->id,
            'total_price'=> $tt_price, //acusando nulo
            'total_itens'=> $tt_itens, //acusando nulo
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

        // setar campo de finalização na tabela order

        return view('success');
    }
}
