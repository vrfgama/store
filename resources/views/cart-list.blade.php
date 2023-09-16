@extends('template')

@section('content')

Valor total da compra: R${{ number_format( $tt_price ,2,",",".") }}
<br>
Total de itens no carrinho: {{ $tt_itens }}
<br>
<a href="{{ route('checkout.show.address') }}">Fechar compra</a>
<br>
<a href="{{ route('list.catalog') }}">Continuar comprando</a>

<br><br>

@foreach($list as $item)

    {{ $item->name }}
    <br>
    Quantidade: 
    {{ $item->total_itens }}
    <br>
    Preço unitário R$ 
    {{  number_format( $item->price ,2,",",".") }}
    <br>
    Total R$
    {{ number_format( $item->total_itens * $item->price, 2,",",".") }}
    <br>

    <a href=" {{ route('cart.remove', $item->id) }} ">Remover do carrinho</a>

    <br><br>
    
@endforeach

@endsection