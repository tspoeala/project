<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/iMAG">iMAG</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/iMAG">Home <span class="sr-only">(current)</span></a></li>
                <?php if (isset($user)) { ?>
                    <li><a href="tableUsers">Users <span class="sr-only">(current)</span></a></li>
                <?php } ?>
            </ul>
            <div class="col-sm-3 col-md-3">
                <form method="get" action="/iMAG/search" id="searchform"
                      class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="name">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="/iMAG/cart">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <span><?php if (isset($user)) {
                                echo isset($totalProducts) ? $totalProducts : '0';
                            } ?>
                            Items</span>
                    </a>

                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!isset($user)) { ?>
                    <li><a href="login">Login</a></li>
                    <li><a href="register">Register</a></li>
                <?php } else { ?>
                    <li><a>Hello <?php echo $user->username; ?>!</a></li>
                    <li><a href="logout">Logout</a></li>
                <?php } ?>
            </ul>

        </div>
    </div>
</nav>
