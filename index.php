<?php include 'inc/header.php'; ?>

<?php
$name = $email = $bodyFeedback = '';
$nameErr = $emailErr = $bodyFeedbackErr = '';

// Formulário de envio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validação do nome
  if (empty($_POST['name'])) {
    $nameErr = 'Nome é obrigatório';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  }
  // Validação do email
  if (empty($_POST['email'])) {
    $emailErr = 'E-mail é obrigatório';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'Formato de e-mail inválido';
    }
  }
  // Validação do feedback
  if (empty($_POST['body'])) {
    $bodyFeedbackErr = 'É obrigatório colocar um feedback para poder enviar.';
  } else {
    $bodyFeedback = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
  }

  // Se não houver erros, proceder com a inserção no banco de dados
  if (empty($nameErr) && empty($emailErr) && empty($bodyFeedbackErr)) {
    // SQL Insert no banco de dados
    $sql = "INSERT INTO feedback (name, email, bodyFeedback) VALUES ('$name', '$email', '$bodyFeedback')";
    if (mysqli_query($conexao, $sql)) {
      // Redirecionamento após inserção bem-sucedida
      header('Location: feedback.php');
      exit;
    } else {
      // Exibir erro se a query falhar
      echo 'Error: ' . mysqli_error($conexao);
    }
  }
}
?>

<img src="img/logo.png" class="w-25 mb-3" alt="">
<h2>Feedback</h2>
<p class="lead text-center">Seu feedback é importante para nossa empresa!</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4 w-75">
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control <?php echo !empty($nameErr) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Informe seu nome" value="<?php echo htmlspecialchars($name); ?>">
    <div class="invalid-feedback">
      <?php echo $nameErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Informe seu e-mail" value="<?php echo htmlspecialchars($email); ?>">
    <div class="invalid-feedback">
      <?php echo $emailErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <textarea class="form-control <?php echo !empty($bodyFeedbackErr) ? 'is-invalid' : ''; ?>" id="body" name="body" placeholder="Deixe seu feedback"><?php echo htmlspecialchars($bodyFeedback); ?></textarea>
    <div class="invalid-feedback">
      <?php echo $bodyFeedbackErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Enviar" class="btn btn-dark w-100">
  </div>
</form>

<?php include 'inc/footer.php'; ?>
