<nav class="nav1 navbar navbar-expand-lg navbar-dark" style="background-color:#3AC162" >
    <div class="container">
        <a style="font-weight: bold;" class="navbar-brand" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a style="font-weight: bold;" class="nav-link" href="categories.php"><?php echo lang('CATEGORIES') ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                        <a style="font-weight: bold;" class="nav-link" href="items.php"><?php echo lang('ITEMS') ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                        <a style="font-weight: bold;" class="nav-link" href="members.php"><?php echo lang('MEMBERS') ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                        <a style="font-weight: bold;" class="nav-link" href="comments.php"><?php echo lang('COMMENTS') ?> <span class="sr-only">(current)</span></a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown nav-item active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <strong>Dropdown</strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../index.php">Visit Shop</a>
                        <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">Edit profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="Logout.php">Logout</a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>
