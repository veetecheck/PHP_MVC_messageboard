<?php
$this->view('includes/header');
$this->view('includes/navbar');
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <h1 class="display-5">Posts page</h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-primary float-end" href="<?php echo URLROOT; ?>/posts/add">Add post</a>
        </div>
    </div>

    <?php foreach ($data['posts'] as $post) : ?>
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $post->title; ?>
                </h5>
                <hr>
                <p class="card-text">
                    <?php echo $post->text; ?>
                </p>
                <p class="card-text">
                    <i>Written by <?php echo $post->username; ?></i>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php $this->view('includes/footer') ?>