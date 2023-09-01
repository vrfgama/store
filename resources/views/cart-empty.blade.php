@extends('template')

@section('content')

Seu carrinho esta vazio
<br>
<a href="{{ route('list.catalog') }}">Continuar comprando</a>

@endsection