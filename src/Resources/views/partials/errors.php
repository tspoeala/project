<?php if (isset($errors)) { ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $key => $error) { ?>
            <p><?php echo $error ?></p>
        <?php } ?>
    </div>
<?php }
unset($errors);


