<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>
       @yield('title', 'SSMS - EPR')
    </title>

    <!-- Bootstrap core CSS -->
    {{ HTML::Style("assets/css/bootstrap.css"); }}
    <!--external css-->
    {{ HTML::Style("assets/font-awesome/css/font-awesome.css"  ); }}
    {{ HTML::Style("assets/css/zabuto_calendar.css"); }}
    {{ HTML::Style("assets/js/gritter/css/jquery.gritter.css" ); }}
    {{ HTML::Style("assets/lineicons/style.css"); }}  
    
    <!-- Custom styles for this template -->
    {{ HTML::Style("assets/css/style.css" ); }}
    {{ HTML::Style("assets/css/style-responsive.css" ); }}
    {{ HTML::Script("assets/js/JQuery v1.11.0.js"); }}
    {{ HTML::Script("assets/js/chart-master/Chart.js"); }}
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      <link rel="shortcut icon" href="{{ URL::to('/').'/assets/img/custom/'.$logo }}">
    </style>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>{{ $org_name }}  ERP PORTAL</b></a>
            <!--logo end-->
        
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li>{{ HTML::link('/logout','Logout',array('class'=>'logout'))}}</li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered">
              	  	<img src={{ asset("assets/img/custom/".$logo); }} class="img-circle" width="60">
              	  </p>
              	  <h5 class="centered">ADMIN</h5>
              	  	
                  <!-- <li class="mt">
                      <a class="active" href="index.html">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li> -->

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-user"></i>
                          <span>Faculty</span>
                      </a>
                      <ul class="sub">
                            <li>{{ HTML::link('/addfaculty','Add Faculty') }}</li>
                          <li>{{ HTML::link('/faculty','View Faculty') }}</li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-lightbulb-o"></i>
                          <span>Student</span>
                      </a>
                      <ul class="sub">
                          <li>{{ HTML::link('/addstudent','Add Student') }}</li>
                          <li>{{ HTML::link('/viewstudent','View Student') }}</li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="{{URL::to('/')}}/collect" >
                          <i class="fa fa-pencil"></i>
                          <span>Fees Collection</span>
                      </a>
                  </li>
                    <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li>{{ HTML::link('/collection','Collection Statement')}}</li>
                          <li>{{ HTML::link('/dailycollection','Daily Collection Statement')}}</li>
                          <li>{{ HTML::link('/monthlycollection','Monthly Collection Statement')}}</li>
                          <li><a  href="login.html">Defaulter List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="{{URL::to('/')}}/settings" >
                          <i class="fa fa-cogs"></i>
                          <span>Settings</span>
                      </a>
                  </li>
                 
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
       <section id="main-content">
          <section class="wrapper">
      		@yield('content')
      	  </section>	
      	</section>
          @yield('print')
      <!--main content end-->
      <!--footer start-->
      <footer id="footer" class="site-footer">
          <div class="text-center">
              &copy{{ date('Y'); }} -SSMS
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::Script("assets/js/jquery.js"); }}
    {{ HTML::Script("assets/js/jquery-1.8.3.min.js"); }}
    {{ HTML::Script("assets/js/bootstrap.min.js"); }}
    {{ HTML::Script("assets/js/jquery.dcjqaccordion.2.7.js"); }}
    {{ HTML::Script("assets/js/jquery.scrollTo.min.js"); }}
    {{ HTML::Script("assets/js/jquery.nicescroll.js"); }}
    {{ HTML::Script("assets/js/jquery.sparkline.js"); }}


    <!--common script for all pages-->
    {{ HTML::Script("assets/js/common-scripts.js"); }}
    
    {{ HTML::Script("assets/js/gritter/js/jquery.gritter.js"); }}
    {{ HTML::Script("assets/js/gritter-conf.js"); }}

    <!--script for this page-->
    {{ HTML::Script("assets/js/sparkline-chart.js"); }}    
	{{ HTML::Script("assets/js/zabuto_calendar.js"); }}	

	<script type="text/javascript">
       /* $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashgum!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
            // (string | optional) the image to display on the left
            image: 'assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });*/
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>