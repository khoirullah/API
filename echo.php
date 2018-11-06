<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
var arr = [];
var course = 
    {
        "courseid": "135",
        "status":"Y",
        "coorporate": "klob"
    }
    data = JSON.stringify(course); 
$.ajax({
    url: 'http://localhost/API/product/post_course.php?',
    type: 'POST',
    dataType: 'json',
    data:data,
    success: function (data) {
        arr.push({
            'courseid' : data.id,
            'name' : elm.name
        });
    }
});
</script>
