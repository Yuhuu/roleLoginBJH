<html lang="en-US" ng-app="atTheStudents">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="Yy52X2JRN3UFG0c.ATMORQdIF2ZbNA4WAEtCZwYyVEBUHBQ8VTIBQwVMTj0EMgQUAhdGagZhVhNWFhBoU2MEEFQbQG0DZAFGAhREZRk4DUVYXUxqWHNoFhBcEH1ZOA1EWF1MbFBrFR1OfDk2WxhTFFZoF3JRGEETVnEcCC8yTiQzRC8MGGBcV1hT">
    <title>...</title>
    <link href="/roleLogin/frontend/web/assets/f77e5eda/css/bootstrap.css" rel="stylesheet">
<link href="/roleLogin/frontend/web/css/site.css" rel="stylesheet">
<link href="/roleLogin/frontend/web/assets/769923d/toolbar.css" rel="stylesheet"></head>
<body>

<div class="wrap"><nav class="navbar-inverse navbar-fixed-top navbar" role="navigation"  bs-navbar>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                    <span class="sr-only">Toggle navigation
                    </span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span></button>
                <a class="navbar-brand" href="/roleLogin/frontend/web/">BJH</a></div><div id="w0-collapse" class="collapse navbar-collapse">
                 <ul class="navbar-nav navbar-right nav">
    <li data-match-route="/$">
        <a href="#/">Home</a>
    </li>
    <li data-match-route="/$">
        <a href="#/Norwegian">Norsk</a>
    </li>
    <li data-match-route="/$">
        <a href="#/">English</a>
    </li>
    <li data-match-route="/dashboard" ng-show="loggedIn()" class="ng-hide">
        <a href="#/dashboard">Dashboard</a>
    </li>
    <li ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" ng-click="logout()"  class="ng-hide">
        <a href="">Logout</a>
    </li>
    <li data-match-route="/login" ng-hide="loggedIn()">
        <a href="#/login">Login</a>
    </li>
</ul>
</div></div></nav>        
    
<div ng-view></div>
</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company 2016</p>

        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>
    </div>
</footer>
    
<script src="/roleLogin/frontend/web/assets/d06234b8/yii.js"></script>
<script src="/roleLogin/frontend/web/css/site.js"></script>
<script src="/roleLogin/frontend/web/assets/f77e5eda/js/bootstrap.js"></script>
<script src="/roleLogin/frontend/web/assets/769923d/toolbar.js"></script></body>
</html>