<?php

session_start();
echo "you logout";

session_destroy();
header("Location: /forum")


?>