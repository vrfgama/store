@extends('template')

@section('content')

Confirme o endereço de entrega
<br><br>

@foreach( $adresses as $address )

Rua: 
{{ $address->street }}
<br>
Número: 
{{ $address->number }}
<br>
Cep: 
{{ $address->cep }}
<br>
Bairro: 
{{ $address->district }}
<br>
Cidade: 
{{ $address->city }}
<br>
Estado: 
{{ $address->state }}
<br>
{{ $address->country }}
<br>
<a href="{{ route('checkout.confirm.address', $address->id ) }}">Confirmar este endereço para entrega</a>

<br><br>

@endforeach


@endsection