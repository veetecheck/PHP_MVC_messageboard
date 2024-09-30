<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2 class="my-3 display-5">Login</h2>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <!-- username input -->
                <label for="username">Username</label>
                <input type="text" name="username"
                    class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['username']; ?>">
                <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                <!-- password input -->
                <label for="password">Password</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                <!-- submit button -->
                <div class="mt-2">
                    <input type="submit" value="Login" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>