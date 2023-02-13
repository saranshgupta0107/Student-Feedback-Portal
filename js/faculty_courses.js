var email_data = sessionStorage.getItem('username');
var randomTopics = ['technology', 'tech', 'education', 'edu', 'study'];

var dat = { email: email_data };
var data;

var xhr = new XMLHttpRequest();
xhr.open("POST", "../../php/getFacultyCourses.php");
xhr.onload = function () {
    data = JSON.parse(this.responseText);
    console.log(data);
    var ShowCourse = document.getElementById('deck');
    for (var i = 0; i < data.length; i++) {
        var str = '<div class="card" style="display: inline-block;">';
        str += '<img src="https://source.unsplash.com/360x240/?' + randomTopics[Math.random() % 5] + '" class="card-img-top" alt="..." href="show_feedback.html">';
        str += '<div class="card-body">< h5 class="card-title">' + data[0]['course_id'] + ' </h5 ></div ><div class="card-footer"><small class="text-muted">Last updated 3 mins ago</small></div></div >';
    }
    ShowCourse.innerHTML = str;
}
xhr.setRequestHeader("Content-type", "application/json");
xhr.send(JSON.stringify(dat));
