<?php

    include "db_access.inc.php";
    $allItems = $msconn->query("Select Idx, GroupName From T_ItemGroup Order By GroupName, Idx");
    $queryResult = array();
    foreach ($allItems as $row) {
        $queryResult[] = $row;
    }

    print json_encode($queryResult);    

?>