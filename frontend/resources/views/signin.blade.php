<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

  <title>Quirk Responsive Admin Templates</title>

  <link rel="stylesheet" href="{{asset('assets/lib/fontawesome/css/font-awesome.css')}}">

  <link rel="stylesheet" href="{{asset('assets/css/quirk.css')}}">

  <script src="{{asset('assets/lib/modernizr/modernizr.js')}}"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
    <div class="panel-heading">
      <h1>RemindMe</h1>
      <h4 class="panel-title">Welcome! Please signin.</h4>
      @if(Session::has('error'))
      <br>

      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><span class="fa fa-close"></span></strong>
        <strong> {{ Session::get('error') }}</strong>
      </div>


      @endif
    </div>
    <div class="panel-body">
    {{ html()->form('POST', '/session')->open() }}
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Email", required />
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Enter Password", required />
          </div>
        </div>
        <div><a href="" class="forgot"></a></div>
        <div class="form-group">
          <button class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
      </form>
      <hr class="invisible">
    </div>
  </div><!-- panel -->

</body>
</html>
