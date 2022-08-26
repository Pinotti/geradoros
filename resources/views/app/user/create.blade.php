@extends('app.layouts.basico')

@section('titulo', 'Usuários')

@section('conteudo')

<div class="header">
    <h1>Usuários - Cadastro</h1>
</div>
<div class="content">
    <div class="error">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="form">
        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col col-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="col col-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
            </div>

            <div class="row">
                <div class="col col-6">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha">
                </div>

                <div class="col col-6">
                    <label for="perfil">Perfil:</label>
                    <select name="perfil" id="perfil" class="form-control">
                        <option value="0">Selecione</option>
                        <option value="1">Administrador</option>
                        <option value="2">Adminitrativo</option>
                        <option value="3">Operacional</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit">Salvar</button>
        </form>
    </div>
</div>

@endsection