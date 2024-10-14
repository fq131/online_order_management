<?php require ('database.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Define styles for the fixed and bottom footers */
        .fixed-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #597ac9;
        }

        .bottom-footer {
            position: relative;
            width: 100%;
            background-color: #597ac9;
        }
    </style>
</head>
<footer class="bg-body-tertiary text-center">
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #597ac9;">
        <p>&copy;
            <?php echo date("Y"); ?> UCCD3243 Server-Side Web Applications Development
        </p>
    </div>
    <!-- Copyright -->
</footer>
<script>
        window.onload = function() {
            // Check if page content height exceeds viewport height
            if (document.body.clientHeight > window.innerHeight) {
                document.querySelector("footer").classList.add("bottom-footer");
            } else {
                document.querySelector("footer").classList.add("fixed-footer");
            }
        };
    </script>

</html>