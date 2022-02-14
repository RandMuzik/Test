<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiketten</title>
</head>
<style>
    body {
        font-family: Arial;
        margin: 0;
        padding: 0;
        background-color: #dadce0;
    }
    @page {
        size: 101mm 54mm;
        margin: 0;
    }
    @media print {
        .noPrint{
            display:none;
        }
        .e_print {
            padding: 5mm;
            page-break-after: always;
        }
        button {
            display: none;
        }
        .emptyRow {
            margin: 0mm 0;
        }
    }
    button {
        margin: 5mm;
    }
    .e_web {
        border-radius: 2.5mm;
        padding: 5mm;
        margin: 6mm;
        width: 89mm;
        height: 42mm;
        background-color: white;

    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    td {
        border: 1px solid black;
    }
    .desc {
        width: 20mm;
        float: left;
        font-size: 4mm;
        line-height: 7.8mm;
        padding: 0 2mm;
    }
    .row {
        flex: 3;
        font-weight: bold;
        white-space: nowrap;
        font-size: 7mm;
        line-height: 7.8mm;
        padding: 0 2mm;
        transform-origin: 90px;
    }
    .small {
        font-size: 4mm;
        font-weight: normal;
    }
    .flex {
        display: flex;
    }
    #Tabelle {
       margin-top: 15mm;
    }

    .title {
        font-weight: bold;
        font-size: 7.2mm;
        margin-bottom: 2mm;
    }
    .table_Wrapper {
        width: 50rem; 
	    font-size: 4mm;
        border-radius: 2.5mm;
        padding: 5mm;
        margin: 6mm;
        background-color: white;
    }
    .zeile {
        margin: 2px 0;
        display: grid;
        grid-template-columns: 5mm 2fr 32mm 1fr 20mm;
    }
    .fertig {
        background: #d3d3d3;
    }
    .current {
        background: #00ff00;
    }
    .header {
        font-weight: bold;
        color: white;
        background: #000000;
    }
    .spalte {
        padding: 2px 5px;
    }
