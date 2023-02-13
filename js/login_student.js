var bool1=false;var bool2=false;
document.getElementById("exampleInputEmail1").addEventListener('keyup',
function match_email(e){
    var username=document.getElementById("exampleInputEmail1");
    if(username.value.length==0){
        bool1=false;
        both_true();
        return;
    }
    else{
        bool1=true;
        both_true();
        return;
    }
});
document.getElementById("exampleInputPassword1").addEventListener('keyup',
function match_password(e){
    var username=document.getElementById("exampleInputPassword1");
    if(username.value.length==0){
        document.getElementById('exampleInputPassword1').style.border='1px solid gray';
        bool2=false;
        both_true();
        return;
    }
    if(username.value.length<8||username.value.length>20){
        bool2=false;
        both_true();
        document.getElementById('exampleInputPassword1').style.border='2px solid red';}
    else{
        bool2=true;
        both_true();
        document.getElementById('exampleInputPassword1').style.border='1px solid gray';
    }
});

function both_true(){
    if(bool1&&bool2){
        document.getElementById('submitbtn').disabled=false;
    }else{
        document.getElementById('submitbtn').disabled=true;
    }
}
window.addEventListener("pageshow",function(){
    document.getElementById("exampleInputEmail1").value="";
    document.getElementById("exampleInputPassword1").value="";
})