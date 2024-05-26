<?php if (isset($_SESSION['announce'])) : ?>
    <div id="announce" class="announce toast z-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" style="width: 18rem; height: fit-content; float: right;">

        <div class="toast-header">
            <i class="bi bi-exclamation-triangle" style="color: #2178d1;"></i>
            <strong class="mr-auto ml-3" style="color: #2178d1">Message</strong>
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="toast-body">
            <?php echo $_SESSION['announce'] ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var delay = $('#announce').data('delay');

            // Show the toast notification
            $('#announce').toast('show');

            // Hide the toast notification after the specified delay
            setTimeout(function() {
                $('#announce').toast('hide');
            }, delay);
        });
    </script>
<?php
    unset($_SESSION['announce']);
endif;
?>