<?php
//MSSQL Datenbank
$serverName = "lexware";
$msconn = new PDO("sqlsrv:server=$serverName; Database=IB33DB", 'sa', '1234#Abc');
$msconn1 = new PDO("sqlsrv:server=$serverName; Database=IB33DB_Sync", 'sa', '1234#Abc');
?>