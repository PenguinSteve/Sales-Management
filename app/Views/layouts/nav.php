<nav class="navbar navbar-header navbar-expand navbar-light">
    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar mr-1">
                    <img class="image-avatar" src="public/images/avatar/avatar-s-1.png">
                </div>
                <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <?php
                if (!isset($_SESSION['isNeedToChangePassword'])) {
                    echo "<a class=\"dropdown-item\" href=\"user/index\"><i data-feather=\"user\"></i> Account</a>";
                    echo "<a class=\"dropdown-item\" href=\"user/changePassword\"><i data-feather=\"lock\"></i> Change password</a>";
                }
                ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="home/logout"><i data-feather="log-out"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>