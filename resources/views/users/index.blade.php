<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Home Page</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Include Toastr CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
      <!-- Include jQuery (required for Toastr) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Include Toastr JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   </head>
   <style>
      .reserve-date{
         background-color: transparent;
         color: white;
         border: 1px solid white;
      }
   </style>
   <!-- body -->
   <body class="main-layout">
      <!-- header -->
      @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{  $error }}")
            </script>
        @endforeach
      @endif
      @if(Session::has('success'))
         <script>
               toastr.success("{{ Session::get('success') }}")
         </script>
      @endif
      <header>
         <!-- header inner -->
         <div class="header sticky-top">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="{{ route('usersHome') }}"><img src="{{ asset('assets/img/icons/logo.jpg') }}" style="height: 60px !important"/></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark sticky-top">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{ route('usersHome') }}">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#about">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#ourroom">Our room</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#gallery">Gallery</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#blog">Blog</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#contact">Contact Us</a>
                              </li>
                              <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Users
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @guest
                                       <a class="dropdown-item" href="{{ route('usersLogin') }}">Login</a>
                                       <a class="dropdown-item" href="{{ route('usersRegister') }}">Register</a>
                                    @else
                                       <a class="dropdown-item" href="#">Find Rooms</a>
                                       <a class="dropdown-item" href="{{ route('reservationMy') }}">My Reservations</a>
                                       <a class="dropdown-item" href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                       </a>

                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                          @csrf
                                       </form>
                                    @endguest
                                 </div>
                             </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide col-12" src="/images/banner1.jpg" alt="First slide">
                  <div class="container">
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide col-12" src="/images/banner2.jpg" alt="Second slide">
               </div>
               <div class="carousel-item">
                  <img class="third-slide col-12" src="/images/banner3.jpg" alt="Third slide">
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
         <div class="booking_ocline">
            <div class="container">
               <div class="row">
                  <div class="col-md-5">
                     <div class="book_room">
                        <h1>Find Room</h1>
                        <form class="book_now" action="{{ route('usersFindRooms') }}" method="POST"> @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <span>Check in</span>
                                 <input class="form-control reserve-date" placeholder="dd/mm/yyyy" type="date" name="checkin" min="{{ date('Y-m-d') }}">
                              </div>
                              <div class="col-md-12">
                                 <span>Check out</span>
                                 <input class="form-control reserve-date" placeholder="dd/mm/yyyy" type="date" name="checkout" min="{{ date('Y-m-d') }}">
                              </div>
                              <div class="col-md-12 mt-3">
                                 @guest
                                    <a href="javascript:void(0)" class="book_btn text-center" id="bookNowLink">Book Now</a>
                                 @else
                                    <button class="book_btn">Book Now</button>
                                 @endguest
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end banner -->
      <!-- about -->
      <div class="about" id="about">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-5">
                  <div class="titlepage">
                     <h2>About Us</h2>
                     <p>The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it's seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum. </p>
                     <a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure><img src="/images/about.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- our_room -->
      <div  class="our_room" id="ourroom">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Room</h2>
                     <p>Discover Our Luxurious and Comfortable Bed Rooms </p>
                  </div>
               </div>
            </div>
            @if (count($rooms) <= 0)
               <div class="row justify-content-center">
                  <div class="col-md-8">
                     <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/0a731f25-c465-43fd-84d3-c19915e2f23f/HGDqixWDVY.json" background="##FFFFFF" speed="1" style="width: 40%;" loop autoplay direction="1" mode="normal"></lottie-player>
                        <h4 class="text-center">No rooms found</h4>
                     </div>
                  </div>
               </div>
            @else
               <div class="row">
                 @foreach ($rooms as $item)
                     <div class="col-md-4 col-sm-6">
                        <div id="serv_hover"  class="room">
                           <div class="room_img">
                              <figure><img src="/{{ $item->file_path }}" alt="#" witdh="100" height="100"/></figure>
                           </div>
                           <div class="p-4 text-left">
                              <h2><strong>{{ config('const.room_type.'. $item->type) }}</strong></h2>
                              <span>{{ $item->number }}</span>
                              <p class="mb-2">{{ $item->description }} </p>
                              <p class="text-success">₱{{ number_format($item->price, 2) }}</p>
                              <p class="{{ $item->status == 0 ? 'text-warning' : 'text-danger' }}">{{ config('const.room_status.'. $item->status) }}</p>
                              @guest
                              @else
                                 @if ($item->status == 0)
                                    <a href="{{ route('reservationMake', ['id' => encrypt($item->id)]) }}" class="btn btn-primary">Reserve</a>
                                 @endif
                              @endguest
                           </div>
                        </div>
                     </div>
                 @endforeach
               </div>
            @endif
         </div>
      </div>
      <!-- end our_room -->
      <!-- gallery -->
      <div  class="gallery" id="gallery">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>gallery</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery1.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery2.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery3.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery4.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery5.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery6.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery7.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="/images/gallery8.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end gallery -->
      <!-- blog -->
      <div  class="blog" id="blog">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Blog</h2>
                     <p>Lorem Ipsum available, but the majority have suffered </p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="blog_box">
                     <div class="blog_img">
                        <figure><img src="/images/blog1.jpg" alt="#"/></figure>
                     </div>
                     <div class="blog_room">
                        <h3>Bed Room</h3>
                        <span>The standard chunk </span>
                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are   </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="blog_box">
                     <div class="blog_img">
                        <figure><img src="/images/blog2.jpg" alt="#"/></figure>
                     </div>
                     <div class="blog_room">
                        <h3>Bed Room</h3>
                        <span>The standard chunk </span>
                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are   </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="blog_box">
                     <div class="blog_img">
                        <figure><img src="/images/blog3.jpg" alt="#"/></figure>
                     </div>
                     <div class="blog_room">
                        <h3>Bed Room</h3>
                        <span>The standard chunk </span>
                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are   </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end blog -->
      <!--  contact -->
      @if ($errors->any())
         @foreach ($errors->all() as $error)
            <script>
                  toastr.error("{{  $error }}")
            </script>
         @endforeach
      @endif
      @if(Session::has('success'))
         <script>
            toastr.success("{{ Session::get('success') }}")
         </script>
      @endif
      <div class="contact" id="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form id="request" class="main_form" action="{{ route('sendMessage') }}" method="POST"> @csrf
                     <div class="row">
                        <div class="col-md-12 ">
                           @guest
                              <input class="contactus" placeholder="Name" type="type" name="name"> 
                           @else
                              <input type="text" placeholder="Name" value="{{ Auth::user()->name }}" name="name" class="contactus">
                           @endguest
                        </div>
                        <div class="col-md-12">
                           @guest
                              <input class="contactus" placeholder="Email" type="type" name="email" value=""> 
                           @else
                              <input class="contactus" placeholder="Email" type="type" name="email" value="{{ Auth::user()->email }}"> 
                          @endguest
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="type" name="phone_number">                          
                        </div>
                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" type="type" name="message" Message="Name" placeholder="Message"></textarea>
                        </div>
                        <div class="col-md-12">
                           @guest
                              <a href="{{ route('usersLogin') }}" class="send_btn text-center">Send</a>
                           @else   
                              <button class="send_btn" type="submit">Send</button>
                           @endguest
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.424976338424!2d124.97941337586758!3d10.387781589738365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x330711cfc19de329%3A0x12b32cbc360a640d!2sGmb%20Arte%20Hotel!5e0!3m2!1sen!2sph!4v1716394032055!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-4">
                     <h3>Contact US</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about"> about</a></li>
                        <li><a href="#ourroom">Our Room</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>News letter</h3>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="/js/jquery.min.js"></script>
      <script src="/js/bootstrap.bundle.min.js"></script>
      <script src="/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="/js/custom.js"></script>
      <script>
         $(document).ready(function(){
            $('#bookNowLink').click(function(e) {
               e.preventDefault();
               var checkin = $('input[name="checkin"]').val();
               var checkout = $('input[name="checkout"]').val();
               sessionStorage.setItem('checkIn', checkin);
               sessionStorage.setItem('checkOut', checkout);
               sessionStorage.setItem('bookNowClicked', 'true');

               window.location.href = "{{ route('usersLogin') }}";
            });
         });
      </script>
   </body>
</html>