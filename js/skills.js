function skillsSearch(divisie,user) {
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
  document.getElementById("skillsresults").innerHTML=xmlhttp.responseText;
  }
  }
  xmlhttp.open("GET","skillsresults.php?d=" +  divisie + "&u=" + user);
  xmlhttp.send();
}
function skillsSearch2(divisie,user) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("skillsresults").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","skillsresults.php?d=" +  divisie + "&u=" + user + "&admin=yes");
	xmlhttp.send();
}


function wensenSearch(skill) {
    var xmlhttp;
    
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
	    // alert(xmlhttp.responseText);
	    document.getElementById("skillsresults").innerHTML=xmlhttp.responseText;
	}
    }
    xmlhttp.open("GET","zoekwensen.php?skill=" +  skill );
    xmlhttp.send();
    
}


