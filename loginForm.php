<!DOCTYPE html>
<!-- Code used from User Authentication Lecture, created by Professor Wergeles for CS2830 at the University of Missouri -->
<html lang="en">
<head>
	<title>Login</title>
	<link href="finalProject.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
    
    <style>
    
        body {
            background-color: darkgray;
        }
        
        #loginWidget {
            margin-top: 100px;
        }
        
    
    </style>
    
    
</head>
<body>
    <div id="loginWidget" class="ui-widget">
        <h1 class="ui-widget-header">Login</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <!-- Brand -->
            <a class="navbar-brand" href="#"></a>

            <img src="images/pong.jpg" alt="swim" id="logo">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="loginForm.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.html">
                    Home
                  </a>
                </li>
            </ul>
        </nav>
        
        <form action="login.php" method="POST">
            
            <input type="hidden" name="action" value="do_login">
            
            <div class="stack">
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" autofocus value="<?php print $username; ?>">
            </div>
            
            <div class="stack">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all">
            </div>
            
            <div class="stack">
                <input type="submit" value="Submit">
            </div>
        </form>
        <br>
        <a href="createUser_form.php">Not a user?</a>
    </div>
</body>
</html>