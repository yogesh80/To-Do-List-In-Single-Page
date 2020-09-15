<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link  rel="stylesheet"  href="{{asset('todo.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .error{
            outline: 1px solid red;
        }    
    </style>
    
    <!-- Styles -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>

 
    $(document).ready(function() {
        $('#AddList').attr('disabled', 'disabled');

        $(document).on('keyup','.todo-list-input',function() {

               var empty = false;
                if ($(this).val().length <= 4) {
                    empty = true;
                }

            if (empty) {
                $('#AddList').attr('disabled', 'disabled');
            } else {
                $('#AddList').removeAttr('disabled');
            }
            });
        
            
        // Trigger ajax function on save button click
        $(document).on('submit','#taskForm',function() {
            event.preventDefault();

                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            });


                    var formData = $("#taskForm").serialize();

                    $.ajax({
                            type    :   "POST",
                            url     :   "{{route('admin.tasks.store')}}",
                            data    :   formData,
                            dataType :   "json",

                            success: function(res) { 

                                if(res.error){
                                    $('.todo-list-input').val('');
                                    $('#AddList').attr('disabled', 'disabled');

                                    $('.backenderror').html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.error + "</div>");
                                }
                                if(res.status == "success") {
                                    $('.todo-list-input').val('');
                                    $('#AddList').attr('disabled', 'disabled');
                                    $('.todo-list').append('<li id="'+res.task.id+'"><div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox">'+res.task.task+' <i class="input-helper"></i></label> </div> <button  class="btn btn-danger delete ml-4" value="'+res.task.id+'"><i class="fa fa-trash" aria-hidden="true" onclick=""></i></button></li>')
                                    $(".backenderror").html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                                }

                                else if(res.status == "failed") {
                                    $('.todo-list-input').val('');
                                    $('#AddList').attr('disabled', 'disabled');

                                    $(".backenderror").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                                }
                            }                   
                    });

           
        });        
    });

</script>
<script >
        $(document).ready(function() {

      $(document).on('click','.delete',function(){
        var id= $(this).val();


                   var url = "{{ route('admin.tasks.destroy','') }}"+"/"+id;
                   
                            //pop up
                            swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this record!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: false
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                            type: 'DELETE',
                            url: url,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {"id":id},
                            success: function(data) {
                                swal(data.status, data.message, "success");
                                $('#'+id).closest('li').remove();


    
                            
                            },
                            error: { }
                        });
              } else {
              }
            });
               
               
               
               });


               $(document).on('click','.checkbox',function(){
                   var id= $(this).val();
                   var url = "{{ route('admin.changeStatus','') }}"+"/"+id;

                $.ajax({
                            type: 'get',
                            url: url,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {"id":id},
                            success: function(data) {
                                $('#'+id).closest('li').remove();


    
                            
                            },
                            error: { }
                        });
              
               
               
               
               });


               $(document).on('click','.all',function(){
                   var url = "{{ route('admin.tasks.index') }}";

                $.ajax({
                            type: 'get',
                            url: url,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data) {
                               if(data.status=='failed'){
                                   swal(data.status, data.message, "info");

                               }else{
                                   $('.show').html(data);
                                }
    
                            
                            },
                            error: { }
                        });
              
               
               
               
               });

    
            });
  
    
    </script>
</body>

</html>
