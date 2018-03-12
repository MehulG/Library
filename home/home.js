$(document).ready(function(){
    //adding alphabets
    for (var i = 65; i <= 90; i++) {
        $('#top').append('<button>' + String.fromCharCode(i) + '</button>');
    }

    $('#s_title').val('');
    $('#s_subject').val('');
//initial call
    $.ajax({url: "",data : {type: "", query : ""}, success: function(result){
        result.forEach(element => {
            $("#main_table").append(`<tr><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
        });
        var total_res = result[0].count;
        $('top').append(`<p>`+ total_res +`</p>`)
        var no_of_pages = Math.ceil(total_res/25);
        for(var i=0; i<=no_of_pages; i++){
            if (i!=result[0].page_no) {
                $('#pages').append(`<button >`+i+`</button>`);                        
            }else{
                $('#pages').append(i);                        
            }
        }

    }});


//     functions


// search
    $("#sub1").click(function(){
        
        var title = $('#s_title').val();
        var subj = $('#s_subject').val();
        
        $.ajax({url: "",data : {type: title, query : subj}, success: function(result){
            result.forEach(element => {
                $("#main_table").append(`<tr><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = result[0].count;
            $('top').append(`<p>`+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=0; i<=no_of_pages; i++){
                if (i!=result[0].page_no) {
                    $('#pages').append(`<button >`+i+`</button>`);                        
                }else{
                    $('#pages').append(i);                        
                }
            }
        }});

    });
    $('#sub1').submit(function(){
        return false;
    });

//clear
    $("#sub2").click(function(){

        var title = '';
        var subj ='';
        $('#s_title').val('');
        $('#s_subject').val('');

        $.ajax({url: "",data : {type: title, query : subj}, success: function(result){
            result.forEach(element => {
                $("#main_table").append(`<tr><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = result[0].count;
            $('top').append(`<p>`+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=0; i<=no_of_pages; i++){
                if (i!=result[0].page_no) {
                    $('#pages').append(`<button >`+i+`</button>`);                        
                }else{
                    $('#pages').append(i);                        
                }
            }
        }});
    });

//different page
    $('#pages').children('button').click(function(){
        var Page_no = $(this).html();
        var title = $('#s_title').val();
        var subj = $('#s_subject').val();


        $.ajax({url: "",data : {type: title, query : subj, page: Page_no}, success: function(result){
            result.forEach(element => {
                $("#main_table").append(`<tr><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = result[0].count;
            $('top').append(`<p>`+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=0; i<=no_of_pages; i++){
                if (i!=result[0].page_no) {
                    $('#pages').append(`<button >`+i+`</button>`);                        
                }else{
                    $('#pages').append(i);                        
                }
            }

        }});
    });



//alphabetical
$('#top').children('button').click(function(){
    var alphabet = $(this).html();
    console.log(alphabet);
    
    $.ajax({url: "",data : {type: " ", query : "", char: alphabet, page: ""}, success: function(result){
        result.forEach(element => {
            $("#main_table").append(`<tr><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
        });
        var total_res = result[0].count;
        $('top').append(`<p>`+ total_res +`</p>`)
        var no_of_pages = Math.ceil(total_res/25);
        for(var i=0; i<=no_of_pages; i++){
            if (i!=result[0].page_no) {
                $('#pages').append(`<button >`+i+`</button>`);                        
            }else{
                $('#pages').append(i);                        
            }
        }
    }});
});





});