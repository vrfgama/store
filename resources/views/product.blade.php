
{{ $product->name }}
<br>
{{ $product->description }}
<br>
{{ $product->price }}
<br><br>
<a href="{{ route('cart.add', $product->id) }}">Adicionar ao carrinho</a>