</style>
<body>
    <script>
        let typen = ["1"]

        let options = { weekday: 'long', year: 'numeric', month: 'numeric', day: 'numeric' };
        let today  = new Date();

        var url_string = window.location.href
        var url = new URL(url_string)
        let KN = url.searchParams.get("KN") == null ? "" : url.searchParams.get("KN")
        let PN = url.searchParams.get("PN") == null  ? "" : url.searchParams.get("PN")
        let Schnitt = url.searchParams.get("Schnitt") == null  ? "" : url.searchParams.get("Schnitt")
        let Note = url.searchParams.get("Note") == null  ? "" : url.searchParams.get("Note")

        window.onload = function(){
            typen.forEach(typ => {
                let child = document.createElement('div')
                child.classList.add("etikette", "e_web")
                child.innerHTML = `
                    <table>
                        <tr>
                            <td><div class="desc">Cat.-Nr.:</div><div class="row stringWidth" contenteditable="true">`+KN+`</div></td>
                        </tr>
                        <tr>
                            <td><div class="desc">Projekt:</div><div class="row" contenteditable="true">`+PN+`</div></td>
                        </tr>
                        <tr>
                            <td><div class="desc">Datum:</div><div class="row small" contenteditable="true">`+today.toLocaleDateString('de-DE', options)+`</div></td>
                        </tr>
                        <tr>
                            <td><div class="desc">Schnitt:</div><div class="row small" contenteditable="true">`+Schnitt+`</div></td>
                        </tr>
                        <tr>
                            <td><div class="desc">Bemerk.:</div><div class="row small" contenteditable="true">`+Note+`</div></td>
                        </tr>
                    </table>
                `
                document.getElementById("Etiketten").appendChild(child)
                document.title = "E_ST_"+PN
            })

            let checkStringWidth = Array.from(document.querySelectorAll('.stringWidth'));
            checkStringWidth.forEach(e => {
                setStringWidth(e)
            })
        }
        

        function b_print() {
            let etiketten = Array.from(document.querySelectorAll('.etikette'));
            let Main = document.getElementById("Main");
            Main.classList.remove("flex")
            etiketten.forEach(em => {
                em.classList.remove("e_web")
                em.classList.add("e_print")
            })
            window.print()
            Main.classList.add("flex")
            etiketten.forEach(em => {
                em.classList.remove("e_print")
                em.classList.add("e_web")
            })
        }

        function setStringWidth(div) {
            console.log(div)
            let length = div.innerHTML.length
            console.log(length)
            if (length > 16) {
                switch(length) {
                    case 17:
                        div.style.transform = "scaleX(0.97)"
                        break;
                    case 18:
                        div.style.transform = "scaleX(0.94)"
                        break;
                    case 19:
                        div.style.transform = "scaleX(0.91)"
                        break;
                    case 20:
                        div.style.transform = "scaleX(0.88)"
                        break;
                    case 21:
                        div.style.transform = "scaleX(0.85)"
                        break;
                    case 22:
                        div.style.transform = "scaleX(0.82)"
                        break;
                    case 23:
                        div.style.transform = "scaleX(0.79)"
                        break;
                    case 24:
                        div.style.transform = "scaleX(0.76)"
                        break;
                    case 25:
                        div.style.transform = "scaleX(0.73)"
                        break;
                    case 26:
                        div.style.transform = "scaleX(0.70)"
                        break;
                    case 27:
                        div.style.transform = "scaleX(0.67)"
                        break;
                    case 28:
                        div.style.transform = "scaleX(0.64)"
                        break;
                    case 29:
                        div.style.transform = "scaleX(0.61)"
                        break;
                    case 30:
                        div.style.transform = "scaleX(0.58)"
                        break;

                }
            }
        }

        async function b_clippboard() {
            let text = '\\\\192.168.0.3\\RANDmuzik\\Projekte\\'+ PN + '_' + KN
            let ClippPfad = document.getElementById("ClippPfad")
            ClippPfad.value = text
            ClippPfad.select()
            ClippPfad.setSelectionRange(0, 99999)
            document.execCommand('copy')
        }
    </script>
    <div id="Main" class="flex">
        <div id="Etiketten">
            <div id="btn_header" class="flex">
                <button onclick="b_print()">Drucken</button>
                <button onclick="b_clippboard()">Pfad Kopieren</button>
                <input class="noPrint" type="text" value="null" id="ClippPfad" style="opacity: 0;">
            </div>
        </div>
        <div id="Tabelle" class="noPrint">
            <div class="table_Wrapper">
                <?php
                    echo "<div class='title'>".$_GET["PN"]." - ".$_GET['KN']."</div>";
                ?>
                <div class="zeile header">
                    <div class="spalte">#</div>
                    <div class="spalte">Arbeitsschritt</div>
                    <div class="spalte">Fertigstellung</div>
                    <div class="spalte">Status</div>
                    <div class="spalte">Erledigt</div>
                </div>
                <?php
                    include "../db_access.inc.php";
                    if($msconn === false)
                    {
                        echo "Verbindung Zur MSSQL Datenbank Fehlgeschlagen, abrufen der Abreitschritte aktuell nicht möglich";
                    }
                    else {
                        $msq = $msconn->query("
                                SELECT T_InfoBoardItem.GroupIndex AS '#',T_Product.ExternalId AS 'Arbeitsschritt', T_InfoBoardItem.EndTime AS 'Fertigstellung',T_Status.Description AS 'Status', T_InfoBoardItem.IsFinished AS 'Erledigt'
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
                            $i = 1;
                            $current = 1;
                            foreach ($msq as $row) {
                                if($row["Erledigt"] == 1) {
                                    echo "<div class='zeile fertig'>";
                                    $current++;
                                }
                                else {
                                    if($current == $i) {
                                        echo "<div class='zeile current'>";
                                        $current = 0;
                                    } else {
                                        echo "<div class='zeile'>";
                                    }
                                    
                                }
                                echo "<div class='spalte'>".$i.".</div>";
                                echo "<div class='spalte'>".$row["Arbeitsschritt"]."</div>";
                                echo "<div class='spalte'>";
                                if($row["Erledigt"] == 1) {
                                    echo date_format(date_create($row["Fertigstellung"]), "d.m.y");
                                }
                                echo "</div>";
                                echo "<div class='spalte'>".$row["Status"]."</div>";
                                echo "<div class='spalte'>";
                                if($row["Erledigt"] == 1) {
                                    echo "☑";
                                }
                                echo "</div>";
                                echo "</div>";
                                $i++;
                            }
                        }
                        
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>