
function match_email(){
    var username=document.getElementById("exampleInputEmail1");
    if(username.value.length==0){
        document.getElementById('exampleInputEmail1').style.border='1px solid gray';
        return;
    }
    if(username.value.length<12||username.value.substr(-12)!='@iiita.ac.in')document.getElementById('exampleInputEmail1').style.border='2px solid red';
    else document.getElementById('exampleInputEmail1').style.border='1px solid gray';
}

function match_password(){
    var username=document.getElementById("exampleInputPassword1");
    if(username.value.length==0){
        document.getElementById('exampleInputPassword1').style.border='1px solid gray';
        return;
    }
    if(username.value.length<8||username.value.length>20)document.getElementById('exampleInputPassword1').style.border='2px solid red';
    else document.getElementById('exampleInputPassword1').style.border='1px solid gray';
}

setInterval(match_email,300);
setInterval(match_password,300);