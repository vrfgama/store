@extends('template')

@section('content')

Valor total da compra: R${{ $tt_price }}
<br>
Total de itens no carrinho: {{ $tt_itens }}
<br>
<a href="{{ route('checkout.address') }}">Fechar compra</a>

<br><br>

@foreach($list as $item)

    {{ $item->name }}
    <br>
    Quantidade: 
    {{ $item->total_itens }}
    <br>
    R$ 
    {{ $item->price }}
    <br>

    <a href=" {{ route('cart.remove', $item->id) }} ">Remover do carrinho</a>

    <br><br>
    
@endforeach

@endsection