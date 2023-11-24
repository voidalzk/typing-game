document.getElementById('formLogin').addEventListener('submit', function (event) {
    event.preventDefault();

    var errorclass = document.getElementsByClassName('error');
    for (var i = 0; i < errorclass.length; i++) {
        errorclass[i].style.display = 'block';
    }
    var username = document.getElementById('username').value;
    var email1 = document.getElementById('email1').value;
    var password1 = document.getElementById('password1').value;
    var email2 = document.getElementById('email2').value;
    var password2 = document.getElementById('password2').value;

    var msgerrorusername = document.getElementById('errorusername');
    var msgerroremail1 = document.getElementById('erroremail1');
    var msgerroremail2 = document.getElementById('erroremail2');
    var msgerrorpassword1 = document.getElementById('errorpassword1');
    var msgerrorpassword2 = document.getElementById('errorpassword2');

    msgerrorusername.innerHTML = '';
    msgerroremail1.innerHTML = '';
    msgerroremail2.innerHTML = '';
    msgerrorpassword1.innerHTML = '';
    msgerrorpassword2.innerHTML = '';

    if (!email1 || !password1 || !password2 || !email2 || !username) {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
    } else if (password1.length < 6) {
        msgerrorpassword1.innerHTML = 'A senha deve ter pelo menos 6 caracteres.'
        event.preventDefault();
    }
    if (email1 !== email2 || password1 !== password2) {
        msgerroremail2.innerHTML = 'Os campos não são iguais';
        msgerrorpassword2.innerHTML = 'Os campos não são iguais';
        event.preventDefault();
    }
});
