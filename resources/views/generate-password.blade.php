<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Generate Password</title>
</head>
<body>
	<h1 style="font-size: 70px">{{ $password }}</h1><br />
	<button style="font-size: 70px" onclick="copy('{{ $password }}')">Copy</button>
	<script>
		function copy(text) {
			var input = document.createElement('input');
			input.value = text;

			document.body.appendChild(input);
			/* Select the text field */
			input.select();
			input.setSelectionRange(0, 99999); /*For mobile devices*/

			document.execCommand("copy");
			document.body.removeChild(input);
			
			alert('Text Copied');
		}
	</script>
</body>
</html>