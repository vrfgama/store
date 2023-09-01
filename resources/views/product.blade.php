
@extends('template')

@section('content')


<form action="{{ route('cart.add', $product->id ) }}" method="post">
        @csrf
        <br>
        {{ $product->name }}
        <br>
        {{ $product->description }}
        <br>
        R$ {{ number_format( $product->price ,2,",",".")   }}
        
        <br>

        Quantidade:
        <br>
        <select name="qtd" id="qtd">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>

        <input type="submit" value="Adicionar ao carrinho">
        <br>

        </form>

@endsection