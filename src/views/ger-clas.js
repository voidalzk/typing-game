function toggleFields() {
    var acao = document.getElementById("acao").value;
    var criarClaDiv = document.getElementById("criar-cla");
    var entrarClaDiv = document.getElementById("entrar-cla");

    if (acao === "criar") {
        criarClaDiv.style.display = "block";
        entrarClaDiv.style.display = "none";
    } else if (acao === "entrar") {
        criarClaDiv.style.display = "none";
        entrarClaDiv.style.display = "block";
    }
}
