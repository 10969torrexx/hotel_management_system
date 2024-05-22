<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
      <meta charset="utf-8" />
      <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
      />

      <title>Login</title>

      <meta name="description" content="" />

      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
      />

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="../assets/css/demo.css" />

      <!-- Vendors CSS -->
      <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
      <!-- Helpers -->
      <script src="../assets/vendor/js/helpers.js"></script>

      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="../assets/js/config.js"></script>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Include Toastr CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
      <!-- Include jQuery (required for Toastr) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Include Toastr JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="mb-3 row justify-content-center">
                <img src="{{ asset('assets/img/icons/logo.jpg') }}" app-brand-logoalt="" class="col-6">
              </div>
              <div class="app-brand justify-content-center">
                  <h2><strong>Login</strong></h2>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Login</h4>
              <div class="mt-2 text-center">
                <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-callback="onSignIn"></div>
                <div class="g_id_signin form-control" data-type="standard"></div>
              </div>

              <form id="formAuthentication" class="mb-3" action="#">
                <div class="mb-3">
                  <label for="email" class="form-label">Email or Username</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="button" id="loginbutton">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('adminRegister') }}">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src = "https://accounts.google.com/gsi/client" async defer></script>
    <script>
        function decodeJwtResponse(token){
            let base64url = token.split('.')[1];
            let base64 = base64url.replace(/-/g, '+').replace(/_/g, '/');
            let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) { 
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            return JSON.parse(jsonPayload);
        }
    
        window.onSignIn = googleUser =>{
            var user = decodeJwtResponse(googleUser.credential);
            if(user){
                $.ajaxSetup({
                    headers: {  'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }
                });
                $.ajax({
                    url: `{{ route('googleSignIn') }}`,
                    method: 'POST',
                    data: {
                        email: user.email,
                        name: user.name,
                        role: 'admin',
                        picture: user.picture
                    },
                    beforeSend: function(){
                        $('#btnLogin').html("REDIRECTING...").prop("disabled", true);
                    },
                    success:function(response){
                        if(response.status == 200) {
                          var redirectTo = response.account.role == 'admin' ? "{{ route('adminHome') }}" : "{{ route('usersHome') }}";
                          toastr.success(`${response.message}`, 'Success!');
                          $('#btnLogin').html("Login").prop("disabled", false);
                          setTimeout(() => {
                            window.location.href = redirectTo;
                          }, 2000);
                        }
                        if (response.status == 300) {
                            $('#btnLogin').html("Login").prop("disabled", false);
                            toastr.error(response.message, 'Error!');
                        }
                    },
                    error:function(xhr, status, error){
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        }

        $('#loginbutton').click(function(){
             var email = $('#email').val();
            var password = $('#password').val();
            $.ajaxSetup({
                headers: {  'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: `{{ route('usersLoginConfirm') }}`,
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                beforeSend: function(){
                    $('#loginbutton').html("REDIRECTING...").prop("disabled", true);
                },
                success:function(response){
                    if(response.status == 200) {
                      var redirectTo = response.account.role == 'admin' ? "{{ route('adminHome') }}" : "{{ route('usersHome') }}";
                      toastr.success(`${response.message}`, 'Success!');
                      $('#loginbutton').html("Login").prop("disabled", false);
                      setTimeout(() => {
                        window.location.href = redirectTo;
                      }, 2000);
                    }
                    if (response.status == 300) {
                        $('#loginbutton').html("Login").prop("disabled", false);
                        toastr.error(response.message, 'Error!');
                       
                    }
                },
                error:function(xhr, status, error){
                    toastr.error(xhr.responseJSON.message, 'Error!');
                    setTimeout(() => {
                      $('#loginbutton').html("Login").prop("disabled", false);
                    }, 2000);
                }
            });
        });
    </script>
  </body>
</html>
