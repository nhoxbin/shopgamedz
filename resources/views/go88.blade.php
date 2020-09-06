<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Go88</title>

	<link rel="stylesheet" href="{{ asset('libs/baokim/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		.input_mess{
			 width:410px; 
			 margin-left:auto; 
			 margin-right:auto;
		}
        #input{
			border-radius: 15px; 
			border:1px solid #ccc;
			margin-top:10px; padding:5px; 
			width:100%;  
		}
        #status { 
			width:88px; 
			display:block; 
			float:left; 
			margin-top:15px; 
		}
        #content {
			width:410px;
			padding:5px; 
			overflow-x: hidden; 
			overflow-y: scroll;
			border:1px solid #cc8e73;
			height: 240px; 
			border-radius: 5px;
		}
		#content::-webkit-scrollbar-track {
			box-shadow: inset 0 0 5px grey; 
			border-radius: 10px;
		}
		#content::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			background-color: #3c4d7c;
		}
		#content::-webkit-scrollbar-thumb:hover {
			width: 10px;
			background: blue;
		}
		#content::-webkit-scrollbar-thumb {
			background-color: #777;
			border-radius: 10px;
		}
		#content::-webkit-scrollbar {
			width: 6px;
			background-color: #98798798798213874;
			
		} 
		.form-analytic input{
			margin-bottom: 5px;
		}
		.message { margin: 3px; }
		.dtable{ overflow-y: auto; height: 240px; }
		.dtable, thead th { position: sticky; top: 0; }
		.dtable, th{background: #fff;}
		.alert{
			z-index: 999;
			float: right;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
			border-bottom-left-radius: 10px;
			border: 1px solid #F0D900;
		}
		.form1{
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
			border-bottom-left-radius: 10px;
			border: 1px solid #04c;
		}
		.form{
			background:white;
		}
		.table, td {
		   text-align: center;   
		}
		.footer {
			/*position: absolute;*/
			bottom: 0;
			width: 100%;
			height: 60px;
			line-height: 60px;
			background-color: #101010;
			margin-top: 20px;
		}
		html{
			font-size: 14;
		}
		body{
			background-color: #444;
		}
		.games {
			background:#000000;
			color:#08c;
			height:40px;
			margin-bottom:15px;
			cursor: pointer;
			height:40px;
		}
		.active{
			color:#fff;
			background-color: #444;
		}
		.form-bet .form-control{
			margin-bottom: 10px;
		}
		.form-bet{
			background-color: white;
			position: relative;
		}
		.form-login{
			background-color: white;
			width: 350px;
			height: 210px;
			position: relative;
		}
		.info-game{
			right: 0;
			position: absolute;
		}
		.form-login-games{
			margin-left: 15px;
			width: 300px;
			position: absolute;
		}
		.form-login-games.span{
			margin-bottom: 15px;
		}
		.grid-result {
			display: flex;
			flex-wrap: wrap;
			flex-flow: row-reverse wrap
		}
		.grid-result .cell {
			border: 0.2px dotted #c3b5ac24;
			background-color: #170f00;
			display: block;
			width: 30px;
			min-height: 30px;
			text-align: center;
			margin-bottom: 3px;
		}
		.cell{
			border: 1px dotted  #c3b5ac24;
			background-color: #170f00;
			width: 30px;
			min-height: 30px;
			text-align: center;
			display: inline-grid;
		}
		.xiu{
			border: 1.2px solid   #564403;
			background: #fdf5e8;
			
			color: #2c2c2c;
			cursor: pointer;
			border-radius: 80%;
			margin: auto;
			width: 28px;
			height: 26px;
			font-size:16;
			font-weight:bold;
		}
		.tai{
			border: 1.2px solid   #675c20;
			background:  #131110;
			color: #e0b604;
			cursor: pointer;
			border-radius: 80%;
			margin: auto;
			width: 28px;
			height: 26px;
			font-size:16;
			font-weight:bold;
		}
		.calculate{
			color: white;
		}
		.navbar{
			margin-bottom:0
		}
		/* Needed for hiding crollbars when pushing */
			.table_sqk th, td {
				border: 1px solid black;
				text-align: center; 
				vertical-align: middle;
			}
			.tdxx{
				width: 30px;
				height: 30px;
				font-size: 17;
				background-color: #d6dce4;
				color: #b7b5b7;
			}
			.tdmid{
				background-color: #fff;
			}
			.tk_show{
				height: 20px;
				width: 20px;
				margin: auto;
				background-color: green;
				border-radius: 50%;
				color: white;
			}
	</style>
	<style type="text/css">
		.col-centered{
		    float: none;
		    margin: 20px auto;
		}
	</style>

	{{-- notice troll --}}
	<style>
		/* The snackbar - position it at the bottom and in the middle of the screen */
		#snackbar {
		  visibility: hidden; /* Hidden by default. Visible on click */
		  min-width: 250px; /* Set a default minimum width */
		  margin-left: -125px; /* Divide value of min-width by 2 */
		  background-color: #333; /* Black background color */
		  color: #fff; /* White text color */
		  text-align: center; /* Centered text */
		  border-radius: 2px; /* Rounded borders */
		  padding: 16px; /* Padding */
		  position: fixed; /* Sit on top of the screen */
		  z-index: 1; /* Add a z-index if needed */
		  left: 50%; /* Center the snackbar */
		  bottom: 30px; /* 30px from the bottom */
		}

		/* Show the snackbar when clicking on a button (class added with JavaScript) */
		#snackbar.show {
		  visibility: visible; /* Show the snackbar */
		  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
		  However, delay the fade out process for 2.5 seconds */
		  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		  animation: fadein 0.5s, fadeout 0.5s 2.5s;
		}

		/* Animations to fade the snackbar in and out */
		@-webkit-keyframes fadein {
		  from {bottom: 0; opacity: 0;}
		  to {bottom: 30px; opacity: 1;}
		}

		@keyframes fadein {
		  from {bottom: 0; opacity: 0;}
		  to {bottom: 30px; opacity: 1;}
		}

		@-webkit-keyframes fadeout {
		  from {bottom: 30px; opacity: 1;}
		  to {bottom: 0; opacity: 0;}
		}

		@keyframes fadeout {
		  from {bottom: 30px; opacity: 1;}
		  to {bottom: 0; opacity: 0;}
		}
	</style>
