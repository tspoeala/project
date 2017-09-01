<?php require('partials/header.php'); ?>
<?php require('partials/errors.php'); ?>

<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form action="updateProduct" role="form" method="post"
                  enctype="multipart/form-data">
                <fieldset>
                    <h2>Update Product:</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstname">Title:</label>
                        <input type="text" name="title" id="title" class="form-control input-lg"
                               value="<?php echo $product->title; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="price">Price:</label>
                        <input type="text" name="price" id="price" class="form-control input-lg"
                               value="<?php echo $product->price; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="description">Description:</label>
                        <textarea class="form-control" rows="5" id="description"
                                  name="description"><?php echo trim($product->description); ?>
                        </textarea>
                    </div>
                    <!--                             File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="photo">Optional:</label>
                        <div class="col-md-4">
                            <input type="file" name="photo" id="photo">
                            <img src="src/Resources/images/<?php echo $product->photo; ?>" height="600" width="600"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Save">
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>

</div>

<?php require('partials/footer.php'); ?>
