
{{ $category->name }}
<br><br>

@foreach($products as $products)

    {{ $products->name }}
    <br>
    {{ $products->description }}
    <br>
    {{ $products->price }}
    <br>
    <a href="{{ route('cart.add', $products->id) }}">Adicionar ao carrinho</a>
    <br><br>
@endforeach