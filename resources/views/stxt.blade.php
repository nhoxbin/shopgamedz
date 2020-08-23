<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cutting Text</title>
</head>
<body>
	<input id="txt" style="font-size: 70px"></input><br />
	<button style="font-size: 70px" onclick="copy(document.getElementById('txt').value.slice(0, 6))">Copy</button>
</body>

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
</html>