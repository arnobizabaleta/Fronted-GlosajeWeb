<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /index.html');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header('Location: /index.html');
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="../styles/loginStyle.css">
  <title>Login</title>
</head>
<body>
    <header>
        <a href="../index.html">Volver al Home</a>
    </header>
    
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  
    <form action="./iniciarSesion.php" method="post">
  
            <h4>Iniciar Sesión</h4>
            <input type="email" placeholder="Ingresar email" name="email"  class="box">
            <input type="password" placeholder="Ingresar password" name="password" class="box">
            <a href="registrarse.php">Aún no tienes cuenta? registrate</a>
            <button class="button" type="submit">ENVIAR</button>
            
        
  </form>
</body>
</html>