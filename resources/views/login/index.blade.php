<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: 5px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
  </head>

  <?php $image = asset('assets/images/back.jpg'); ?>
  <body class="text-center" style="background:url(<?php echo $image;?>) no-repeat center center;">
    <form class="form-signin">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control" placeholder="Email address"  autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Password">
        <div class="checkbox mb-3">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="<?php echo asset('assets/js/notify.min.js'); ?>"></script>
	
    <script>
        $(function(){
            
            $('.form-signin').submit((event)=>{
				const email     = $("#email").val().trim(),
                    password 	= $('#password').val().trim(),
                    _token      = $('#token').val();

                if(email == ''){
                    $.notify('Please email enter...','error');
                    $("#email").focus();
                    return false;
                }
				
                if(password == ''){
                    $.notify('Please password enter...','error');
                    $("#password").focus();
                    return false;
                }

				$.ajax({
                    url       : 'sign-in',
                    method    : 'POST',
                    data      : {email:email, password:password, _token:_token },
                    dataTYpe  : 'json',
                    success   : function(response) {
                        $.notify(response.message, response.class);

                        if(response.status){
                            //window.location.href = window.origin.'/dashboard';
                        }
                    },
                    error     : function(data){
                        console.log(data);
                    }
                });
                return false;
            });
        });
    </script>
  </body>
</html>
