function searchskills() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("searchresults").innerHTML = xmlhttp.responseText;
        }
    };
    var skilloption = document.getElementById("skilloption");
    var lvloption = document.getElementById("lvloption");
    xmlhttp.open("GET", "searchresults.php?searchsort=skills&s=" + document.getElementById("searchtext").value + "&skill=" + skilloption.options[skilloption.selectedIndex].value + "&lvl=" + lvloption.options[lvloption.selectedIndex].value);
    xmlhttp.send();
}

function searchmembers() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("searchresults").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "searchresults.php?searchsort=members&s=" + document.getElementById("searchtext").value + "&skill=" + document.getElementById("skilloption").value);
    xmlhttp.send();
}

function searchprojects() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("searchresults").innerHTML = xmlhttp.responseText;
        }
    };
    var statusoption = document.getElementById("status");
    xmlhttp.open("GET", "searchresults.php?searchsort=projects&s=" + document.getElementById("searchtext").value + "&skill=" + document.getElementById("skilloption2").value + "&status=" + document.getElementById("status").value);
    xmlhttp.send();
}
