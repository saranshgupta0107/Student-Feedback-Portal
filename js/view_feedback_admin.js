var data;
var xhr = new XMLHttpRequest();
xhr.onload = function () {
    const myObj = JSON.parse(this.responseText);
    data = myObj;
    show_data();
}
xhr.open("POST", "../../php/view_feedback_admin.php");
xhr.send();



function addLis(i) {
    var dat1 = { email: data[i['target'].id.substr(3)]['student_id'], feedback_id: data[i['target'].id.substr(3)]['feedback_id'] };
    console.log(dat1);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/delete_admin_feedback.php");
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(JSON.stringify(dat1));
    setTimeout(() => { window.location.replace("../admin/view_feedback.html"); }, 600);
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