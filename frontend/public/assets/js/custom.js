$(document).ready(function(){

    $('.datatable').DataTable();

    $('table').on('click','a.delete-record',function(ev){
        ev.preventDefault();

        $route = $(this).attr('href');
        bootbox.confirm("<h3>Are you sure you want to Delete ?</h3>", function(result) {
            if(result){

                $.ajax({
                    type: "POST",
                    url : $route,
                    data: {'_method':'DELETE'},
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data +" </h3>",function(result) {
                        window.location.reload();
                    });

                }
            });

            }
        }); 
    });
    

    $('table').on('click','a.prompt-user',function(ev){
        ev.preventDefault();

        $route = $(this).attr('href');
        bootbox.confirm("<h3>Are you sure you want to do this ?</h3>", function(result) {
            if(result){

                $.ajax({
                    type: "GET",
                    url : $route,
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data +" </h3>",function(result) {
                        window.location.reload();
                    });

                }
            });

            }
        }); 
    });




    

    

    $('.appoint').on('click','a.delete-record',function(ev){
        ev.preventDefault();

        $route = $(this).attr('href');
        bootbox.confirm("<h3>Are you sure you want to Delete ?</h3>", function(result) {
            if(result){

                $.ajax({
                    type: "POST",
                    url : $route,
                    data: {'_method':'DELETE'},
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data +" </h3>",function(result) {
                        window.location.reload();
                    });

                }
            });

            }
        }); 
    });


    $('#search-result').on('click','a.delete-record2',function(ev){
        ev.preventDefault();

        $route = $(this).attr('href');
        bootbox.confirm("<h3>Are you sure you want to Delete ?</h3>", function(result) {
            if(result){

                $.ajax({
                    type: "POST",
                    url : $route,
                    data: {'_method':'DELETE'},
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data +" </h3>",function(result) {
                        window.location.reload();
                    });

                }
            });

            }
        }); 
    });





// $('#profile').change(function(){

//     alert('hi');

//   var img = $('#passport-image');
//   readURL(this,img);

//   console.log('reading');


// });

// function readURL(input,img) {
//   if (input.files && input.files[0]) {
//     var reader = new FileReader();

//     reader.onload = function (e) {
//       img.attr('src', e.target.result);
//     }

//     reader.readAsDataURL(input.files[0]);
//   }
// }




$('#search').keyup(function(ev){

    var text = $(this).val().trim();
    if(text == ""){
        document.location.reload();
    }
    var result = $('#search-result');
    $.ajax({
        type: "GET",
        url : document.location,
        data: {'text': text},
        beforeSend: function(request) {
           return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
       },
       success: function(data){
        result.html(data);  

    }
});



});





$('.media-list').on('click','a.delete-record',function(ev){
    ev.preventDefault();
    

    $route = $(this).attr('href');
    bootbox.confirm("<h3>Are you sure you want to  ?</h3>", function(result) {
        if(result){

            $.ajax({
                type: "POST",
                url : $route,
                    // data: {'_method':'POST'},
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data +" </h3>",function(result) {
                        window.location.reload();
                    });

                }
            });

        }
    }); 
});





$('.upload').on('click', function(ev){

    $row = $(this).parents('.t-row');
    $asid = $row.find('.asid').html();
    $('#ass_id').val($asid);
});



$('#record_search').keyup(function(){
   
    delay(function(){
      $html = '';
      $search_text = $('#record_search').val();
      

      $.ajax({
        type: "GET",
        url : '/get-students',
        data: {'text': $search_text },
        beforeSend: function(request) {
          return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
      },
      success: function(data){
        $('#students-div').html(data);

        
        
    }
});


  }, 300);


});

$('#record_search_barcode').keyup(function(){

        delay(function(){
            $search_text = $('#record_search_barcode').val();
            $.ajax({
                type: "GET",
                url : '/get-students-barcode',
                data: {'text': $search_text },
                beforeSend: function(request) {
                    return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
                },
                success: function(res){

                    document.location.href = res.url;
                    document.reload();
                }
            });


        }, 200);


    });


$('#semester_id').change(function(e){
    var running_course = $('#running_course_id');
    var semester_id = $(this).val();
    
    running_course.html('<option>Updating Running courses list.....</option>');
    running_course.attr('disabled',true);
    $.ajax({
        type: "GET",
        url : '/get-running-courses',
        data: {'semester_id': semester_id },
        beforeSend: function(request) {
          return request.setRequestHeader("X-CSRF-Token", $("input[name='_token']").val());
      },
      success: function(data){
        running_course.html(data);
        running_course.attr('disabled',false);

        
        
    }
});

})






$( '.datepicker' ).pickadate({
    monthSelector: true,
    yearSelector: true,
    yearSelector: 100,
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd'
});

$( '.dob-datepicker' ).pickadate({
    monthSelector: true,
    yearSelector: true,
    yearSelector: 100,
    dateMax: -1,
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd'
});








$('table').on('click', '.reg',function(e){
    e.preventDefault();

        // $row = $(this).parents('.t-row');
        $row = $(e.target);
        $cid = $(this).attr('data-id');
        $route = $(this).attr('href');
        $msg = '';
        if($row.html() == 'Register'){
         
            $msg = "<h3>Are you sure you want to register for this course?</h3>";
        }else{

            $msg = "<h3>Are you sure you want to drop this course?</h3>";
        }

        bootbox.confirm($msg, function(result) {
            if(result){
                //alert($route);
                $.ajax({
                    type: "POST",
                    url : $route,
                    data: {'running_course_id':$cid},
                    beforeSend: function(request) {
                       return request.setRequestHeader("X-CSRF-Token", $('.token').html());
                   },
                   success: function(data){
                    bootbox.alert("<h3 style='color:red;'>"+ data.msg +" </h3>",function(result) {
                            //window.location.reload();

                            if (data.status == 'registered')
                            {
                                $(this).attr('data-toggled','on');
                                //alert('toggled on... '+ $cid);
                                $row.find('.fa').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                                $row.find('.act').html('Unregister');
                                document.location.reload();

                            }else{
                                $(this).attr('data-toggled','off');
                                //alert('toggled off... '+ $cid);
                                $row.find('.fa').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                                $row.find('.act').html('Register');
                                document.location.reload();

                            }
                        });

                }
            });

            }
        }); 
    });







$('#profile').change(function(){
    console.log('started');
    var selected = $(this).val();
    alert(selected);
});


$('#ltype').change(function(){
    var selected = $(this).val();
       // alert(selected);
       if(selected === 'SICK'){
        $('.med-cert').css("display","block");
    }else{
        $('.med-cert').css("display","none");
    }
});



$('a[data-toggle="tab"]').on('click', function (e) {
    localStorage.setItem('lastTab', $(e.target).attr('href'));
});

var lastTab = localStorage.getItem('lastTab');

if (lastTab) {
    $('a[href="'+lastTab+'"]').click();
}



var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();














});