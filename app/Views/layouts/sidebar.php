<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">

        <!--Logo-->
        <div class="sidebar-header">
            <a href="home">
                <h1>Home</h1>
            </a>
        </div>

        <!--Content-->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>

                <li class="sidebar-item">
                    <a href="statistics/" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Reporting and Analytics</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="transaction/" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Transaction Processing</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="product/" class='sidebar-link'>
                        <i data-feather="briefcase" width="20"></i>
                        <span>Product Catalog</span>
                    </a>
                </li>

                <li class='sidebar-title'>Users</li>

                <?php
                if ($currentUser['role'] === "admin") {
                    echo "<li class=\"sidebar-item\">
                    <a href=\"admin/\" class='sidebar-link'>
                        <i data-feather=\"layout\" width=\"20\"></i>
                        <span>Account</span>
                    </a>
                    </li>";
                }
                ?>

                <li class="sidebar-item">
                    <a href="customer/" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i>
                        <span>Customer</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // function removeActive() {
    //     $('a').removeClass('active')

    // }

    // $('a[href="statistics/"]').click(function() {
    //     // removeActive()

    //     // $(this).closest('li').addClass('active')
    //     console.log($(this))

    // })

    // $('a[href="customer/"]').click(function() {
    //     removeActive()

    //     $(this).closest('li').addClass('active')

    // })

    

</script>