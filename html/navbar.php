<?php

session_start();
?>
   <nav class="navbar navbar-inverse my-navbar"  style="border-bottom: thin solid red; width:100%;  border-width:5px;">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <a class="navbar-brand" href="#/" style="font-size: 15px; font-weight: 900; ">HOME</a>
    <a class="navbar-brand" href="#/search" style="font-size: 15px; font-weight: 900; ">SEARCH DONORS</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  ng-controller="loginCtrl" >
      <ul class="nav navbar-nav" id="ul1">
        <li style="font-size: 15px; font-weight: 900; "><a href="#/bloodtips">BLOOD TIPS</a>
        </li>
        <li style="font-size: 15px; font-weight: 900; "><a href="#/aboutus">ABOUT US</a>
        </li>
     </ul>
      <ul class="nav navbar-nav navbar-right">
         
<!--      <li style="font-size: 15px; font-weight: 900; "><a href="#/login" ng-show="!isUserLoggedIn"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
      <li style="font-size: 15px; font-weight: 900; "><a href="#/login" ng-show="isUserLoggedIn"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>-->
      <?php	
      if(@$_SESSION['id']!="")
			{?>
			<div class="mainmenu pull-left">
				<ul class="nav navbar-nav collapse navbar-collapse">
					<li class="dropdown"><a href="#/dashboard"><?php echo @$_SESSION['id']; ?>
				<i class="fa fa-angle-down"></i></a>
			<ul role="menu" class="sub-menu">
			<li><a style="background: transparent" href="logout.php">Logout</a></li>
				</ul>
				</li> 
			</ul>
			</div>
								
		<?php	}
				else
				{	?>
	         <li style="font-size: 15px; font-weight: 900; " ><a href="#/register"  ><span class="glyphicon glyphicon-user"></span> REGISTER AS DONAR</a></li>			
          <li><a href="#/login"><i class="fa fa-lock"></i> Login</a></li>
				<?php	}	?>
    </ul>
    </div>
  </div>
 
</nav>