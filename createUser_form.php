<!-- Code used from lecture resources, created by Professor Wergeles at the University of Missouri -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create User Account</title>
	<link href="app.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="finalProject.css" rel="stylesheet" type="text/css">
    <link href="jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <style>
        h1 {
            font-size: 35pt;
        }
        
    
    
        body {
            background-color: darkgray;
        }
        
        #loginWidget {
            margin-top: 100px;
        }
        
        
        
    </style>
    <script>
        $(function(){
            $("input[type=submit]").button();
            
            $("#password, #confirmPass").keyup(function(){
                var password = $("#password").val();
                var confirmPassword = $("#confirmPass").val();
                
                if(password.localeCompare(confirmPassword) != 0){
//                    $("#outputDiv").html("Passwords don't match!");
                    document.getElementById("confirmPass").setCustomValidity("Passwords don't match!");
                }
                else {
//                    $("#outputDiv").html("Passwords match!");
                    document.getElementById("confirmPass").setCustomValidity("");
                }
            });
        
        });
    </script>
</head>
<body>
    <div id="loginWidget" class="ui-widget">
        <h1 class="ui-widget-header">Create your Account</h1>
        
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
        
        <form name="mattsForm" action="createUser.php" method="POST" >
            
            <input type="hidden" name="action" value="do_create">
            
            <div class="stack">
                <label for="firstName">First name:</label>
                <input type="text" id="firstName" name="firstName" class="ui-widget-content ui-corner-all" required>
            </div>
            
            <div class="stack">
                <label for="lastName">Last name:</label>
                <input type="text" id="lastName" name="lastName" class="ui-widget-content ui-corner-all" required>
            </div>
            
            <div class="stack">
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" required>
            </div>
            
            <div class="stack">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all" required>
            </div>
            
            <div class="stack">
                <label for="confirmPass">Confirm Password:</label>
                <input type="password" id="confirmPass" name="confirmPass" class="ui-widget-content ui-corner-all" required>
            </div>
            
             <div class="stack">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" class="ui-widget-content ui-corner-all" required>
            </div>
            
            <div class="stack">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="ui-widget-content ui-corner-all" required>
            </div>
            
            
            <div class="stack">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>