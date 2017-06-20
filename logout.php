<?php
session_start();
session_destroy();
// depois de logar, faz-se redirect para a pagina principal, de forma a recarregar os menus
header('Location: index.php');
?>