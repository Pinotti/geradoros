function toggleInput(fabricanteId) {
    const divNomeFabricante = document.querySelector('.nome-fabricante');
    const nomeFabricanteEl = document.getElementById(`nome-fabricante-${fabricanteId}`);
    const inputFabricanteEl = document.getElementById(`input-nome-fabricante-${fabricanteId}`);
    if (nomeFabricanteEl.hasAttribute('hidden')) {
        nomeFabricanteEl.removeAttribute('hidden');
        inputFabricanteEl.hidden = true;
        divNomeFabricante.removeAttribute('style');
    } else {
        inputFabricanteEl.removeAttribute('hidden');
        nomeFabricanteEl.hidden = true;
        divNomeFabricante.setAttribute('style', 'display:none;');
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