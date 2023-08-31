<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartItemController extends Controller
{
    public function cartItemControll($id, Request $request)
    {

        $product= Product::find($id);
        $user= request()->session()->get('user');
        $cart_id= $this->getCartId($request);

        //verifica se já existe id do cart na sessão, se sim, cria o registro e coloca o valor na variável cart_id, se não, recupera o id e atribui a variável cart_id
        if( $this->getCartId($request) == null ) {
            $cart_id= $this->cartAdd($product, $user, $request);
            $request->session()->put(['cart_id'=> $cart_id]);
        }
   
        
        //com id do cart recuperado cria o registro do item na tabela cart_itens
        $this->cartItemAdd($product, $cart_id, $request);

        //atualiza os campos total_itens e total_price da tabela carts
        $this->cartUpdate($request);

        return redirect('list_catalog');
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


    public function cartItemAdd($product, $cart_id, $request){

        CartItem::create([
            'price'=> $product->price,
            'total_itens'=> $request->qtd,
            'cart_id'=> $cart_id,
            'product_id'=> $product->id
        ]);

    }


    public function cartList(Request $request)
    {

        $cart_id= $this->getCartId($request);

        // se não tiver o id do cart na sessão, retorna que o carrinho esta vazio 
        if( $cart_id == null ){

            return view('cart-empty');

        }else{
            /*
            //$cart_id= request()->session()->get('cart_id');    

            $tt_itens= DB::table( 'cart_itens' )
                ->select(DB::raw('sum(total_itens)'))
                ->where( 'cart_id', '=',  $cart_id )
                ->get();
                
                // se tiver id do cart na sessão mas não tiver itens no cart_itens, retorna que carrinho esta vazio

                if($tt_itens == null ){

                    return view('cart-empty');

                }*/


            //se tiver id do cart na sessão mas no campo de total_itens estiver vazio, retorna que carrinho esta vazio
            $cart= DB::table('carts')
                       ->select('total_itens', 'total_price')
                       ->where('id', '=', $cart_id)
                       ->first();
                       
            if($cart->total_itens == 0){
                return view('cart-empty');
            }           

        }

        //recupera da tabela cart o total de itens e da compra    
        //$cart= Carts::where('id', $cart_id)->first();

        //recupera da tabela cart_itens a lista de produtos no carrinho
        $list= DB::table('cart_itens as ci')
                   ->select('p.id as id', 'p.name as name', 'ci.total_itens as total_itens', 'ci.price as price')
                   ->join('products as p', 'ci.product_id', '=', 'p.id')
                   ->where('ci.cart_id', '=', $cart_id )
                   ->get();


        return view( 'cart-list', [ 'list'=> $list, 'tt_price'=> $cart->total_price, 'tt_itens'=> $cart->total_itens ]  );

    }    


    public function cartUpdate(Request $request)
    {

        $cart_id= $this->getCartId($request);
        $cart_itens= CartItem::where('cart_id', $cart_id)->get();
        $cart= Carts::find($cart_id);
        $cart->total_itens=  $cart->total_price= 0;

        foreach($cart_itens as $cart_item){
            $cart->total_price+= ( $cart_item->price * $cart_item->total_itens );
            $cart->total_itens+= $cart_item->total_itens; 
        }

        $cart->update();
    }


    public function cartRemoveItem($id, Request $request)
    {
        $cart_id= $this->getCartId($request);

        DB::table('cart_itens')
            ->where('cart_id', '=', $cart_id)
            ->where('product_id', '=', $id)
            ->delete();

        $this->cartUpdate($request);    

        return redirect('cart');    
    }


    public function getCartId(Request $request)
    {
        return $request->session()->get('cart_id');
    }
}
