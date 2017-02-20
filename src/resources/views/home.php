<!DOCTYPE html>
<html>
<head>
	<title>Snappy | Take website screenshots for free</title>
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ path_for('home') }}css/app.css">
</head>
<body>
    <div class="container">
    	<header class="page-header">
    		<h1 class="brand"><a href="{{ path_for('home') }}">Snappy</a></h1>
    	    <p>Take website screenshots for free</p>
    	    <form action="{{ path_for('home') }}" method="POST">
    	    	<div class="form-group">
    	    		<input type="url" name="url" placeholder="Enter a valid URL">
    	    		<button type="submit">Capture</button>
    	    	</div>
    	    </form>
    	</header>
    </div>
</body>
</html>