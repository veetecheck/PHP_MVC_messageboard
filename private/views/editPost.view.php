<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2 class="my-3 display-5">Edit post</h2>
            <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
                <!-- title input -->
                <label for="title">Title</label>
                <input type="text" name="title"
                    class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                <!-- password input -->
                <label for="text">Post text</label>
                <textarea name="text"
                    class="form-control <?php echo (!empty($data['text_err'])) ? 'is-invalid' : ''; ?>"
                    ><?php echo $data['text']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['text_err']; ?></span>
                <!-- submit button -->
                <div class="mt-2">
                    <input type="submit" value="Edit post" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>