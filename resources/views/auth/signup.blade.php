<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Title -->
  <title>EduMin - Education Admin Dashboard Template | dexignlabs</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="dexignlabs">
  <meta name="robots" content="index, follow">

  <meta name="keywords" content="">

  <meta name="description" content="">

  <meta property="og:title" content="">
  <meta property="og:description" content="">

  <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">

  <meta name="format-detection" content="telephone=no">

  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">

  <meta name="twitter:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">

  <!-- STYLESHEETS -->
  <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./vendor/select2/css/select2.min.css">
  <link class="main-css" rel="stylesheet" href="css/style.css">
  <!-- STYLESHEETS -->





</head>

<body>
  <div class="fix-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <div class="card mb-0 h-auto">
            <div class="card-body">
              <div class="text-center mb-2">
                <a href="index.html">
                  <h1>MY WRITER</h1>
                </a>
              </div>
              <h4 class="text-center mb-4">Sign up your account</h4>
              <div id="invalid_signup_data" class="error" style="display:none">Email or mobile number already exists</div>

              <form role="form text-left" id="signup_form" method="POST" action="{{route('signup')}}">
                @csrf
                <div class="form-group">
                  <label class="form-label" for="username">First Name</label>
                  <input type="text" class="form-control" placeholder="firstname" name="tutor_first_name" id="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="username">Last Name</label>
                  <input type="text" class="form-control" placeholder="lastname"  name="tutor_last_name"  id="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="username">Contact</label>
                  <input type="text" class="form-control" placeholder="contact"  name="tutor_contact_no" id="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" placeholder="hello@example.com"  name="tutor_email" id="email">
                </div>
                <div class="form-group">
                  <label class="form-label" for="username">Subject</label>
                  <select class="form-control multi-select" name="tutor_subject[]" id="tutor_subject" multiple>
                    @if(!empty($subjects))
                    @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="mb-4 position-relative">
                  <label class="form-label" for="dlabPassword">Password</label>
                  <input type="password" id="dlabPassword" name="password" class="form-control" value="123456">
                  <span class="show-pass eye">
                    <i class="fa fa-eye-slash"></i>
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                </div>
              </form>
              <div class="new-account mt-3">
                <p>Already have an account? <a class="text-primary" href="{{route('login')}}">Sign in</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <script src="vendor/global/global.min.js"></script>
  <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>


  <script src="vendor/select2/js/select2.full.min.js"></script>
  <script src="js/plugins-init/select2-init.js"></script>

  <!-- Svganimation scripts -->
  <script src="vendor/svganimation/vivus.min.js"></script>
  <script src="vendor/svganimation/svg.animation.js"></script>

  <script src="js/custom.min.js"></script>
  <script src="js/dlabnav-init.js"></script>



</body>

</html>