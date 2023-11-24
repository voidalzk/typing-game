document.getElementById('loginForm').addEventListener('submit', function (event) {

    event.preventDefault();


    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;


    if (!email || !password) {
        alert("Por favor, preencha todos os campos.");
    } else if (password.length < 6) {
        alert("A senha deve ter pelo menos 6 caracteres.");
    }


}
);