<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page for testing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<label for="start">Start date:</label>

<form method="post" action="{{ route('testC') }}">
    @csrf
    <input type="date" id="start" name="trip-start"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31" onclick="myFunction()">
    <input type="submit" value="Send">
</form>

</body>

<script>
function myFunction() {
    console.log(document.getElementById("start").value);
}
</script>

</html>