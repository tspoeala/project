<?php require('partials/header.php'); ?>
    <div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="POST" action="users"">
            <h2>Please Sign Up
                <small>It's free and always will be.</small>
            </h2>
            <hr class="colorgraph">
            <div class="row">
                <?php if (isset($errors)) { ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $key => $error) { ?>
                            <p><?php echo $error ?></p>
                        <?php } ?>
                    </div>
                <?php }
                if (isset($success)) { ?>
                    <div class="alert alert-success">
                        <?php echo $success ?>
                    </div>
                <?php } ?>


                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="first_name" id="first_name" required
                               class="form-control input-lg"
                               placeholder="First Name"
                               value="<?php if (isset($formData['first_name']) && !empty($errors)) {
                                   echo $formData['first_name'];
                               } ?>" tabindex="1">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="last_name" id="last_name" required
                               class="form-control input-lg"
                               placeholder="Last Name"
                               value="<?php if (isset($formData['last_name']) && !empty($errors)) {
                                   echo $formData['last_name'];
                               } ?>" tabindex="2">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="display_name" id="display_name" required class="form-control input-lg"
                       placeholder="Display Name"
                       value="<?php if (isset($formData['display_name']) && !empty($errors)) {
                           echo $formData['display_name'];
                       } ?>" tabindex="3">
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" required class="form-control input-lg"
                       placeholder="Email Address"
                       value="<?php if (isset($formData['email']) && !empty($errors)) {
                           echo $formData['email'];
                       } ?>" tabindex="4">
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="password" name="password" id="password" required
                               class="form-control input-lg"
                               placeholder="Password" tabindex="5">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                    </div>
                </div>
            </div>

            <hr class="colorgraph">
            <div class="row">
                <div class="col-xs-12 col-md-6"><input type="submit" value="Register"
                                                       class="btn btn-primary btn-block btn-lg" tabindex="7">
                </div>
                <div class="col-xs-12 col-md-6"><a href="login"
                                                   class="btn btn-success btn-block btn-lg">Sign In</a>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
<?php require('partials/footer.php'); ?>