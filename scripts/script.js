function confirmarDelecao(usuario) {
    return confirm(`Tem certeza de que deseja deletar o usuário "${usuario}"?`);
}

function confirmarDelecaoHorario(id_horario) {
    return confirm(`Tem certeza de que deseja deletar o horário com ID: ${id_horario}?`);
}

function toggleMenu() {
    var menu = document.getElementById('menu-deslogar');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

window.onclick = function(event) {
    var menu = document.getElementById('menu-deslogar');
    var nomeUsuario = document.getElementById('nome-usuario');
    if (event.target !== nomeUsuario && event.target !== menu) {
        menu.style.display = 'none';
    }
}