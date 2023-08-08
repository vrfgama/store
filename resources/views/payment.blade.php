@extends('template')

@section('content')

@foreach($credit_card as $cc)

    Número: 
    {{ $cc->number }}
    <br>
    Data de vencimento:
    {{ $cc->expiration_date }}
    <br>
    Bandeira: 
    {{ $cc->type }}
    <br>
    Cvv: 
    {{ $cc->cvv }}


@endforeach

<br><br>
<a href="{{ route('checkout.finish') }}">Finalizar compra</a>

@endsection