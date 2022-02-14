let firstLoad = true
let ItemGroupId
let FinalOut

let options = { weekday: 'long', year: 'numeric', month: 'numeric', day: 'numeric' }
let today  = new Date()

var url_string = window.location.href
var url = new URL(url_string)
let KN = url.searchParams.get("KN") == null ? "" : url.searchParams.get("KN")
let PN = url.searchParams.get("PN") == null  ? "" : url.searchParams.get("PN")


function enableDisableDeleteButton() {
    let ItemsZeile = document.getElementsByClassName("zeile")
    if(ItemsZeile.length > 1) {
        document.getElementById("deleteButton").disabled = false
    }
}

function clickPN(em) {
    em.select();
}

async function b_clippboard() {
    let text = '\\\\192.168.0.3\\RANDmuzik\\Projekte\\'+ PN + '_' + KN
    let ClippPfad = document.getElementById("ClippPfad")
    ClippPfad.value = text
    ClippPfad.select()
    ClippPfad.setSelectionRange(0, 99999)
    document.execCommand('copy')
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



function getSearchOptions(type) {
    document.getElementById("I_searchPN").value = PN;
    fetch("../getItems.php", {
        method: "POST",
    }).then(response => response.text())
      .then(text => {
        let fullObject = JSON.parse(text)
        //console.log(fullObject);
        let fullArray = fullObject.map(x => x.GroupName);
        console.log(fullArray);
        let ArraySplit0 = fullArray.map(x => x.split(/ - (.+)/)[0]);
        //console.log(ArraySplit0);
        let ArraySplit0Unique = [...new Set(ArraySplit0)]
        //console.log(ArraySplit0Unique);

        FinalOut = ArraySplit0Unique.map(x => ({
            PN: x,
            KN: fullArray.filter(y => y.startsWith(x)).map(z => z.split(/ - (.+)/)[1])
        }));

        //console.log(FinalOut);

        FinalOut.forEach(em => {
        let child = document.createElement('option')
            child.innerHTML = em.PN
            document.getElementById("searchPN").appendChild(child)
        })
        console.log(type)
        updateSearchOptions(type)
        
    }).catch((error) => {
        console.error('Error:', error);
        firstLoad = false;

    });
}

function deleteunfinishedActions() {
    let formData = new FormData();
    formData.append('ItemGroupId',ItemGroupId);

    fetch("../deleteActions.php", {
        method: "POST",
        body: formData
    }).then(response => response.text())
      .then(text => {
          console.log(text);
          alert("Die noch nicht erledigten Arbeitsschritte wurden erfolgreich zum Löschen vorgemerkt. Abhängig von der Auslastung des Datenbankservers können bis zur endgültigen Löschung noch einige Sekunden vergehen.\n\nDiese Ansicht wird nicht automatisch aktualisiert.");
        
    }).catch((error) => {
        
        console.error('Error:', error);
        
    });
}

function updateSearchOptions(type) {
    document.getElementById("searchKN").innerHTML = "";
    let allCatalogueItems = FinalOut.filter(x => x.PN == parseInt(document.getElementById("I_searchPN").value));
    console.log(allCatalogueItems)
    if(allCatalogueItems.length > 0) {
        allCatalogueItems[0].KN.forEach(em => {
            //console.log("Test")
            let child = document.createElement('option')
            child.innerHTML = em
            if(em == KN) {
                child.selected = true;
            }
            document.getElementById("searchKN").appendChild(child)
        })
    }
    if(firstLoad) {
        firstLoad = false;
    } else {
        console.log(type)
        loadSearchElement(type)
    }
}

function loadSearchElement(type) {
    let KNOptions = document.getElementById("searchKN");
    let thisKN = "";
    if(KNOptions.length > 0) {
        thisKN = KNOptions.options[KNOptions.selectedIndex].text;
    }
    console.log(type)
    if (type == "Galvanik"){
        window.location.href = 'index.php?PN='+document.getElementById("I_searchPN").value+'&KN='+thisKN+'&Seite='+Seite
    } else if (type == "Studio") {
        window.location.href = 'index.php?PN='+document.getElementById("I_searchPN").value+'&KN='+thisKN+'&Schnitt='+Schnitt+'&Note='+Note
    } else if (type == "Wareneingang") {
        window.location.href = 'index.php?PN='+document.getElementById("I_searchPN").value+'&KN='+thisKN+'&FS='+FS
    } else {
        window.location.href = 'index.php?PN='+document.getElementById("I_searchPN").value+'&KN='+thisKN
    }
    
}

function cancelProject() {
    let text = 'Das Projekt '+PN+' - '+KN+' wird hiermit storniert und alle noch nicht erledigten Arbeitsschritte werden gelöscht. Dieser Vorgang kann nicht Rückgängig gemacht werden!\n\nBitte Drücken Sie "Ok" zum Löschen oder "Abbrechen" um ohne Änderungen zurückzukehren".';
    if (confirm(text) == true) {
        //text = "You pressed OK!";
        deleteunfinishedActions();
    } else {
        //text = "You canceled!";
    }
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

function addDocumentEventListener() {
    const divs = document.querySelectorAll('.document');

    divs.forEach(el => el.addEventListener('click', event => {
        console.log("Test");
        let alert_title = "Tagesbericht - "+event.target.parentNode.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML+" "+event.target.parentNode.previousSibling.previousSibling.previousSibling.innerHTML+":\n\n";
        alert_title = alert_title.replace("&amp;", "\u0026")
        let report = event.target.parentNode.getAttribute("title");
        alert(alert_title+report);
    }));
}