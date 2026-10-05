<?php
session_start();
session_destroy();
echo "Sesión borrada. Ya puedes volver a intentar el login.";
?>