<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_strconexion = "localhost";
$database_strconexion = "bd_sigev";
$username_strconexion = "root";
$password_strconexion = "";
$strconexion = mysql_pconnect($hostname_strconexion, $username_strconexion, $password_strconexion) or trigger_error(mysql_error(),E_USER_ERROR); 
?>