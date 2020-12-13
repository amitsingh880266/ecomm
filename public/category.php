<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT. DS ."header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Products</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <?php    get_products_in_cat_page() ?>
        <div class="row text-center">

            


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <?php include(TEMPLATE_FRONT. DS ."footer.php") ?>