@extends('template')

@section('content')

{{ $category->name }}
<br><br>

@foreach($products as $products)

    {{ $products->name }}
    <br>
    {{ $products->description }}
    <br>
    R$ {{ $products->price }}
    <br>
    <select>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <br>
    <a href="{{ route('cart.add', $products->id) }}">Adicionar ao carrinho</a>
    <br><br>
@endforeach

@endsection