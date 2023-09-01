@extends('template')

@section('content')

@foreach( $list as $key => $list )

    {{$key}}  <a href="{{ route('category', $list->first()->c_id) }}">Ver mais</a>
    <br><br>
    
    @foreach($list as $list)

        <form action="{{ route('cart.add', $list->p_id ) }}" method="post">
        @csrf

        {{ $list->p_name }}
        <br>

        R$ {{ number_format( $list->p_price ,2,",",".") }}
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
        <a href="{{ route('product', $list->p_id) }}" class="button">Detalhes</a>

        </form>

        <br>
    @endforeach
    
    <br>

@endforeach

@endsection



<style>

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
}

</style>