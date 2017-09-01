<?php require('partials/header.php'); ?>

    <div class="container top-item">
<?php require('partials/errors.php'); ?>
    <h1>Produse filtrate</h1>

    <div class="row">
        <?php require('partials/filters.php'); ?>
        <?php foreach ($products as $product) { ?>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="/iMAG/viewProduct?id=<?php echo $product['id_produs']; ?>">
                        <img src="src/Resources/images/<?php echo $product['photo']; ?>">
                        <div class="caption">
                            <h4><?php echo $product['title']; ?></h4>
                            <h4><?php echo $product['price']; ?> Lei</h4>
                        </div>
                    </a>

                    <?php if (isset($esteLogat) && ($user->admin != 0 || $product->id_user == $user->id)) { ?>
                        <a href="/iMAG/updateProduct?id=<?php echo $product['id_produs']; ?>">Update
                            Product
                        </a>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
    </div>
    </div>


<?php require 'partials/pagination.php'; ?>
<?php require('partials/footer.php'); ?>