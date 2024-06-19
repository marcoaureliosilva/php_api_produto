<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>

    @if ($errors->any())
        <div>
            <strong>Oops!</strong> Há alguns problemas com os seus dados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" required>{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Preço:</label>
            <input type="text" name="price" id="price" value="{{ $product->price }}" required>
        </div>
        <button type="submit">Salvar</button>
    </form>

    <a href="{{ route('products.index') }}">Voltar</a>
</body>
</html>
