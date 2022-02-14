<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informationen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <script src="../script.js"></script>
    <script>
        let typen = ["MU","VA","ST"]

        window.onload = function(){
            document.title = "E_VP_"+PN
            enableDisableDeleteButton()
            addDocumentEventListener()
            getSearchOptions("")
        }

    </script>
    <div id="Main" class="flex">
        <div id="Etiketten">
            <div class="projektSuche noPrint">
                <div class="noPrint">
                    Projektnummer
                </div>
                <div class="noPrint">
                    <input onClick="clickPN(this)" onchange="updateSearchOptions('')" id="I_searchPN" class="noPrint searchList" list="searchPN">
                    <datalist class="noPrint" id="searchPN">
                    </datalist>
                </div>
            </div>
            <div class="projektSuche noPrint">
                <div class="noPrint">
                    Katalognummer
                </div>
                <div class="noPrint">
                    <select onchange="loadSearchElement('')" id="searchKN" class="noPrint searchList" style="width: 83%;">
                    </select> 
                </div>
            </div>
            <div class="flex noPrint">
                <button onclick="b_clippboard()">Pfad Kopieren</button>
                <button id="deleteButton" onclick="cancelProject()" disabled>Auftrag Stornieren</button>
                <input class="noPrint" type="text" value="null" id="ClippPfad" style="opacity: 0; width: 1px;">
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
                    <div class="spalte">Tagesbericht</div>
                    <div class="spalte">Erledigt</div>
                </div>
                <?php
                    include "../db_access.inc.php";
                    include "../createTable.php";
                ?>
            </div>
        </div>
    </div>
</body>
</html>