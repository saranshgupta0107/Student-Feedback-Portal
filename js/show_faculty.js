var xmlhttp = new XMLHttpRequest();
var data;
xmlhttp.onload = function () {
    const myObj = JSON.parse(this.responseText);
    data = myObj;
    show_data();
}
xmlhttp.open("GET", "../../php/get_faculty1.php", true);
xmlhttp.send();

function addLis(i) {
    var dat = { email: data[i['target'].id.substr(3)]['email'] };
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/delete_faculty.php");
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(JSON.stringify(dat));
    setTimeout(() => {
        window.location.href = ("../admin/show_faculty.html");
    }, 700);
}

function show_data() {
    document.getElementById('top').innerHTML = '';
    var str = '';
    str += "<table class='table'>";
    var columns = Object.keys(data[0]);
    str += "<thead class='p-3 mb-2 bg-primary text-white'>";
    str += "<tr>";
    for (var i = 0; i < columns.length; i++) {
        str += ("<th scope='col'>" + columns[i] + "</th>");
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