<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Produto</title>
</head>
<body>
    <h1>Detalhes do Produto</h1>

    <div>
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    </div>

    <a href="{{ route('products.index') }}">Voltar</a>
    <a href="{{ route('products.edit', $product->id) }}">Editar</a>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Excluir</button>
    </form>
</body>
</html>
