<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

  <title>Reminders</title>

  <link rel="stylesheet" href="{{asset('assets/lib/fontawesome/css/font-awesome.css"')}}">
  <link rel="stylesheet" href="{{asset('assets/lib/jquery-ui/jquery-ui.css')}}">

  <link rel="stylesheet" href="{{asset('assets/css/quirk.css')}}">

  <script src="{{asset('assets/lib/modernizr/modernizr.js')}}"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>

  <header>
    <div class="headerpanel">

      <div class="logopanel">
        <h2><a href="index.html">RemindMe</a></h2>
      </div><!-- logopanel -->

      <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

        <div class="header-right">
          <ul class="headermenu">
            <li>
              <div id="noticePanel" class="btn-group">
                <button class="btn btn-notice alert-notice" data-toggle="dropdown">
                  <i class="fa fa-globe"></i>
                </button>
                
              </div>
            </li>
            <li>
              <div class="btn-group">
                <button type="button" class="btn btn-logged" data-toggle="dropdown">
                  <img src="images/photos/loggeduser.png" alt="" />
                  Elen Adarna
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                  
                  <li><a href="signin.html"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div><!-- header-right -->
      </div><!-- headerbar -->
    </div><!-- header-->
  </header>

  <section>

    <div class="leftpanel">
      <div class="leftpanelinner">

        <!-- ################## LEFT PANEL PROFILE ################## -->

        <div class="media leftpanel-profile">
          <div class="media-left">
            <a href="#">
              <img src="../images/photos/loggeduser.png" alt="" class="media-object img-circle">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading"> <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
            <span> </span>
          </div>
        </div><!-- leftpanel-profile -->

        <div class="tab-content">

          <!-- ################# MAIN MENU ################### -->

          <div class="tab-pane active" id="mainmenu">
            <h5 class="sidebar-title">Favorites</h5>
            <ul class="nav nav-pills nav-stacked nav-quirk">
              <li><a href="/reminders/create"><i class="fa fa-home"></i> <span>Create Reminder</span></a></li>
            </ul>

          </div><!-- tab-pane -->

        </div><!-- tab-content -->

      </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">

      <div class="contentpanel">

        @yield('content')

        <!-- content goes here... -->

      </div><!-- contentpanel -->
    </div><!-- mainpanel -->
</section>


<script src="{{asset('assets/js/quirk.js')}}"></script>

</body>
</html>
