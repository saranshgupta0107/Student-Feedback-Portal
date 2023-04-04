var data;
var xhr = new XMLHttpRequest();
xhr.onload = function () {
    const myObj = JSON.parse(this.responseText);
    data = myObj;
    show_data();
}
xhr.open("POST", "../../php/admin/view_feedback_admin.php");
xhr.send();



function addLis(i) {
    var dat1 = { email: data[i['target'].id.substr(3)]['student_id'], feedback_id: data[i['target'].id.substr(3)]['feedback_id'] };
    console.log(dat1);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/admin/delete_admin_feedback.php");
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(JSON.stringify(dat1));
    setTimeout(() => { window.location.replace("../admin/view_feedback.html"); }, 600);
}

function show_data() {
    document.getElementById('top').innerHTML = '';
    var str = '';
<<<<<<< HEAD
    str += "<table class='table'>";
=======
    str += "<table class='table table-hover'>";
>>>>>>> 0752287b225aed681c3d884bebd76d0f12a40db5
    var columns = Object.keys(data[0]);
    str += "<thead class='p-3 mb-2 bg-primary text-white'>";
    str += "<tr>";
    for (var i = 0; i < columns.length; i++) {
<<<<<<< HEAD
        str += ("<th scope='col'>" + columns[i].toUpperCase + "</th>");
=======
        str += ("<th >" + columns[i] + "</th>");
>>>>>>> 0752287b225aed681c3d884bebd76d0f12a40db5
    }
    str += ("<th scope='col'>" + "</th>")
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    for (var i = 0; i < Object.keys(data).length; i++) {
        str += "<tr>";
        for (var j = 0; j < columns.length; j++) {
            str += ("<td>" + data[i][columns[j]] + "</td>");
        }
        str += (`<td><button id=${'btn' + i} class='btn btn-primary'>delete</button></td>`);
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