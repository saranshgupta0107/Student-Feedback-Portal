var email_data = sessionStorage.getItem('username');
var randomTopics = ['technology', 'tech', 'education', 'edu', 'study'];

var dat = { email: email_data };
var data;

var xhr = new XMLHttpRequest();
xhr.open("POST", "../../php/faculty/getFacultyCourses.php");
xhr.onload = function () {
    data = JSON.parse(this.responseText);
    console.log(data);
    var str = '';
    var ShowCourse = document.getElementById('deck');
    for (var i = 0; i < data.length; i++) {
        str += '<div class="card" style="display: inline-block;">';
        str += '<img src="https://source.unsplash.com/360x240/?' + randomTopics[Math.ceil(5.3 * Math.random()) % 5] + '" class="card-img-top" alt="..." href="show_feedback.html"' + `id="course${i}">`;
        str += '<div class="card-body">' + `${data[i]['course_id']}` + '</div >';
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
