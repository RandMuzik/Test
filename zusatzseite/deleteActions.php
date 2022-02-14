<?php
    $ItemGroupId = $_POST["ItemGroupId"];
    include "db_access.inc.php";
    $actions = $msconn->query("SELECT ExternalId FROM T_InfoBoardItem Where ItemGroupId = ".$ItemGroupId." AND IsFinished = 0");
    $queryResult = array();
    foreach ($actions as $row) {
        $queryResult[] = $row;
        $msconn1->query("INSERT INTO T_Object_In (ObjectId,Operation) VALUES ('".$row["ExternalId"]."','D')");
    }

    print json_encode($queryResult);
    

?>