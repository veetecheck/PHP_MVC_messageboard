<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <h1 class="display-5"><?php echo $data['title']?></h1>
</div>

<?php $this->view('includes/footer') ?>