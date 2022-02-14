<?php
    if($msconn === false) {
        echo "Verbindung Zur MSSQL Datenbank Fehlgeschlagen, abrufen der Abreitschritte aktuell nicht möglich";
    }
    else {
        $msq = $msconn->query("
                SELECT T_ItemGroup.Idx AS 'Idx',T_InfoBoardItem.GroupIndex AS '#',T_Product.ExternalId AS 'Arbeitsschritt', T_InfoBoardItem.EndTime AS 'Fertigstellung',T_Status.Description AS 'Status', T_InfoBoardItem.DayReports AS 'Tagesbericht', T_InfoBoardItem.IsFinished AS 'Erledigt'
                FROM T_ItemGroup
                INNER JOIN T_InfoBoardItem
                ON T_ItemGroup.Idx = T_InfoBoardItem.ItemGroupId
                LEFT JOIN T_Product
                ON T_InfoBoardItem.ProductId = T_Product.Idx OR (T_InfoBoardItem.ProductId IS NULL OR T_Product.Idx IS NULL)
                LEFT JOIN T_InfoBoardItem_Status
                ON T_InfoBoardItem_Status.ItemId = T_InfoBoardItem.Idx
                LEFT JOIN T_Status
                ON T_InfoBoardItem_Status.StatusId = T_Status.Idx
                WHERE T_ItemGroup.GroupName = '".$_GET['PN']." - ".$_GET['KN']."' AND T_InfoBoardItem.ProjectDataId = 43
                ORDER BY T_InfoBoardItem.EndTime ASC
        ");
        if ($msq->rowCount()==0) {
            echo "Es konnten keine Informationen abgerufen werden";
        } else {
            $i = -1;
            $current = 1;
            $last_Arbeitsschritt = "";
            $result = array();

            foreach ($msq as $row) {
                echo "<script>ItemGroupId = ".$row["Idx"]."</script>";
                
                
                if($last_Arbeitsschritt != $row["#"]) {
                    if($row["Erledigt"] == 1) {
                        $result[] = [$row["#"],$row["Arbeitsschritt"],date_format(date_create($row["Fertigstellung"]), "d.m.y"),[$row["Status"]],$row["Tagesbericht"],"☑"];
                    } else {
                        $result[] = [$row["#"],$row["Arbeitsschritt"],"",[$row["Status"]],$row["Tagesbericht"],""];
                    }
                    $i++;
                } else {
                    $result[$i][3][] = $row["Status"];
                }
    
                $last_Arbeitsschritt = $row["#"];
                
            }
            

            //echo '<pre>'; print_r($result); echo '</pre>';

            $step = 1;
            foreach($result as $row) {
                if ($row[5] == "☑") {
                    $content = "<div class='zeile fertig'>";
                    $current++;
                } else if ($step == $current) {
                    $content = "<div class='zeile current'>";
                    $current = 0;
                } else {
                    $content = "<div class='zeile'>";
                }
                
                    $content .= "<div class='spalte'>".$step.".</div>";
                    $content .= "<div class='spalte'>".$row[1]."</div>";
                    $content .= "<div class='spalte'>".$row[2]."</div>";
                    $content .= "<div class='spalte'>";
                    for($i = 0; $i < count($row[3]); $i++) {
                        $content .= $row[3][$i];
                        if($row[3][$i] != "" && $i != (count($row[3]))-1) {
                            $content .= "; ";
                        } 
                    }
                    $content .= "</div>";

                    $reports = explode("", $row[4]);
                    $content .= "<div class='spalte'";
                    if($reports[0] != "") {
                        $content .= " report0='".$reports[0]."'";
                        $content .= " report1='".$reports[1]."'";
                        $content .= " report2='".$reports[2]."'";
                        $content .= " title='1: ".$reports[0]."&#10;2: ".$reports[1]."&#10;3: ".$reports[2]."'";
                    }
                    $content .= ">";
                    if($reports[0] != "") {
                        $content .= "<div class='document'>🗎</div>";
                    }
                    $content .= "</div>";
                    $content .= "<div class='spalte'>".$row[5]."</div>";
                $content .= "</div>";
                echo $content;
                $step++;
            }

        }
        
    }
?>