function carregarEstados() {
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(data => {
            const estadoSelect = document.getElementById('estado');
            data.forEach(({ nome }) => {
                const option = document.createElement('option');
                option.value = nome; // Usando o nome como valor
                option.textContent = nome;
                estadoSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao obter estados:', error));
}

function carregarEstados() {
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(data => {
            const estadoSelect = document.getElementById('estado');
            data.forEach(({ nome }) => {
                const option = document.createElement('option');
                option.value = nome; // Usando o nome como valor
                option.textContent = nome;
                estadoSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao obter estados:', error));
}

function carregarCidades() {
    const estadoNome = document.getElementById('estado').value; // Obtendo o nome do estado
    const cidadeSelect = document.getElementById('cidade');

    // Limpa as opções atuais
    cidadeSelect.innerHTML = '<option value="" selected disabled>Carregando...</option>';

    // Obter o código do estado
    fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados?nome=${estadoNome}`)
        .then(response => response.json())
        .then(estado => {
            const estadoId = estado[0].id;

            // Obter as cidades usando o código do estado
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
                .then(response => response.json())
                .then(data => {
                    // Atualiza as opções da cidade
                    cidadeSelect.innerHTML = '<option value="" selected disabled>Selecione uma cidade</option>';
                    data.forEach(({ nome }) => {
                        const option = document.createElement('option');
                        option.value = nome; // Usando o nome como valor
                        option.textContent = nome;
                        cidadeSelect.appendChild(option);
                    });

                    // Habilita o dropdown da cidade
                    cidadeSelect.removeAttribute('disabled');
                })
                .catch(error => console.error('Erro ao obter cidades:', error));
        })
        .catch(error => console.error('Erro ao obter código do estado:', error));
}

carregarEstados();




function validarFormulario() {
    // Resetar mensagens de erro
    resetarMensagensErro();

    // Validar campos
    if (!validarCampo('nome')) return false;
    if (!validarCampo('especie')) return false;
    if (!validarCampo('sexo')) return false;
    if (!validarCampo('idade')) return false;
    if (!validarCampo('porte')) return false;
    if (!validarCampo('estado')) return false;
    if (!validarCampo('cidade')) return false;
    // Adicione mais campos conforme necessário

    return true;
}

function validarCampo(campo) {
    var valor = document.getElementById(campo).value.trim();
    var errorElement = document.getElementById(campo + 'Error');

    if (valor === '') {
        errorElement.textContent = 'Preencha  ' + obterNomeCampo(campo);
        return false;
    }

    return true;
}

function obterNomeCampo(campo) {
    // Converte o nome do campo para uma versão mais amigável (opcional)
    var nomeCampo = campo.charAt(0).toUpperCase() + campo.slice(1);
    return nomeCampo.replace(/([A-Z])/g, ' $1').trim(); // Adiciona espaços antes de letras maiúsculas
}

function resetarMensagensErro() {
    var errorElements = document.getElementsByClassName('error-message');
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].textContent = '';
    }
}