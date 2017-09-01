<?php require('partials/header.php'); ?>
    <!-- Page Content -->
    <div class="container top-item">
        <h1><?php echo count($products) . " results for " . $titleProductSearch . "!"; ?></h1>
        <div class="row">
    <!--        --><?php //require('partials/filters.php'); ?>
            <?php foreach ($products as $product) { ?>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="src/Resources/images/<?php echo $product->photo; ?>" height="600" width="600">
                        <div class="caption">
                            <h4>
                                <a href="/iMAG/viewProduct?id=<?php echo $product->id_produs; ?>">
                                    <?php echo $product->title; ?></a>
                            </h4>
                            <h4><?php echo $product->price; ?></h4>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
<?php require('partials/footer.php'); ?>