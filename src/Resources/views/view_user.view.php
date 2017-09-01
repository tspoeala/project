<?php require('partials/header.php'); ?>
<?php require('partials/errors.php'); ?>
<div class="container top-item">

    <table class="table">
        <tbody>
        <h1><?php echo $userById->firstname; ?> </h1>
        <tr>
            <td>
            <th>id</th>
            </td>
            <td><?php echo $userById->id; ?></td>
        </tr>
        <tr>
            <td>
            <th>First Name</th>
            </td>
            <td><?php echo $userById->firstname; ?></td>
        </tr>
        <tr>
            <td>
            <th>Last Name</th>
            </td>
            <td><?php echo $userById->lastname; ?></td>
        </tr>
        <tr>
            <td>
            <th>Username</th>
            </td>
            <td><?php echo $userById->username; ?></td>
        </tr>
        <tr>
            <td>
            <th>Email</th>
            </td>
            <td><?php echo $userById->email; ?></td>
        </tr>
        <tr>
            <td>
            <th>Role</th>
            </td>
            <td><?php if ($userById->admin) {
                    echo 'admin';
                } else {
                    echo 'user';
                } ?>
            </td>
        </tr>

        </tbody>
    </table>


    <?php if ($user->id === $userById->id) { ?>

        <div class="row" style="margin-top:20px">
            <div class="col-lg-12">
                <form action="addProduct" role="form" method="POST" enctype="multipart/form-data">
                    <h2>Add Product:</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstname">Title:</label>
                        <input type="text" name="title" id="title" class="form-control input-lg"
                               value="<?php echo (isset($productData['title'])) ? trim($productData['title']) : '' ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstname">Price:</label>
                        <input type="text" name="price" id="price" class="form-control input-lg"
                               value="<?php echo (isset($productData['price'])) ? trim($productData['price']) : '' ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstname">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                                  required><?php echo (isset($productData['description'])) ? trim($productData['description']) : '' ?></textarea>
                    </div>
                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Image:</label>
                        <input type="file" name="photo" id="photo" required/><br/><br/>
                    </div>

                    <div class="row" style="margin-bottom:20px">
                        <div class="col-lg-12">
                            <h2>Product characteristics</h2>
                        </div>
                        <div class="form-group col-sm-6">
                            <select class="form-control" id="characteristic" name="characteristic[]">
                                <option value disabled="disabled" selected="selected">
                                    Please select a category...
                                </option>
                                <?php foreach ($characteristics as $characteristic) { ?>
                                    <option value="<?php echo $characteristic['id']; ?>">
                                        <?php echo $characteristic['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="value" name="value[]" value="" required
                                       placeholder="Value">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button" onclick="education_fields();">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="education_fields"></div>

                        <div class="form-group">
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Add">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

    <!-- Products -->
    <div class="row">
        <?php foreach ($products as $product) { ?>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="src/Resources/images/<?php echo $product->photo; ?>" width="100" height="100" alt="">
                    <div class="caption">
                        <h4>
                            <a href="/iMAG/viewProduct?id=<?php echo $product->id_produs; ?>"><?php echo $product->title; ?></a>
                        </h4>
                        <h4><?php echo $product->price; ?> Lei</h4>
                        <?php if ($user->admin != 0 || $product->id_user == $user->id) { ?>
                            <h4><a href="/iMAG/updateProduct?id=<?php echo $product->id_produs; ?>">Update Product</a>
                            </h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Hidden template -->
    <div id="elementTemplate" style="display: none;">
        <div class="form-group col-sm-6">
            <select class="form-control" id="characteristic" name="characteristic[]" required>
                <option value disabled="disabled" selected="selected">Please select a category...
                </option>
                <?php foreach ($characteristics as $characteristic) { ?>
                    <option value="<?php echo $characteristic['id'];
                    ?>">
                        <?php echo $characteristic['name'];
                        ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control" id="value" name="value[]" value="" required
                       placeholder="Value">
                <div class="input-group-btn">
                    <button class="btn btn-danger" type="button" onclick="remove_education_fields(event);">
                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php require 'partials/pagination.php'; ?>
</div>

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="js/page.js"></script>

<?php require('partials/footer.php'); ?>
