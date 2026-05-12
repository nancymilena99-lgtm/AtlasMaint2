<?php
session_start();
// Determine base URL
$base_url = "/AtlasMaint/";
// Redirect to Control Moviles module
header("Location: " . $base_url . "modules/control_moviles/index.php");
exit();
?>
