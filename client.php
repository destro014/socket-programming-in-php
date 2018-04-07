	<html>
	<head>
		<title>Client</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link rel="stylesheet" href="Style/style.css">
		<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
	</head>
	<body>
		<?php  
			$host    = "127.0.0.1";
			$port    = 25003;
			?>
		<div class="container">
			<div class="infobar">
				<h1 class="animated fadeInDown">Welcome client</h1>
			</div>
			
			<div class="chat">
				<div class="scm">
					<?php  
						if(isset($_POST['send'])){
							$message= $_REQUEST['message'];					
							$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
							do{
								$con=socket_connect($sock,$host,$port);
							}while(!$con);
							socket_write($sock, $message, strlen($message));?>
							<div class="message1" ><h4>You: </h4><p><?php echo $message; ?></p></div>
					<?php  
						$result = socket_read ($sock, 1024) or die("Could not read server response\n");
					?>
					<div class="message2" ><h4>Server : </h4><p><?php echo $result; ?></p></div>	
					<?php 
						}
					?>
				</div>
			</div>
			<div class="message">
				<form action="client.php" method="post" class="send-form">
					<li>
					<input type="text" name="message" required  autocomplete="off" placeholder="Type your message here">
					<button class="send-button btnone" type="submit" value="submit" name="send">Send</button>
					</li>
		        </form>
			</div>
			<footer class="copy">
				&copy; Destro014 <?php echo date("Y"); ?>		
			</footer>
		</div>
	</body>
</html>
