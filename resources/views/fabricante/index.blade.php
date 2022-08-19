<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7989db13d4.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <a href="#" class="navbar-brand">Home</a>
    </nav>
    <div class="container">
        <h1>Fabricantes</h1>
    </div>

    <div class="header">
        <div class="">
            <button id="add_novo" class="btn btn-dark pull-left" onclick="novaLinha()">Novo</button>
        </div>
        <div>
            <div>
                <form action="{{ route('fabricante.index') }}" method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2" name="term" placeholder="Pesquisar" id="term">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Pesquisar">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="corpo">
        <ul id="ul" class="list-group">
            @foreach ($fabricantes as $fabricante)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span id="nome-fabricante-{{ $fabricante->id }}">{{ $fabricante->nome }}</span>
                    </div>

                    <div class="input-group w-50" hidden id="input-nome-fabricante-{{ $fabricante->id }}">
                        <input type="text" class="form-control" value="{{ $fabricante->nome }}">
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
        {{ $fabricantes->currentPage() }}
    </div>

    <script>

        function toggleInput(fabricanteId) {
            const nomeFabricanteEl = document.getElementById(`nome-fabricante-${fabricanteId}`);
            const inputFabricanteEl = document.getElementById(`input-nome-fabricante-${fabricanteId}`);
            if (nomeFabricanteEl.hasAttribute('hidden')) {
                nomeFabricanteEl.removeAttribute('hidden');
                inputFabricanteEl.hidden = true;
            } else {
                inputFabricanteEl.removeAttribute('hidden');
                nomeFabricanteEl.hidden = true;
            }
        }
    
        function editarFabricante(fabricanteId) {
            let formData = new FormData();
            const nome = document.querySelector(`#input-nome-fabricante-${fabricanteId} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;
            formData.append('nome', nome);
            formData.append('_token', token);
    
            const url = `/fabricante/${fabricanteId}/update`;
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(fabricanteId);
                document.getElementById(`nome-fabricante-${fabricanteId}`).textContent = nome;
            });
        }

        function novaLinha() {            
            const novaLinha = document.getElementById('novaLinha');

            if (novaLinha === null) {
                const novoEl = document.createElement('li');
                novoEl.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center');
                novoEl.setAttribute('id', 'novaLinha');
                
                const div = document.createElement('div');
                div.setAttribute('class', 'input-group w-50');

                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('class', 'form-control');
                input.setAttribute('id', 'idNovalinha');

                const btn = document.createElement('button');
                btn.setAttribute('class', 'btn btn-primary');
                btn.setAttribute('onclick', 'insereRegistro()');

                const i = document.createElement('i');
                i.setAttribute('class', 'fas fa-check');

                btn.appendChild(i);
                div.appendChild(input);
                div.appendChild(btn);
                novoEl.appendChild(div);
                
                document.getElementById('ul').insertAdjacentElement('afterbegin', novoEl);
            } else {
                const li = document.getElementById('novaLinha');
                li.parentNode.removeChild(li);
            }
        }
        
        function insereRegistro() {
            let nome = document.querySelector('#idNovalinha').value;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/fabricante/store', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                   },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    nome: nome
                })
            }).then((data) => {
                window.location.href = '/fabricante';
            }).catch(function(error) {
                console.log(error);
            });
        }

    </script>
</body>
</html>
