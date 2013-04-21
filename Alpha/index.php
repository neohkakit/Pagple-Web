<?php
header("HTTP/1.1 503 Service Temporarily Unavailable");
header("Status: 503 Service Temporarily Unavailable");
header("Retry-After: Sun, 21 Apr 2013 23:59:59 GMT+8");
?>

<!doctype html>
<html><head>
	<title> We are performing an upgrade</title>
	<style type="text/css">
	ul,
ol,
li,
h1,
h2,
h3,
h4,
h5,
h6,
pre,
form,
body,
html,
p,
blockquote,
fieldset,
input {
  margin: 0;
  padding: 0;
}
	
	div#bg{
  position: relative;
  width: 100%;
  height: 1000px;
  background: url('img/bg-old.jpg') no-repeat center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
  div#text{

  	  padding-left: 281px;
  margin: 0 auto;
  width: 100%;
  height: 44px;
  text-align: left;
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
   font-weight: 700;
   color:white;
   padding-top:200px;
  }
	
	</style>
</head>
<body>
	<div id="bg">
		<div id="text">
	<h1>Site is temporarily unavailable due to scheduled update</h1>
	<p>We will return to you soon.</p></div>
</div>
	</body>
</html>