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
    {{ $item->total_itens }}
    <br>
    {{ $item->price }}
    <br><br>

@endforeach

@endsection