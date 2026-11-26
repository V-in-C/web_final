const API = "http://localhost:8000";

function listar() {
    fetch(API + "/listar.php")
        .then(resposta => resposta.json())
        .then(jogos => {
            const linhas = jogos.map(jogo => `
                <tr>
                    <td>${jogo.id}</td>
                    
                    <td>${jogo.nome}</td>
                    <td>${jogo.descricao}</td>
                    <td>
                        ${jogos.exemplo ? `<a href="${jogo.exemplo}" alt="${jogo.nome}">` : "Sem exemplo"}
                        <button onclick="trocarExemplo(${jogo.id})">Trocar Link</button>
                        <button onclick="removerExemplo(${jogo.id})">Remover Link</button>
                    </td>
                    <td>
                        <button onclick="excluir(${jogo.id})">Excluir</button>
                        <button onclick="atualizar(${jogo.id}, '${jogo.nome}', '${jogo.descricao}')">Atualizar</button>
                    </td>
                </tr>
            `);
            document.getElementById("corpoTabela").innerHTML = linhas.join("");
        });
}

function cadastrar(){
    const jogo = {
        nome: document.getElementById("nome").value,
        descricao: document.getElementById("descricao").value,
        exemplo: document.getElementById("exemplo").value
    };

    fetch(API + "/cadastrar.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(jogo)
    })
        .then(resposta => resposta.json())
        .then(dados => {
            alert(dados.mensagem || dados.erro);
            document.getElementById("nome").value = "";
            document.getElementById("descricao").value = "";
            document.getElementById("exemplo").value = "";
            listar();
        });
}

function atualizar(id, nomeAtual, descrocaoAtual) {
    const nome = prompt("Novo nome:", nomeAtual);
    const descricao = prompt("Nova descricao:", descrocaoAtual);



    if (nome === null || descricao === null) {
        return;
    }

    fetch(API + "/atualizar.php", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id, nome: nome, descricao: descricao})
    })
        .then(resposta => resposta.json())
        .then(dados => {
            alert(dados.mensagem || dados.erro);
            listar();
        });
}

function excluir(id) {
    if (!confirm("Deseja realmente excluir este jogo?")) {
        return;
    }

    fetch(API + "/excluir.php", {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id })
    })
        .then(resposta => resposta.json())
        .then(dados => {
            alert(dados.mensagem || dados.erro);
            listar();
        });
}

function salvarExemplo(id, link) {
    fetch(API + "/exemplo.php", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id, exemplo: link })
    })
        .then(resposta => resposta.json())
        .then(dados => {
            alert(dados.mensagem || dados.erro);
            listar();
        });
}

function trocarExemplo(id) {
    const link = prompt("Link do novo exemplo:");
    if (link === null) {
        return;
    }
    salvarExemplo(id, link);
}

function removerExemplo(id) {
    if (!confirm("Deseja remover o exemplo deste jogo?")) {
        return;
    }
    salvarExemplo(id, "");
}

listar();