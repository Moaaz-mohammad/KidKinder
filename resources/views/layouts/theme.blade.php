<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title> @yield('page-title') </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="{{asset('theme/img/favicon.ico')}}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Flaticon Font -->
    <link href="{{asset('theme/lib/flaticon/font/flaticon.css')}}" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{asset('theme/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('theme/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet" />
    @yield('css')
  </head>

  <body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
      <nav
        class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a href="{{route('store')}}" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px" >
          <i class="flaticon-043-teddy-bear"></i>
          <span class="text-primary">KidKinder</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarCollapse"
        >
          <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="{{route('store')}}" class="nav-item nav-link active">Home</a>
            <a href="{{route('AboutPage')}}" class="nav-item nav-link">About</a>
            <a href="{{route('ClassesPage')}}" class="nav-item nav-link">Classes</a>
            <a href="{{route('TeamPage')}}" class="nav-item nav-link">Teachers</a>
            {{-- <a href="{{route('GalleryPage')}}" class="nav-item nav-link">Gallery</a> --}}
            {{-- <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"  >Pages</a >
                <div class="dropdown-menu rounded-0 m-0">
                  <a href="{{route('BlogPage')}}" class="dropdown-item">Blog Grid</a>
                  <a href="single.html" class="dropdown-item">Blog Detail</a>
                </div>
            </div> --}}
            <a href="{{route('ContactPage')}}" class="nav-item nav-link">Contact</a>
          </div>
          @auth
          <div>
            @if (auth()->check() && auth()->user()->hasRole('admin'))
              <a class=" btn btn-primary px-4" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              {{-- this button just for me to change the view to admin --}}
              <a href="{{route('dashboard')}}" class="btn btn-primary px-4">Dashboard</a>
            @else
              <a href="{{route('userProfile')}}" class="btn btn-primary px-4">Profile</a>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
          @else
            <a href="{{route('login')}}" class="btn btn-primary px-4">Login</a>
          @endauth
        </div>
      </nav>
    </div>
    <!-- Navbar End -->
        <div class="alert-container position-fixed top-0 end-0 p-3" style="z-index: 1100; width: 350px;">
          @include('theme-alert')
        </div>


    @yield('content')

  

        <!-- Footer Start -->
        <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
          <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
              <a
                href=""
                class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0"
                style="font-size: 40px; line-height: 40px"
              >
                <i class="flaticon-043-teddy-bear"></i>
                <span class="text-white">KidKinder</span>
              </a>
              <p>
                Labore dolor amet ipsum ea, erat sit ipsum duo eos. Volup amet ea
                dolor et magna dolor, elitr rebum duo est sed diam elitr. Stet elitr
                stet diam duo eos rebum ipsum diam ipsum elitr.
              </p>
              <div class="d-flex justify-content-start mt-4">
                <a
                  class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
                <a
                  class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
              <h3 class="text-primary mb-4">Get In Touch</h3>
              <div class="d-flex">
                <h4 class="fa fa-map-marker-alt text-primary"></h4>
                <div class="pl-3">
                  <h5 class="text-white">Address</h5>
                  <p>123 Street, New York, USA</p>
                </div>
              </div>
              <div class="d-flex">
                <h4 class="fa fa-envelope text-primary"></h4>
                <div class="pl-3">
                  <h5 class="text-white">Email</h5>
                  <p>{{config('app.contact_email')}}</p>
                </div>
              </div>
              <div class="d-flex">
                <h4 class="fa fa-phone-alt text-primary"></h4>
                <div class="pl-3">
                  <h5 class="text-white">Phone</h5>
                  <p>{{config('app.contact_phone')}}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
              <h3 class="text-primary mb-4">Quick Links</h3>
              <div class="d-flex flex-column justify-content-start">
                <a class="text-white mb-2" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>Home</a
                >
                <a class="text-white mb-2" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>About Us</a
                >
                <a class="text-white mb-2" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>Our Classes</a
                >
                <a class="text-white mb-2" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>Our Teachers</a
                >
                <a class="text-white mb-2" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>Our Blog</a
                >
                <a class="text-white" href="#"
                  ><i class="fa fa-angle-right mr-2"></i>Contact Us</a
                >
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
              <h3 class="text-primary mb-4">Newsletter</h3>
              <form action="">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control border-0 py-4"
                    placeholder="Your Name"
                    required="required"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control border-0 py-4"
                    placeholder="Your Email"
                    required="required"
                  />
                </div>
                <div>
                  <button
                    class="btn btn-primary btn-block border-0 py-3"
                    type="submit"
                  >
                    Submit Now
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;">
            <p class="m-0 text-center text-white">
              &copy;
              <a class="text-primary font-weight-bold" href="{{route('store')}}">KidKinder</a>
          </div>
      </div>
      <!-- Footer End -->
  
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary p-3 back-to-top"
        ><i class="fa fa-angle-double-up"></i
      ></a>
  
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('theme/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('theme/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('theme/lib/lightbox/js/lightbox.min.js')}}"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('theme/js/main.js')}}"></script>

    @yield('js')

    <script>
    $(document).ready(function () {
      $('.alert-action').delay(3000).fadeOut(2500);
    })
    </script>

  </body>
</html>
