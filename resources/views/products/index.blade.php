<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>

    <a href="{{ route('products.create') }}">Adicionar Produto</a>

    @foreach ($products as $product)
        <div>
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            <a href="{{ route('products.show', $product->id) }}">Ver Detalhes</a>
            <a href="{{ route('products.edit', $product->id) }}">Editar</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir</button>
            </form>
        </div>
        <hr>
    @endforeach
</body>
</html>
