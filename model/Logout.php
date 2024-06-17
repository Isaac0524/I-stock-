<?php
session_start();
session_destroy();
header('Location: ../vue/Log/connect.php');
exit();
