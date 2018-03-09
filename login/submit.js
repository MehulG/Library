$(document).ready(function(){
    $(".btn").on('click',function(e){
        e.preventDefault();
            var uname = $('input:text').val();
            var pwd = $('input:password').val();
            $.post("./signin.php",
            {
                username: uname,
                password: pwd
            },
            function(data,status){
                    alert(data);
                    if(data=='login successful')
                    window.location.href="../admin";
            });
        });
    });