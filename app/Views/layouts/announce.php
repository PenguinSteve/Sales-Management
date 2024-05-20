<?php if (isset($_SESSION['announce'])) : ?>
    <div id="announce" class="announce toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">

        <div class="toast-header">
            <i class="bi bi-exclamation-triangle"></i>
            <strong class="mr-auto ml-3">Message</strong>
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