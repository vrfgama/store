@extends('template')

@section('content')

Dados do cartão de crédito para pagamento

@foreach($credit_card as $cc)
    <br><br>
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
<a href="{{ route('checkout.confirm.payment', $cc->id ) }}">Finalizar compra</a>

@endsection