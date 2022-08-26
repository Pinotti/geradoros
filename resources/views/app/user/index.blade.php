@extends('app.layouts.basico')

@section('titulo', 'Usuários')

@section('conteudo')

<div class="header">
    <h1>Usuários</h1>
</div>

<div class="content-header">
    <form action="{{ route('user.create') }}" method="POST">
        @csrf
        <button class="btn btn-dark pull-left">Novo</button>
    </form>
</div>

<div class="content">
    <ul id="ul" class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="user-{{ $user->id }}">
                    <span>{{ $user->name }}</span>
                </div>

                <span class="d-flex">
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $user->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($user->name) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
