<?php require('partials/header.php'); ?>
<div class="container top-item">
    <form class="form-horizontal" action="update" method="post">
        <fieldset>

            <!-- Form Name -->
            <legend>UPDATE USER</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="firstname">Firstname</label>
                <div class="col-md-4">
                    <input id="firstname" name="firstname" type="text" placeholder="" class="form-control input-md"
                           value="<?php echo $userById->firstname; ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="lastname">Lastname</label>
                <div class="col-md-4">
                    <input id="lastname" name="lastname" type="text" placeholder="" class="form-control input-md"
                           value="<?php echo $userById->lastname; ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">Username</label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="" class="form-control input-md"
                           value="<?php echo $userById->username; ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="" class="form-control input-md"
                           value="<?php echo $userById->email; ?>" required>

                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="button1idFFF"></label>
                <div class="col-md-8">
                    <button id="button1idFFF" name="button1idFFF" class="btn btn-success">UPDATE</button>
                    <a href="tableUsers" id="button2id" name="button2id" class="btn btn-danger">CANCEL</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
<?php require('partials/footer.php'); ?>
