
var email_data = sessionStorage.getItem('username');
var pass_data = sessionStorage.getItem('password');
var dat = { email: email_data, pass: pass_data };
var xhr = new XMLHttpRequest();

var data;
xhr.onload = function () {
    const myObj = JSON.parse(this.responseText);
    data = myObj;
    show_data();
}

xhr.open("POST", "../../php/view_feedback_student.php");
xhr.setRequestHeader("Content-type", "application/json")
xhr.send(JSON.stringify(dat));



function addLis(i) {
    var dat = { email: data[i['target'].id.substr(3)]['email'] };
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/delete_faculty.php");
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(JSON.stringify(dat));
    setTimeout(window.location.replace, 10000, ("../html/admin/show_faculty.html"));
}

function show_data() {
    document.getElementById('top').innerHTML = '';
    var str = '';
    str += "<table class='tablefeed' width='100%'>";
    var columns = Object.keys(data[0]);
    str += "<thead>";
    str += "<tr>";
    for (var i = 0; i < columns.length; i++) {
        str += ("<th>" + columns[i] + "</th>");
    }
    str += ("<th>" + "</th>")
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    for (var i = 0; i < Object.keys(data).length; i++) {
        str += "<tr>";
        for (var j = 0; j < columns.length; j++) {
            str += ("<td>" + data[i][columns[j]] + "</td>");
        }
        str += (`<td><button id=${'btn' + i}>delete</button></td>`);
        str += "</tr>";
    }
    str += "</tbody>";
    str += "</table>";
    document.getElementById('top').innerHTML = str;
    for (var i = 0; i < Object.keys(data).length; i++) {
        document.getElementById('btn' + i).addEventListener('click', function (i) {
            addLis(i);
        });
    }
}