<?php require('partials/header.php'); ?>
<?php require('partials/errors.php'); ?>

<div class="container top-item">

    <!-- Products -->
    <div class="col-sm-6 col-lg-6 col-md-6">
        <img src="src/Resources/images/<?php echo $product->photo; ?>" width="75%" height="75%" alt="">


        <table class="table">
            <tbody>
            <h1><?php echo $product->title; ?> </h1>
            <tr>
                <td>
                <th>Id</th>
                </td>
                <td><?php echo $product->id_produs; ?></td>
            </tr>
            <tr>
            <tr>
                <td>
                <th>Pret</th>
                </td>
                <td><?php echo $product->price; ?> Lei</td>
            </tr>
            <tr>
                <td>
                <th>Descriere</th>
                </td>
                <td><?php echo $product->description; ?></td>
            </tr>
            <tr>
                <td>
                <th>Adaugat de</th>
                </td>
                <td><?php echo $userOfProduct['username']; ?></td>
            </tr>
            <?php if (!empty($characteristics)) {
                foreach ($characteristics as $key => $characteristic) { ?>
                    <tr>
                        <td>
                        <th>
                            <?php echo $characteristic['name']; ?>
                        </th>
                        </td>

                        <td>
                            <?php echo $characteristic['value']; ?>
                        </td>

                    </tr>
                <?php }?>
               <?php} ?>
            <?php if (isset($user) && $user->id != $product->id_user) { ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <button name="addToCart" class="btn" id="addToCart"
                                data-productId="<?php echo $product->id_produs; ?>">
                            Adauga in cos
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="js/viewProduct.js"></script>

    <?php require('partials/footer.php'); ?>
