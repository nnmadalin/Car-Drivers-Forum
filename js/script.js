
//onclick="show_actiuni()"

function show_forum_creator() {
    var x = document.getElementById("forum-create");
    //x.style.display = "block";
    if (x.style.display === "none") {
        x.style.display = "block";
        
        document.getElementById("div_show").style.filter = "blur(8px)";	
        document.getElementById("stats").style.filter = "blur(8px)";	
        document.getElementById("meniu").style.filter = "blur(8px)";
    } else if (x.style.display === "block") {
        x.style.display = "none";
        
        document.getElementById("div_show").style.filter = "blur(0px)";	
        document.getElementById("stats").style.filter = "blur(0px)";
        document.getElementById("meniu").style.filter = "blur(0px)";		
    }
}

function show_forum_information() {
    var x = document.getElementById("forum-info");
    //x.style.display = "block";
    if (x.style.display === "none") {
        x.style.display = "block";
        //document.getElementById("div_show").style.filter = "blur(8px)";	
        //document.getElementById("meniu").style.filter = "blur(8px)";
    } else if (x.style.display === "block") {
        x.style.display = "none";
        
        //document.getElementById("div_show").style.filter = "blur(0px)";	
        //document.getElementById("meniu").style.filter = "blur(0px)";		
    }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

$(document).ready(function(){
    setInterval(function(){
},1000);
});