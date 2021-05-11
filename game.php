<?php
    // Created by Professor Wergeles for CS2830 at the University of Missouri
    // HTTPS redirect
//    if ($_SERVER['HTTPS'] !== 'on') {
//		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//		header("Location: $redirectURL");
//		exit;
//	}
    
	// Every time we want to access $_SESSION, we have to call session_start()
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if (!$loggedIn) {
		header("Location: login.php");
		exit;
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pong</title>
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="finalProject.css">
    <script src="jquery-3.2.1.min.js"></script>
    
   
    
    <style>
    
        body {
            background-color: darkgray;
        }
        
        #gameBoard {
            border: 2px solid white;
            background-color: black;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0px;
            padding-right: 0;
            padding-left: 0;
            display: block;
            width: 700px;
            height: 400px;
        }
        
        .score {
            font-family: Orbitron, arial;
            color: white;
            font-size: 30pt;
            text-align: center;
        }
        
        #playerOneScoreLabel {
            left: 30%;
            position: absolute;
        }
        
        #playerTwoScoreLabel {
            right: 30%;
            position: absolute;
        }
        
        #scoreBoard {
            border: 2px solid white;
            height: 180px;
            width: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 80px;
            padding-top: 60px;
        }
    
    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <!-- Brand -->
        <a class="navbar-brand" href="#"></a>

        <img src="images/pong.jpg" alt="swim" id="logo">
        <!-- Links -->
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
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
    <div class="score"id="scoreBoard">
        <div id="playerOneScoreLabel">Player1
            <div id="playerOneScore"></div>
        </div>
        <div id="playerTwoScoreLabel">Player2
            <div id="playerTwoScore"></div>
        </div>
    </div>
    <canvas id="gameBoard"></canvas> 
    
    
    
    <script>
        
        // Resource used to help guide me to build the pong game:
        // https://developer.mozilla.org/en-US/docs/Games/Tutorials/2D_Breakout_game_pure_JavaScript
        
        // Resource used to help with angle calculations during collisions:
        // https://impactjs.com/forums/help/deflection-angle-with-collision/page/1
        
        // game board
        var canvas = document.getElementById("gameBoard");
        var ctx = canvas.getContext("2d"); 
        
        var x = canvas.width/2;
        var y = canvas.height/2;
        console.log(canvas.height);
        console.log(canvas.width);
        
        var dx = 3.0; 
        var dy = 3.0;
        
        var ballRadius = 5;
        var paddleWidth = 5;
        var paddleHeight = 35;
        var paddleOneYPosition = canvas.height/2-paddleHeight;
        var paddleTwoYPosition = canvas.height/2;
        
        var upPressed = false;
        var downPressed = false;
        var wPressed = false;
        var sPressed = false;
        
        var playerOneLosses = 10;
        var playerTwoLosses = 10;
        
        var playerOneScore = 0;
        var playerTwoScore = 0;
        
        document.getElementById("playerOneScore").innerHTML = playerOneScore;
        document.getElementById("playerTwoScore").innerHTML = playerTwoScore;
        
        
        function drawPongBall() {
            ctx.beginPath();
            ctx.arc(x, y, ballRadius, 0, Math.PI*2);
            ctx.fillStyle = "white";
            ctx.fill();
            ctx.closePath();
        }
        
        function drawPlayerOnePaddle(){
            ctx.beginPath();
            ctx.rect(0, paddleOneYPosition, paddleWidth, paddleHeight);
            ctx.fillStyle = "white";
            ctx.fill();
            ctx.closePath();
        }
        
        function drawPlayerTwoPaddle(){
            ctx.beginPath();
            ctx.rect(295, paddleTwoYPosition, paddleWidth, paddleHeight);
            ctx.fillStyle = "white";
            ctx.fill();
            ctx.closePath();
        }        
        
        function draw() {
            // clear the canvas each frame
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawPongBall();
            drawPlayerOnePaddle();
            drawPlayerTwoPaddle();
            
            // change direction of ball when it hits a wall
            if(y + dy < ballRadius || y + dy > canvas.height-ballRadius){
                dy = -dy;
            }
            if(x + dx < ballRadius){
                if(y > paddleOneYPosition && y < paddleOneYPosition + paddleHeight){
                    dx = -dx;
                    var ballPosition = y - paddleOneYPosition;
                    var relativePosition = paddleHeight - ballPosition;
                    var angle = relativePosition*(Math.PI/paddleHeight);
                    dy = -Math.sin(angle)*dy+Math.random();
                }
                else {
                    playerTwoScore++;
                    playerOneLosses--;
                    document.getElementById("playerTwoScore").innerHTML = playerTwoScore;
                    if(playerOneLosses == 0){
                        alert("Player 2 Wins!");
                        document.location.reload();
                        clearInterval(interval);
                    }
                    else {
                        x = canvas.width/2;
                        y = canvas.height/2;
                        dx = 3.0;
                        dy = -3.0;
                        paddleOneYPosition = canvas.height/2-paddleHeight;
                    }
                }
            }
            if(x + dx > canvas.width-ballRadius){
                if(y > paddleTwoYPosition && y < paddleTwoYPosition + paddleHeight){
                    dx = -dx;
                    var ballPosition = y - paddleTwoYPosition;
                    var relativePosition = paddleHeight - ballPosition;
                    var angle = relativePosition*(Math.PI/paddleHeight);
                    dy = -Math.sin(angle)*dy+Math.random();
                }
                else {
                    playerOneScore++;
                    playerTwoLosses--;
                    document.getElementById("playerOneScore").innerHTML = playerOneScore;
                    if(playerTwoLosses == 0){
                        alert("Player 1 Wins!");
                        document.location.reload();
                        clearInterval(interval);
                    }
                    else {
                        x = canvas.width/2;
                        y = canvas.height/2;
                        dx = 3.0;
                        dy = -3.0;
                        paddleTwoYPosition = canvas.height/2;
                    }
                }
            }
            
            if(upPressed){
                paddleTwoYPosition -= 2;
                if(paddleTwoYPosition < 0){
                    paddleTwoYPosition = 0
                }
                paddleTwoYPosition + paddleHeight > canvas.height
            }
            else if(downPressed){
                paddleTwoYPosition += 2;
                if(paddleTwoYPosition + paddleHeight > canvas.height){
                    paddleTwoYPosition = canvas.height-paddleHeight;
                }
            }
            else if(wPressed){
                paddleOneYPosition -= 2;
                if(paddleOneYPosition < 0){
                    paddleOneYPosition = 0;
                }
                if(paddleOneYPosition + paddleHeight > canvas.height){
                    paddleOneYPosition = canvas.height-paddleHeight;
                }
                
            }
            else if(sPressed){
                paddleOneYPosition += 2;
                if(paddleOneYPosition + paddleHeight > canvas.height){
                    paddleOneYPosition = canvas.height-paddleHeight;
                }
            }
            
            
            
            x += dx;
            y += dy;
            
        }
        
        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
        
        function keyDownHandler(e){
            if(e.keyCode == 38){
                upPressed = true;
            }
            if(e.keyCode == 87){
                wPressed = true;
            }
            if(e.keyCode == 40){
                downPressed = true;
            }
            if(e.keyCode == 83){
                sPressed = true;
            }
        }
        
        function keyUpHandler(e){
            if(e.keyCode == 38){
                upPressed = false;
            }
            if(e.keyCode == 87){
                wPressed = false;
            }
            if(e.keyCode == 40){
                downPressed = false;
            }
            if(e.keyCode == 83){
                sPressed = false;
            }
        }
        
        var interval = setInterval(draw, 10);
        
           
        // https://stackoverflow.com/questions/8916620/disable-arrow-key-scrolling-in-users-browser
        var up_and_down_keys_handler = function(e){
            switch(e.keyCode){
                case 38: case 40: e.preventDefault();
                default: break;
            }
        };
        window.addEventListener("keydown", up_and_down_keys_handler, false);

    </script>
    
    
</body>    
</html>