</head>
<body>
	<div id="snackbar">Có clz, tin người vcl =))</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-centered">
				<div class="input-group">
					<input id="md5" type="text" class="form-control" placeholder="MD5">
					<div class="input-group-btn">
						<button id="solve" class="btn btn-success" onclick="troll()">
							Giải
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-5 col-centered">
				<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/m__43MNyz5Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-centered">
				<div class="calculate">
					<span>Tống số:</span> <span id="total" style=" color: #7e92ff;">{{ $data['d'] }}</span>
					<span>Tài:</span> <span id="totalT" style=" color: #7e92ff;">{{ $data['t'] }}</span>
					<span>Xỉu:</span> <span id="totalX" style=" color: #7e92ff;">{{ $data['x'] }}</span>
				</div>
			</div>
		</div>
	</div>

	<div id="result" class="grid-result">
		{!! $data['data'] !!}
	</div>

	<script>
		async function troll() {
			if (!document.getElementById('md5').value) {
				alert('Vui lòng nhập mã MD5')
				return;
			}
			document.getElementById('solve').setAttribute('disabled', 'disabled');
			document.getElementById('solve').innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
			// Get the snackbar DIV
			var x = document.getElementById("snackbar");

			await setTimeout(async function() {
				// Add the "show" class to DIV
				x.className = "show";

				// After 3 seconds, remove the show class from DIV
				await setTimeout(function() {
					x.className = x.className.replace("show", "");
					document.getElementById('solve').removeAttribute('disabled');
					document.getElementById('solve').innerText = 'Giải';
				}, 3e3);
			}, 10e3);
		}
	</script>
</body>
</html>