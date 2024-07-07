<?php include 'inc/header.php'; ?>
   
<?php 
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conexao,$sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


    <h2>Feedbacks</h2>

    <?php if (empty($feedback)): ?>
<p class="lead mt-3">
  Não tem nenhum Feedback
</p>
<?php else: ?>
  <?php foreach ($feedback as $item): ?>
    <div class="card my-3 w-75">
      <div class="card-body text-center">
        <?php echo $item['bodyFeedback']; ?>
        <div class="text-secondary mt-2">
          Por <?php echo $item['name']; ?> em <?php echo strftime('%d/%m/%Y %H:%M', strtotime($item['date'])); ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

  

   <?php include 'inc/footer.php'; ?>

