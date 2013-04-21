<?php
if ($_GET['randomId'] != "YyiPX68ffswEciOgAwIuPisXkfeeyuVB6l7q0a7uAx72hhgF6aZ1KbIQjkm7scYI") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
