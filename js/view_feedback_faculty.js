var email_data = sessionStorage.getItem('username');
var dat = { email: email_data, course: sessionStorage.getItem('course') };
var data;
document.getElementById('flexRadioDefault2').addEventListener('click', () => {
    dat['order'] = 'desc rating';
    reload();
});
document.getElementById('flexRadioDefault1').addEventListener('click', () => {
    dat['order'] = 'asc rating';
    reload();
});
document.getElementById('flexRadioDefault3').addEventListener('click', () => {
    dat['order'] = 'asc date';
    reload();
});
document.getElementById('flexRadioDefault4').addEventListener('click', () => {
    dat['order'] = 'desc date';
    reload();
});



function reload() {
    var xhr = new XMLHttpRequest();
    console.log(dat['order']);
    console.log(dat);
    xhr.onload = function () {
        const myObj = JSON.parse(this.responseText);
        data = myObj;
        console.log(data);
        show_data();
    }
    xhr.open("POST", "../../php/admin/view_feedback_faculty.php");
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(JSON.stringify(dat));
    show_data();
}

reload();


function show_data() {
    document.getElementById('top').innerHTML = '';
    var str = '';
    str += "<table class='table table-hover'>";
    var columns = Object.keys(data[0]);
    str += "<thead class='p-3 mb-2 bg-primary text-white'>";
    str += "<tr>";
    for (var i = 0; i < columns.length; i++) {
        str += ("<th scope='col'>" + columns[i] + "</th>");
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
        str += "</tr>";
    }
    str += "</tbody>";
    str += "</table>";
    document.getElementById('top').innerHTML = str;
}