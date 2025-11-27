<?php
session_start();
session_unset();
session_destroy();

header("location:../pages/index.php?status=berhasil_logout");
exit;