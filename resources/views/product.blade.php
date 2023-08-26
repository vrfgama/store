
@extends('template')

@section('content')

{{ $product->name }}
<br>
{{ $product->description }}
<br>
R$
{{ $product->price }}
<br>
Quantidade:
<br>
<select>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>

<br><br>
<a href="{{ route('cart.add', $product->id) }}">Adicionar ao carrinho</a>

@endsection