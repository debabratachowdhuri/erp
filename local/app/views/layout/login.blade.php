<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="SSMS, SSMS KGP">
 
    <title>SSMS::Admin Panel</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::Style("assets/css/bootstrap.css"); }}
    <!--external css-->
    {{ HTML::Style("assets/font-awesome/css/font-awesome.css"); }}
        
    <!-- Custom styles for this template -->
    {{ HTML::Style("assets/css/style.css"); }}
    {{ HTML::Style("assets/css/style-responsive.css"); }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<style> 
@font-face {
    font-family: myFirstFont;
    src: url({{ URL::to('/')."/assets/fonts/Old_Bookshop_HK.ttf";}});
}

#ssms {
    font-size:500%;
    color: #FFFFFF;
    text-align: center;;
    font-family: myFirstFont;
}
</style>
  <body>

<div id="ssms">
     {{ $org_name }}
</div>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      @yield('content');
   
    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::Script("assets/js/jquery.js"); }}
    {{ HTML::Script("assets/js/bootstrap.min.js"); }}
    {{ HTML::Script("assets/js/jquery.backstretch.min.js"); }}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->

    <script>
        $.backstretch("assets/img/custom/back-to-school.jpg", {speed: 500});
    </script>
    </body>
</html>