@extends('template')

@section('content')

<br>
{{ $category->name }}
<br><br>

@foreach($products as $products)

<form action="{{ route('cart.add', $products->id ) }}" method="post">
    @csrf

    {{ $products->name }}
    <br>
    {{ $products->description }}
    <br>
    R$ {{ $products->price }}
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
    <br>

    <input type="submit" value="Adicionar ao carrinho">
    <br>
    <br>    

</form>        

@endforeach

@endsection