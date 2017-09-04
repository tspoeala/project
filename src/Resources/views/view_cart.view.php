<?php require('partials/header.php'); ?>
<?php require('partials/errors.php'); ?>

    <div class="container">
        <div class="row">


            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <?php if (count($cart)) { ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th class="text-center">Price</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($products as $product) {
                            $total = $total + $product->price; ?>
                            <tr class="product_<?php echo $product->id_produs ?>"
                                id="product_<?php echo $product->id_produs ?>">
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <img class="media-object"
                                             src="src/Resources/images/<?php echo $product->photo; ?>"
                                             style="width: 72px; height: 72px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="/iMAG/viewProduct?id=<?php echo $product->id_produs; ?>">
                                                    <?php echo $product->title; ?>
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center_<?php echo $product->id_produs ?>">
                                    <strong><?php echo $product->price; ?>Lei</strong>
                                </td>
                                <td class="col-sm-1 col-md-1">
                                    <button name="removeFromCart"
                                            id="removeFromCart_<?php echo $product->id_produs ?>"
                                            type="button"
                                            class="btn btn-danger"
                                            data-productId="<?php echo $product->id_produs; ?>"
                                            onclick="deleteProduct(<?php echo $product->id_produs; ?>)">
                                        <span class="glyphicon glyphicon-remove"></span> Remove
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><h3>Total</h3></td>
                            <td class="text-right">
                                <h3 class="total"><?php echo $total; ?>Lei</h3>
                            </td>
                        </tr>

                        </tfoot>
                    </table>
                <?php } ?>
                <form action="/iMAG" method="post">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="js/cart.js"></script>
<?php require('partials/footer.php'); ?>