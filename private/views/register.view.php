<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2>Create an account</h2>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </form>
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>