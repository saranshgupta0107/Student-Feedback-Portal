var xmlhttp= new XMLHttpRequest();
xmlhttp.onload=function(){
    const myObj=JSON.parse(this.responseText);
    console.log(myObj);
    document.getElementById("top").innerHTML=myObj[1]["email"];
}
xmlhttp.open("GET","../php/get_faculty1.php",true);
xmlhttp.send();