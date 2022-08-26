@extends('app.layouts.basico')

@section('titulo', 'Fabricantes')

@section('conteudo')
<div class="header">
    <h1>Fabricantes</h1>
</div>

<div id="nome-obrigatorio" class="alert alert-danger" hidden>Nome: Campo obrigatório</div>


<div class="content-header">
    <div>
        <button id="add_novo" class="btn btn-dark pull-left" onclick="novaLinha()">Novo</button>
    </div>
    <div>
        <div class="pesquisar">
            <form action="{{ route('fabricante.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control mr-2" name="term" placeholder="Pesquisar" id="term">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" title="Pesquisar">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="content">
    <ul id="ul" class="list-group">
        @foreach ($fabricantes as $fabricante)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="nome-fabricante-{{ $fabricante->id }}">
                    <span id="nome-fabricante-{{ $fabricante->id }}">{{ $fabricante->nome }}</span>
                </div>

                <div class="input-group w-50" hidden id="input-nome-fabricante-{{ $fabricante->id }}">
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ $fabricante->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarFabricante({{ $fabricante->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $fabricante->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('fabricante.destroy', $fabricante->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($fabricante->nome) }}?')">
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
    <div class="paginate">
        <div class="pages">
            {{ $fabricantes->appends([
                'term' => request()->get('term', '')
            ])->onEachSide(1)->links() }}
        </div>
        <div class="labels">
            {{ $fabricantes->firstItem() }} a {{ $fabricantes->lastItem() }} de {{ $fabricantes->total() }}
        </div>
    </div>
</div>
@endsection
