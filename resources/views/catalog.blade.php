@extends('template')

@section('content')

@foreach( $list as $key => $list )

    {{$key}}  <a href="{{ route('category', $list->first()->c_id) }}">Ver mais</a>
    <br><br>
    
    @foreach($list as $list)
        {{$list->p_name}} <a href="{{ route('product', $list->p_id) }}">Detalhes</a>
        <a href="{{ route('cart.add', $list->p_id) }}">Adicionar ao carrinho</a>
        <br>
    @endforeach
    
    <br>

@endforeach

@endsection