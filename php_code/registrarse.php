<?php
  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/loginStyle.css">
    <title>singUp</title>
</head>
<body>
    <header>
        <a href="../index.html">Volver al Home</a>
    </header>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>  

   
            <form action="registrarse.php" method="post">
              
            <input type="email" placeholder="Ingresar email" name="email"  class="box">
            <input type="password" placeholder="Ingresar password" name="password"  class="box">
            <input type="password" placeholder="Confirma tu password" name="confirm_password" class="box"> 
            <a href="iniciarSesion.php">Ya tienes cuenta? Inicia Sesión</a>
            <button class="button" type="submit">ENVIAR</button>
            </form>
            
</body>
</html>