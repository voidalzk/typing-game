<?php 
function verify_txt($txt){
    $txt = trim($txt);
    $txt = stripslashes($txt);
    $txt = htmlspecialchars($txt);
    return $txt;
  }

  $username = $email = $c_email = $password = $c_password = "";
  $err = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //verifica username
    if(empty($_POST["username"])){
        $err_username = "Nome de usuário é obrigatório.";
        $err = true;
      }
      else{
        $username = verify_txt($_POST["username"]);
      }

      //verifica email
      if(empty($_POST["email"])){
        $err_email = "Email é obrigatório.";
        $err = true;
      }
      else{
        $email = verify_txt($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $err_email = "Formato de email inválido.";
          $err = true;
        }
      }

      //verifica c_email
      if(empty($_POST["c_email"])){
        $err_c_email = "Confirmação de Email é obrigatória.";
        $err = true;
      } 
      else{
        $c_email = verify_txt($_POST["c_email"]);
        if($c_email !== $email){
            $err_c_email = "Os E-mails devem ser iguais.";
            $err = true;
        }
      }

      //verifica password
      if(empty($_POST["password"])){
        $err_password = "Senha é obrigatória.";
        $err = true;
      }
      else{
        $password = verify_txt($_POST["password"]);
      }

      //verifica c_password
      if(empty($_POST["c_password"])){
        $err_c_password = "Confirmação de senha é obrigatória.";
        $err = true;
      }
      else{
        $c_password = verify_txt($_POST["c_password"]);
        if($c_password !== $password){
            $err_c_password = "As senhas devem ser iguais.";
            $err = true;
        }
      }

  }
?>