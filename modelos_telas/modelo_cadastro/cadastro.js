document.getElementById('formLogin').addEventListener('submit', function (event) {

    event.preventDefault();


    var email1 = document.getElementById('email1').value;
    var senha1 = document.getElementById('senha1').value;
    var email2 = document.getElementById('email1').value;
    var senha2 = document.getElementById('senha1').value;

    if (!email1 || !senha1 || !senha2 || !email2) {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
        return;
    } else if (senha1.length < 6) {
        alert("A senha deve ter pelo menos 6 caracteres.");
        event.preventDefault();
        return;
    }

    if (email1.value !== email2.value && senha1 !== senha2) {
        alert("Os campos nao sao iguais ");
        event.preventDefault();
        return;
    }
}
);