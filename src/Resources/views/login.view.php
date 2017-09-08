<?php require('partials/header.php'); ?>
    <div class="container top-item">

        <div class="row" style="margin-top:20px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="POST">
                    <fieldset>
                        <h2>Please Sign In</h2>
                        <hr class="colorgraph">
                        <?php require('partials/errors.php'); ?>
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control input-lg"
                                   placeholder="Email Address" value=
                                   " <?php if (isset($email)) {
                                       echo $email;
                                   } ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg"
                                   placeholder="Password">
                        </div>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <a href="/iMAG/register" class="btn btn-lg btn-primary btn-block">Register</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
<?php require('partials/footer.php'); ?>