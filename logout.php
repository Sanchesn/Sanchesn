<?php
    require('./functions.php');
    init();
session_destroy();
header('Location: /');