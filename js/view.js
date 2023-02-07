var feedback_id=document.getElementById('feedback_id');feedback_id.style.display='none';
var course_id=document.getElementById('course_id');course_id.style.display='none';
var comment=document.getElementById('comment');comment.style.display='none';
var year=document.getElementById('year');year.style.display='none';
var time=document.getElementById('time');time.style.display='none';
var check1=document.getElementById('check1');
var check2=document.getElementById('check2');
var check3=document.getElementById('check3');
var check4=document.getElementById('check4');
var check5=document.getElementById('check5');

var rows=0;

check1.addEventListener('click',()=>{
    if(check1.checked){
        feedback_id.style.display='';
        rows++;
    }
    else {
        feedback_id.style.display='none';
        rows--;
    }
    change();
})
check2.addEventListener('click',()=>{
    if(check2.checked){
        course_id.style.display='';
        rows++;
    }
    else {
        course_id.style.display='none';
        rows--;
    }
    change();
})
check3.addEventListener('click',()=>{
    if(check3.checked){
        rows++;
        comment.style.display='';
    }
    else {
        rows--;
        comment.style.display='none';
    }
    change();
})
check4.addEventListener('click',()=>{
    if(check4.checked){
        year.style.display='';
        rows++;
    }
    else {
        year.style.display='none';
        rows--;
    }
    change();
})
check5.addEventListener('click',()=>{
    if(check5.checked){
        time.style.display='';
        rows++;
    }
    else {
        time.style.display='none';
        rows--;
    }
    change();
})
var seed=parseInt(document.getElementById('seed').value);
var columns=parseInt(document.getElementById('columns').value);

document.getElementById('seed').addEventListener('change',()=>{
    columns=parseInt(document.getElementById('columns').value);
    seed=parseInt(document.getElementById('seed').value);
    change();
});

document.getElementById('columns').addEventListener('change',()=>{
    columns=parseInt(document.getElementById('columns').value);
    seed=parseInt(document.getElementById('seed').value);
    change();
});

var tbody=document.getElementById('Tbody');


function change(){
    console.log(rows);
    tbody.innerHTML='';
    var stri='';
    for(var i=0;i<columns;i++){
        stri+="<tr>";
        for(var j=0;j<rows;j++){
            stri+=("<td>"+(seed++)+"</td>");
        }
        stri+="</tr>";
    }
    tbody.innerHTML=stri;
}