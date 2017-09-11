<?php require('partials/header.php'); ?>
    <!-- Page Content -->
    <div class="container top-item">
        <h1><?php echo count($products) . " results for " . $titleProductSearch . "!"; ?></h1>
        <div class="row">
            <?php foreach ($products as $product) { ?>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail" style="height: 350px; width:350px">
                        <a style="margin: 10px;" href="/iMAG/viewProduct?id=<?php echo $product->id_produs; ?>">
                            <img style="width: 174px; height: 174px;"
                                 src="src/Resources/images/<?php echo $product->photo; ?>">
                            <div class="caption" style="height: 100px;margin:10px;">
                                <h4><?php echo $product->title; ?></h4>
                                <h4><?php echo $product->price; ?> Lei</h4>
                            </div>
                        </a>
                        <?php if (isset($esteLogat) && ($user->admin != 0 || $product->id_user == $user->id)) { ?>
                            <a href="/iMAG/updateProduct?id=<?php echo $product->id_produs; ?>">Update Product
                            </a>
                        <?php } ?>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
<?php require 'partials/pagination.php'; ?>
<?php require('partials/footer.php'); ?>