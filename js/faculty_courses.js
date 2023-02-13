var email_data = sessionStorage.getItem('username');
sessionStorage.setItem("course", "none");
var randomTopics = ['technology', 'tech', 'education', 'edu', 'study'];

var dat = { email: email_data };
var data;

var xhr = new XMLHttpRequest();
xhr.open("POST", "../../php/getFacultyCourses.php");
xhr.onload = function () {
    data = JSON.parse(this.responseText);
    console.log(data);
    var ShowCourse = document.getElementById('deck');
    var str = '';
    for (var i = 0; i < data.length; i++) {
        str += '<div class="card" style="display: inline-block;">';
        str += '<img src="https://source.unsplash.com/360x240/?' + randomTopics[Math.ceil(5.3 * Math.random()) % 5] + '" class="card-img-top" alt="..." href="show_feedback.html"' + `id="course${i}">`;
        str += '<div class="card-body">' + `${data[i]['course_id']}` + '</div > <div class="card-footer"><small class="text-muted">Last updated 3 mins ago</small></div></div > ';
        str += "</div>";
    }
    ShowCourse.innerHTML = str;
    for (var i = 0; i < data.length; i++) {
        document.getElementById('course' + i).addEventListener('mouseover', (i) => {
            sessionStorage['course'] = data[i.target.id.substr(6)]['course_id'];
        });
        document.getElementById('course' + i).addEventListener('click', (i) => {
            window.location.replace('show_feedback.html');
        });
    }
}
xhr.setRequestHeader("Content-type", "application/json");
xhr.send(JSON.stringify(dat));

function extra(i) {
    console.log(i);
}
