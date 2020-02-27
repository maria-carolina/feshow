<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <style>
        input, button, select {
            display: block;
        }
    </style>
</head>
<body>
    <ul>
        <li>Nome: {{ $artista->nome }}</li>
        <li>E-Mail: {{ $artista->email }}</li>
        <li>Quantidade de membros: {{ $artista->quantidade_membros }}</li>
        <li>Telefone: {{ $artista->telefone }}</li>
        <li>Cidade: {{ $artista->cidade }}</li>
        <li>Genero: {{ $genero->nome }}</li>
    </ul>
    <button><a href="{{ route('abrir_edicao', $artista->id)}}">Editar</a></button>
</body>
</html>
