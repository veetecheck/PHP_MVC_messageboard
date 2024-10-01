<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <h1 class="display-5 text-center my-5"><?php echo $data['title'] ?></h1>
    <p><?php echo $data['description'] ?></p>
</div>

<?php $this->view('includes/footer') ?>