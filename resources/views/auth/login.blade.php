
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <style>
            .invalid-feedback{
                color: red;
            }
        </style>
    </head>
    <body>
        
        <div class="main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-8 col-lg-10 col-md-offset-2 col-lg-offset-1 main-area">
                        <div class="header-container">
                            <div class="row w100 d-flex align-item-center">
                                <div class="col-xs-3 logo-container">
                                    <img src="images/logo.png" alt="">
                                </div>
                                <div class="col-xs-6 title-container">
                                    <span>
                                        Hridoy Bricks
                                    </span>
                                </div>
                                <div class="col-xs-3"></div>
                            </div>
                        </div>

                        <div class="login-area w100">
                            <div class="login-header">Login to create a Session</div>
                            <div class="login-form">
 <span id="password_lebel" onclick="showhide()">Toggle</span>
                                <form action="{{ route('login') }}" method="POST" class="form-horizontal">
                                @csrf
                                    <div class="form-group">
                                        <div class="wrap-items">
                                            <div class="col-xs-12 col-md-3 col-lg-2">
                                                <label class="align-item-center" for="username">{{ __('E-Mail Address') }}</label>
                                            </div>
                                            <div class="col-xs-12 col-md-9 col-lg-10">
                                                <input type="text" placeholder="Email" id="email" name="email" class="form-control myInput @error('email') is-invalid @enderror" autocomplete="off">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="wrap-items">
                                            <div class="col-xs-12 col-md-3 col-lg-2">
                                                <label class="align-item-center" for="password">Password</label>
                                               
                                            </div>
                                            <div class="col-xs-12 col-md-9 col-lg-10">
                                                <input type="password" placeholder="Password" id="password" name="password" class="form-control myInput @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="wrap-items">
                                            <div class="col-xs-12 col-md-3 col-lg-2"></div>
                                            <div class="col-xs-12 col-md-9 col-lg-10">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row w100">
                                            <div class="col-xs-12 pr-1">
                                                <button type="submit" class="btn btn-custom pull-right">{{ __('Login') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                                <hr>
                                <div class="link-container">
                                    <ul>
                                        @if (Route::has('password.request'))
                                            <li><a href="{{ route('password.request') }}">Forget Password</a></li>
                                        @endif
                                        <li><a href="{{ route('register') }}">Request New Account</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer">
                            <span>
                                All rights reserved © <span>A.B. Siddik</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>

        <script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/notify.min.js') }}"></script>


        <script>
            /*$(document).ready(function() {



                const msg = {
                    error : {
                        autoHideDelay: 5000,
                        elementPosition: 'bottom left',
                        globalPosition : 'right top',
                        className : 'error',
                        hideAnimation: 'fadeOut',
                        hideDuration : 500,
                    },
                    success : {
                        autoHideDelay: 5000,
                        elementPosition: 'bottom left',
                        globalPosition : 'right top',
                        className : 'success',
                        hideAnimation: 'fadeOut',
                        hideDuration : 500,
                    },
                    warn : {
                        autoHideDelay: 500000,
                        elementPosition: 'bottom left',
                        globalPosition : 'right top',
                        className : 'warn',
                        hideAnimation: 'fadeOut',
                        hideDuration : 500,
                    }
                };

                // animation configarations 

                const anicon = {
                    effect : "shake",
                    // animation itrantion count 
                    times : 2,
                    distance : 30,
                    duration : 500
                };

                // common sellecters 

                const x = {
                    username : $('#username'),
                    password : $('#password'),
                    box      : $('.main-area'),
                    button   : $('#btn_login')
                }

                

                function runError(selecter) {
                    var color = selecter.css('background');
                    selecter.css('background', "#ff1a1a6b");
                    selecter.effect(anicon.effect,{
                        times: anicon.times,
                        distance: anicon.distance
                    }, 
                    anicon.duration, function () {
                        $(this).css("background", color);
                    });
                }

                function runEffect(selecter, callback = '') {
                    selecter.effect(anicon.effect,{
                        times: anicon.times,
                        distance: anicon.distance
                    }, anicon.duration, callback);
                }




                function preventInput(selecter) {
                    selecter.keyup(function() {
                        $(this).val('');
                    });
                }

                function user_login() {
                    let username = x.username.val();
                    let password = x.password.val();

                    if($.trim(username).length > 0 || password != ''){

                        $.ajax({
                           url: "ajax/login.php",
                           method: "POST",
                           dataType: "JSON",
                           data: {
                            username : username,
                            password : password,
                            what     : 'start_session'
                           },
                           beforeSend : function() {
                               x.button.attr('disabled' , 'disabled');
                           },
                           success: function(res){
                                x.button.removeAttr('disabled');

                                $.notify(res.m, res.s);

                                if(res.s == 'success'){
                                    $.notify(res.m, msg.success);
                                    $.notify("Redirection To Dashboard", msg.success);
                                    anicon.effect = "pulsate";
                                    anicon.duration = 3000;
                                    runEffect(x.box, function() {
                                        location.reload(true); 
                                    });
                                }else{
                                    runError(x.box);
                                }
                           }
                          });

                    }else{
                        runError(x.box);
                        $.notify('Fill out all fields', msg.error);
                    }
                }


                $('#btn_login').click(function(e) {
                    e.preventDefault();
                    user_login();
                });
                
            });*/
            let lebel = document.getElementById('password_lebel');
            let pass = document.getElementById('password');
            
            let type = pass.getAttribute("type");
           
            
            function showhide(){
                let lebel = document.getElementById('password_lebel');
                let pass = document.getElementById('password');
                
                let type = pass.getAttribute("type");
                if(type == 'password'){
                    pass.setAttribute('type', 'text');
                }else{
                    pass.setAttribute('type', 'password');
                }
            }
        </script>
    </body>
</html>
