<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema para el control de documentos de las normas ISO">
    <meta name="author" content="Lic. Raúl Martínez González">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="views/img/checkdocs-icon.png">
    <title>CHECK-DOCS</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets2/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- DATATABLES -->
    <!-- <link rel="stylesheet" href="assets/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/datatables/responsive.dataTables.min.css"> -->

    <!-- SELECT BOOTSTRAP -->
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-select.min.css"> -->

    <!-- SWEET ALERT -->
    <link rel="stylesheet" href="assets/sweetalert/sweetalert.css">

    <!-- Custom CSS -->
    <link href="views/css2/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="views/css2/colors/blue.css" id="theme" rel="stylesheet">

    <!-- ESTILOS PERSONALIZADOS -->
    <link rel="stylesheet" href="views/css/main.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Check-Docs</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
              <!-- Logo icon -->
              <b>
                  <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                  <!-- Dark Logo icon -->
                  <img src="assets2/images/logo-icon.png" alt="homepage" class="dark-logo" />
                  <!-- Light Logo icon -->
                  <img src="assets2/images/logo-light-icon.png" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span>
               <!-- dark Logo text -->
               <img src="assets2/images/logo-text.png" alt="homepage" class="dark-logo" />
               <!-- Light Logo text -->
               <img src="assets2/images/logo-light-text.png" class="light-logo" alt="homepage" />
             </span>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse">
              <!-- ============================================================== -->
              <!-- toggle and nav items -->
              <!-- ============================================================== -->
              <ul class="navbar-nav mr-auto">
                  <!-- This is  -->
                  <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                  <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                  <li class="nav-item hidden-sm-down"></li>
              </ul>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <ul class="navbar-nav my-lg-0">

                  <!-- ============================================================== -->
                  <!-- Comment -->
                  <!-- ============================================================== -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                          <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                          <ul>
                              <li>
                                  <div class="drop-title">Notifications</div>
                              </li>
                              <li>
                                  <div class="message-center">
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                          <div class="mail-contnet">
                                              <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                          <div class="mail-contnet">
                                              <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                          <div class="mail-contnet">
                                              <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                          <div class="mail-contnet">
                                              <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                      </a>
                                  </div>
                              </li>
                              <li>
                                  <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <!-- ============================================================== -->
                  <!-- End Comment -->
                  <!-- ============================================================== -->
                  <!-- ============================================================== -->
                  <!-- Messages -->
                  <!-- ============================================================== -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                          <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                      </a>
                      <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                          <ul>
                              <li>
                                  <div class="drop-title">You have 4 new messages</div>
                              </li>
                              <li>
                                  <div class="message-center">
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                          <div class="mail-contnet">
                                              <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                          <div class="mail-contnet">
                                              <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                          <div class="mail-contnet">
                                              <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                      </a>
                                      <!-- Message -->
                                      <a href="#">
                                          <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                          <div class="mail-contnet">
                                              <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                      </a>
                                  </div>
                              </li>
                              <li>
                                  <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <!-- ============================================================== -->
                  <!-- End Messages -->
                  <!-- ============================================================== -->
                  <!-- ============================================================== -->

                  <!-- ============================================================== -->
                  <!-- Profile -->
                  <!-- ============================================================== -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                      <div class="dropdown-menu dropdown-menu-right animated flipInY">
                          <ul class="dropdown-user">
                              <li>
                                  <div class="dw-user-box">
                                      <div class="u-img"><img src="../assets/images/users/1.jpg" alt="user"></div>
                                      <div class="u-text">
                                          <h4>Steave Jobs</h4>
                                          <p class="text-muted">varun@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                  </div>
                              </li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                              <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                              <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                          </ul>
                      </div>
                  </li>
              </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
