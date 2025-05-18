<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acesso inválido! Use o formulário de login.');
}

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: http://localhost/GestaoEPI/codes/php/logar.php"); exit;
  }

  var_dump($_POST); // Para ver o que está chegando

  $usuario = $_POST['login'];
  $senha = $_POST['senha'];

  // Validação do usuário/senha digitados
  $sql = "SELECT `id`, `nivel_acesso` FROM `usuarios` WHERE (`nome` = '". $usuario ."') AND (`senha` = '". sha1($senha) ."') LIMIT 1";
  echo $sql; // Adicione esta linha para depuração
  $query = mysqli_query($conn, $sql);
  if (!$query) {
      die("Erro na consulta: " . mysqli_error($conn));
  }

  if (mysqli_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
      echo "Login inválido!"; exit;
  } else {
      // Salva os dados encontados na variável $resultado
      $resultado = mysqli_fetch_assoc($query);

      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['usuario_id'] = $resultado['id'];
      $_SESSION['nivel_acesso'] = $resultado['nivel_acesso'];
      

  }

  if (isset($_SESSION['usuario_id']) AND ($_SESSION['nivel_acesso'] == 1)) {

    
    // Redireciona o visitante de volta pro login
    header("Location: http://localhost/GestaoEPI/codes/Gestor/telaGestor.php");

}elseif (isset($_SESSION['usuario_id']) AND ($_SESSION['nivel_acesso'] == 2)) {
    // Redireciona o visitante de volta pro login
    header("Location: http://localhost/GestaoEPI/codes/SegurancaDoTrabalho/telaSeguranca.php");

}elseif (isset($_SESSION['usuario_id']) AND ($_SESSION['nivel_acesso'] == 3)) {
    // Redireciona o visitante de volta pro login
    header("Location: http://localhost/GestaoEPI/codes/Logistica/telaLogistica.php");
}
elseif (isset($_SESSION['usuario_id']) AND ($_SESSION['nivel_acesso'] == 4)) {
    // Redireciona o visitante de volta pro login
    header("Location: http://localhost/GestaoEPI/codes/RH/telaRH.php");
}
elseif (isset($_SESSION['usuario_id']) AND ($_SESSION['nivel_acesso'])== 5) {
    // Redireciona o visitante de volta pro login
    header("Location: http://localhost/GestaoEPI/codes/admin/admin.php");
}
else{
    session_destroy();
    header("Location: http://localhost/GestaoEPI/codes/php/logar.php"); exit;
}

?>