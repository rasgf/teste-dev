let contatos = [];
let contatosPorPagina = 5;
let paginaAtual = 1;

function setupEventListeners() {
    const formElement = document.querySelector('form');
    if (formElement) {
        formElement.addEventListener('submit', handleFormSubmit);
    }
    
    const addContactBtn = document.getElementById('addContactBtn');
    if (addContactBtn) {
        addContactBtn.addEventListener('click', () => {
            if (formElement) {
                formElement.reset();
                formElement.removeAttribute('data-edit-index');
            }
        });
    }

    const searchBtn = document.getElementById('searchBtn');
    if (searchBtn) {
        searchBtn.addEventListener('click', handleSearch);
    }

    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    console.log("Aplicação inicializada");
    setupEventListeners();
    fetchContatos();
});

async function fetchContatos() {
    try {
        const response = await fetch('/api/contatos');
        if (!response.ok) {
            throw new Error('Erro ao buscar contatos');
        }
        contatos = await response.json();
        console.log('Contatos carregados:', contatos);
        carregarContatos();
    } catch (error) {
        console.error('Erro ao buscar contatos:', error);
        alert('Erro ao carregar contatos. Por favor, tente novamente.');
    }
}

function carregarContatos() {
    const inicio = (paginaAtual - 1) * contatosPorPagina;
    const fim = inicio + contatosPorPagina;
    const contatosParaMostrar = [...contatos].slice(inicio, fim);
    renderContatos(contatosParaMostrar);
    atualizarPaginacao(contatos.length);
}

function renderContatos(contatosParaMostrar) {
    const listaContatos = document.getElementById('contacts-list');
    if (!listaContatos) return;

    listaContatos.innerHTML = '';

    contatosParaMostrar.forEach((contato) => {
        const realIndex = contatos.findIndex(c => c.id === contato.id);
        
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${realIndex + 1}</td>
            <td>${contato.name}</td>
            <td>${contato.telefone}</td>
            <td>${contato.idade}</td>
            <td>
                <button class="btn btn-primary editar-contato" data-index="${realIndex}">Editar</button>
                <button class="btn btn-danger excluir-contato" data-index="${realIndex}">Excluir</button>
                <button class="btn btn-info expandir-contato" data-index="${realIndex}">▼</button>
            </td>
        `;
        listaContatos.appendChild(tr);

        const trDetalhes = document.createElement('tr');
        trDetalhes.classList.add('contato-detalhes');
        trDetalhes.innerHTML = `
            <td colspan="5">
                <div id="contato-detalhes-${realIndex}" style="display: none;">
                    <p><strong>CEP:</strong> ${contato.cep}</p>
                    <p><strong>Rua:</strong> ${contato.rua}</p>
                    <p><strong>Número:</strong> ${contato.numero}</p>
                    <p><strong>Complemento:</strong> ${contato.complemento || ''}</p>
                    <p><strong>Cidade:</strong> ${contato.cidade}</p>
                    <p><strong>Estado:</strong> ${contato.estado}</p>
                </div>
            </td>
        `;
        listaContatos.appendChild(trDetalhes);
    });

    document.querySelectorAll('.editar-contato').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            editarContato(parseInt(index));
        });
    });

    document.querySelectorAll('.excluir-contato').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            excluirContato(parseInt(index));
        });
    });

    document.querySelectorAll('.expandir-contato').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const detalhes = document.getElementById(`contato-detalhes-${index}`);
            if (detalhes) {
                detalhes.style.display = detalhes.style.display === 'none' ? 'block' : 'none';
            }
        });
    });
}

function atualizarPaginacao(totalContatos) {
    const paginacao = document.getElementById('pagination');
    if (!paginacao) return;

    paginacao.innerHTML = '';
    const totalPaginas = Math.ceil(totalContatos / contatosPorPagina);

    for (let i = 1; i <= totalPaginas; i++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        li.classList.toggle('active', i === paginaAtual);
        li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
        paginacao.appendChild(li);
    }

    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            paginaAtual = parseInt(link.getAttribute('data-page'));
            carregarContatos();
        });
    });
}

function handleSearch() {
    const searchInput = document.getElementById('search');
    if (!searchInput) return;

    const searchTerm = searchInput.value.toLowerCase();
    
    if (searchTerm === '') {
        carregarContatos();
    } else {
        const filteredContatos = contatos.filter(contato => 
            contato.name.toLowerCase().includes(searchTerm) ||
            contato.telefone.includes(searchTerm)
        );
        renderContatos(filteredContatos);
        atualizarPaginacao(filteredContatos.length);
    }
}

async function handleFormSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const contato = Object.fromEntries(formData.entries());
    const editIndex = event.target.getAttribute('data-edit-index');

    try {
        let response;
        if (editIndex !== null) {
            const contatoId = contatos[editIndex].id;
            response = await fetch(`/api/contatos/${contatoId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(contato)
            });
        } else {
            response = await fetch('/api/contatos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(contato)
            });
        }

        if (!response.ok) {
            throw new Error('Erro ao salvar contato');
        }

        await fetchContatos();
        event.target.reset();
        event.target.removeAttribute('data-edit-index');
        
        const modalElement = document.getElementById('contactModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        } else {
            const modalBS = new bootstrap.Modal(modalElement);
            modalBS.hide();
        }
    } catch (error) {
        console.error('Erro ao salvar contato:', error);
        alert('Erro ao salvar contato. Por favor, tente novamente.');
    }
}

function editarContato(index) {
    const contato = contatos[index];
    const form = document.querySelector('form');
    if (!form) return;

    form.querySelector('[name="name"]').value = contato.name;
    form.querySelector('[name="telefone"]').value = contato.telefone;
    form.querySelector('[name="idade"]').value = contato.idade;
    form.querySelector('[name="cep"]').value = contato.cep;
    form.querySelector('[name="rua"]').value = contato.rua;
    form.querySelector('[name="numero"]').value = contato.numero;
    form.querySelector('[name="complemento"]').value = contato.complemento || '';
    form.querySelector('[name="cidade"]').value = contato.cidade;
    form.querySelector('[name="estado"]').value = contato.estado;

    form.setAttribute('data-edit-index', index);

    const modalElement = document.getElementById('contactModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
}

async function excluirContato(index) {
    if (confirm('Tem certeza que deseja excluir este contato?')) {
        try {
            const contatoId = contatos[index].id;
            const response = await fetch(`/api/contatos/${contatoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error('Erro ao excluir contato');
            }

            await fetchContatos();
        } catch (error) {
            console.error('Erro ao excluir contato:', error);
            alert('Erro ao excluir contato. Por favor, tente novamente.');
        }
    }
}