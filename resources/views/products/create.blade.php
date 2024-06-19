<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Produto</h1>

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

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="price">Preço:</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}" required>
        </div>
        <button type="submit">Salvar</button>
    </form>

    <a href="{{ route('products.index') }}">Voltar</a>
</body>
</html>
