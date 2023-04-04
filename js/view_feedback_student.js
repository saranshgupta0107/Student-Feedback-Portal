var email_data = sessionStorage.getItem('username');
var pass_data = sessionStorage.getItem('password');
var dat = { email: email_data, pass: pass_data, course: 'none', order: 'desc' };

var courseOpts = 0;
document.getElementById('exampleFormControlSelect1').addEventListener('click', () => {
    dat['course'] = document.getElementById('exampleFormControlSelect1').value;
    reload();
});
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

var coursedat;
var getcourse = new XMLHttpRequest();
getcourse.onload = function () {
    coursedat = JSON.parse(this.responseText);
    var courses = document.getElementById('exampleFormControlSelect1');
    var str = '';
    str += '<option selected>none</option>';
    for (var i = 0; i < coursedat.length; i++) {
        str += '<option>' + coursedat[i]['course_id'] + '</option>';
    }
    courses.innerHTML = str;
}
getcourse.open('POST', '../../php/student/get_course.php');
getcourse.setRequestHeader("Content-type", "application/json");
getcourse.send(JSON.stringify(dat));

var data;

function reload() {
    var xhr = new XMLHttpRequest();
    console.log(dat['order']);
    xhr.onload = function () {
        const myObj = JSON.parse(this.responseText);
        data = myObj;
        show_data();
    }
    xhr.open("POST", "../../php/student/view_feedback_student.php");
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(JSON.stringify(dat));
}

reload();

function addLis(i) {
    var dat1 = { email: data[i['target'].id.substr(3)]['student_id'], feedback_id: data[i['target'].id.substr(3)]['feedback_id'] };
    console.log(dat1);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/student/delete_student_feedback.php");
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(JSON.stringify(dat1));
    setTimeout(() => { window.location.replace("../student/view_feedback.html"); }, 600);
}

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