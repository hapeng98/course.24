<?php
    session_start();
if (isset($_SESSION['stunum']) && isset($_SESSION['name'])) {
    echo "학번: " . $_SESSION['stunum'];
    echo " 이름: " . $_SESSION['name'];
    } else {

    exit();
}
?>