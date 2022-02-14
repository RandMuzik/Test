<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiketten</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <script src="../script.js"></script>
    <script>

        let typen = ["MU","VA","ST"]
        let Seite = "";
        let SeiteSplit = [];
        if (url.searchParams.get("Seite") != null) {
            Seite = url.searchParams.get("Seite")
            SeiteSplit = Seite.split("")
        }

        window.onload = function(){
            for (let i = 0; i < SeiteSplit.length; i++) {
                typen.forEach(typ => {
                    let child = document.createElement('div')
                    child.classList.add("etikette", "e_web")
                    child.innerHTML = `
                        <div class="projektnummer" contenteditable="true">`+KN+`</div>
                        <div class="details">
                            <div class="typ" contenteditable="true">`+typ+`</div>
                            <div class="datum" contenteditable="true">`+today.toLocaleDateString('de-DE', options)+`</div>
                            <div class="katalognummer" contenteditable="true">`+PN+`</div>
                            <div class="seite" contenteditable="true">`+SeiteSplit[i]+`</div>
                        </div>
                        <div class="notes">
                            <div class="flex">
                                <div>NR. Maschine:</div><div class="emptyRow" contenteditable="true"></div>
                            </div>
                            <div class="emptyRow" contenteditable="true"></div>
                            <div class="emptyRow" contenteditable="true"></div>
                            
                        </div>
                    `
                    document.getElementById("Etiketten").appendChild(child)
                    
                })
            }
            
            document.title = "E_GV_"+PN
            enableDisableDeleteButton()
            addDocumentEventListener()
            getSearchOptions("Galvanik") 
        }
        
    </script>
    <div id="Main" class="flex">
        <div id="Etiketten">
            <div class="projektSuche noPrint">
                <div class="noPrint">
                    Projektnummer
                </div>
                <div class="noPrint">
                    <input onClick="clickPN(this)" onchange="updateSearchOptions('Galvanik')" id="I_searchPN" class="noPrint searchList" list="searchPN">
                    <datalist class="noPrint" id="searchPN">
                    </datalist>
                </div>
            </div>
            <div class="projektSuche noPrint">
                <div class="noPrint">
                    Katalognummer
                </div>
                <div class="noPrint">
                    <select onchange="loadSearchElement('Galvanik')" id="searchKN" class="noPrint searchList" style="width: 83%;">
                    </select> 
                </div>
            </div>
            <div class="flex noPrint">
                <button onclick="b_print()">Drucken</button>
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