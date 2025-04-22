<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPICON Dashboard || Sign-Up</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" id="bootstrap-css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
/*background-image: url('https://getwallpapers.com/wallpaper/full/3/e/f/63216.jpg');*/
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
background-color: darkseagreen;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 455px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #12ffbdb3;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #12ffbdb3;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
height: 20px;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #12ffbdb3;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>

<body>
  <div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header">
        <h3>Sign Up</h3>
        <div class="d-flex justify-content-end social_icon">
          <span></span>
          <!-- <span><i class="fab fa-google-plus-square"></i></span>
          <span><i class="fab fa-twitter-square"></i></span> -->
        </div>
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autocomplete="email" autofocus>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <select type="number" class="form-control" id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="3">Vertical</option>
                <option value="4">Spoc</option>
                <option value="5">Team</option>
                <option value="6">Vendor</option>
                <option value="7">Beneficiary</option>
            </select>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="password" placeholder="Password">
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirm Password">
          </div>
          <div class="remember"></div>
         <!--  <div class="row align-items-center remember">
            <input type="checkbox">Remember Me
          </div> -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          Don't have an account?<a href="{{route('login')}}">Sign In</a>
        </div>
        <!-- <div class="d-flex justify-content-center">
          <a href="#">Forgot your password?</a>
        </div> -->
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>