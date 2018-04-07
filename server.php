<?php 
	$url1=$_SERVER['REQUEST_URI'];
    	header("Refresh: 5; URL=$url1");
	// set some variables
	 $host = "127.0.0.1";
	 $port = 25003;

	 // don't timeout!
	 set_time_limit(0);
?>

<html>
	<head>
		<title>Server</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link rel="stylesheet" href="Style/style.css">
		<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
	</head>
	<body>
		<div class="container">
			<div class="infobar">
				<h1 class="animated fadeInDown" >Welcome server</h1>
			</div>
			<?php 
				// create socket
				$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

				// bind socket to port
				$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

				// start listening for connections
				$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");
				// accept incoming connections
			 	// spawn another socket to handle communication
			 	$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
			?>
			<div class="chat">
				<div class="scm">
					<?php
						// read client input
						$input = socket_read($spawn, 1024) or die("Could not read input\n");
						
						// clean up input string
						$input = trim($input);	
					?>
					<div class="message1" ><h4>Client: </h4><p><?php echo $input; ?></p></div>
				</div>
				<div class="ssr">
					<?php
						// reverse client input and send back
						$output = strrev($input) . "\n";
						socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
					?>
					<div class="message2" ><h4>You : </h4><p><?php echo $output; ?></p></div>
				</div>
			</div>
			<footer class="copy">
					&copy; Destro014 <?php echo date("Y"); ?>
					
			</footer>
		</div>
	</body>
</html>



<?php 
			
			 
			

			
			// // close sockets
			// socket_close($spawn);
			// socket_close($socket);
		?>
