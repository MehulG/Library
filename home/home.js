$(document).ready(function(){
    //adding alphabets
    for (var i = 65; i <= 90; i++) {
        $('#top').append('<button>' + String.fromCharCode(i) + '</button>');
    }

    $('#s_title').val('');
    $('#s_subject').val('');
//initial call
    $.ajax({url: "./../search.php",data : {type: "title", query : ""}, success: function(result){

        var ret = JSON.parse(result);

        console.log(ret.count);

        ret[0].forEach(element => {            
            $("#main_table").append(`<tr class='temp'><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
        });
        var total_res = ret.count;
        $('#top').append(`<p class='temp'>Total results: `+ total_res +`</p>`)
        var no_of_pages = Math.ceil(total_res/25);
        for(var i=1; i<=no_of_pages; i++){
            if (i!=total_res) {
                $('#pages').append(`<button class='temp'>`+i+`</button>`);                        
            }else{
                $('#pages').append(i);                        
            }
        }

    }});


    $.ajax({url: "./../publisher.php",data : {type: "title", query : ""}, success: function(result){

        var ret = JSON.parse(result);
        // ret.pop();
        console.log(ret);
        ret.forEach(element => {
            if(element!=null){
                console.log(element);
                $('#publisher').append(`<li><input type="checkbox"  class = "pub" name="`+element+`"> `+element+`</li>`)
              }         
        });    
        

    }});


//     functions


// search
    $("#sub1").click(function(){
        
        var select = $('#select').val();
        // console.log(select);
        
        var subj = $('#s_subject').val();
        $('.temp').remove();


        //array of publishers checked
        var publisher = [];
        $('.pub').each(function(){
            if($(this).prop('checked') == true){
               console.log($(this).attr('name'));
               publisher.push($(this).attr('name'));
                
            }
        });
        console.log(publisher);
        
        
        
        $.ajax({url: "./../search.php",data : {type: select, query : subj, Publisher : publisher}, success: function(result){

            var ret = JSON.parse(result);
            
            // console.log(ret.count);
    
            ret[0].forEach(element => {            
                $("#main_table").append(`<tr class='temp'><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = ret.count;
            $('#top').append(`<p class='temp'>Total results: `+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=1; i<=no_of_pages; i++){
                if (i!=total_res) {
                    $('#pages').append(`<button class='temp'>`+i+`</button>`);                        
                }else{
                    $('#pages').append(i);                        
                }
            }
        }});

    });


//clear
    $("#sub2").click(function(){

        var title = '';
        var subj ='';
        $('#s_title').val('');
        $('#s_subject').val('');
        $('.temp').remove();

//unchecking checkbox
        $('.pub').each(function(){
            $(this).prop('checked',false);
        });

//adding all publishers into array

var publisher = [];
    $('.pub').each(function(){
       publisher.push($(this).attr('name'));
    });

        $.ajax({url: "./../search.php",data : {type: 'title', query : '', Publisher : publisher}, success: function(result){
            var ret = JSON.parse(result);

            // console.log(ret.count);
    
            ret[0].forEach(element => {            
                $("#main_table").append(`<tr class='temp'><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = ret.count;
            $('#top').append(`<p class='temp'>Total results: `+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=1; i<=no_of_pages; i++){
                if (i!=total_res) {
                    $('#pages').append(`<button class='temp' >`+i+`</button>`);                        
                }else{
                    $('#pages').append(i);                        
                }
            }
        }});
    });

//different page
    $('#pages').children('button').click(function(){
        var Page_no = $(this).html();
        var select = $('#select').val();
        var subj = $('#s_subject').val();
        $('.temp').remove();


        $.ajax({url: "./../search.php",data : {type: select, query : subj, page: Page_no}, success: function(result){
            var ret = JSON.parse(result);

            // console.log(ret.count);
    
            ret[0].forEach(element => {            
                $("#main_table").append(`<tr class='temp'><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
            });
            var total_res = ret.count;
            $('#top').append(`<p class='temp'>Total results: `+ total_res +`</p>`)
            var no_of_pages = Math.ceil(total_res/25);
            for(var i=1; i<=no_of_pages; i++){
                if (i!=total_res) {
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
    // console.log(alphabet);
    $('.temp').remove();
    var select = $('#select').val();


    
    $.ajax({url: "./../search_alphabet.php",data : {type: select, query : "", char: alphabet, page: ""}, success: function(result){
        var ret = JSON.parse(result);

        // console.log(ret.count);

        ret[0].forEach(element => {            
            $("#main_table").append(`<tr class='temp'><td>`+element.ISSN+`</td><td><a href="">`+ element.Title +`</a> </td><td><a href="">`+element.Publisher+`</a> </td><td><a href="">`+element.Accessible_from+`</a> </td><td><a href="">`+element.Accessible_upto+`</a></td><td><a href="`+element.URL+`">`+element.URL+`</a></td><td><a href="">`+element.Subject+`</a></td></tr>`);
        });
        var total_res = ret.count;
        
        $('#top').append(`<p class='temp'>Total results: `+ total_res +`</p>`)
        var no_of_pages = Math.ceil(total_res/25);
        for(var i=1; i<=no_of_pages; i++){
            if (i!=total_res) {
                $('#pages').append(`<button class='temp'>`+i+`</button>`);                        
            }else{
                $('#pages').append(`<p class='temp'> `+i+`<\p>`);                        
            }
        }
    }});
});





});