const API = "http://localhost:8000";

function listar() {
    fetch(API + "/listar.php")
        .then(resposta => resposta.json())
        .then(jogos => {
            const linhas = jogos.map(jogos => `
                <tr>
                    <td>${jogos.id}</td>
                    
                    <td>${jogos.nome}</td>
                    <td>${jogos.descricao}</td>
                    <td>${jogos.exemplo ? `<a href="${jogos.exemplo}">` : "Sem exemplo"}</td>
                    <td>
                        <button onclick="excluir(${jogos.id})">Excluir</button>
                        <button onclick="atualizar(${jogos.id}, '${jogos.nome}', '${jogos.descricao}', '${jogos.exemplo}')">Atualizar</button>
                    </td>
                </tr>
            `);
            document.getElementById("corpoTabela").innerHTML = linhas.join("");
        });
}