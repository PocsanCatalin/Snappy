<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response; 
use \Slim\Http\Stream;
use \Symfony\Component\Process\Process;

$app->get('/', function (Request $request, Response $response) {
	return $this->view->render($response, 'home.php');
})->setName('home');

$app->post('/', function (Request $request, Response $response) {
	// the URL from where to capture the image
	$url = $request->getParam('url');

	// TODO: validation ( this is just something basic )
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
		return $response->withRedirect('/');
	}

	// the path where we store the captured images
	$storePath = 'images/';

	// filename
	$filename = $storePath . md5(uniqid()) . '.png';

	// prepare a process
	$process = new Process("../bin/phantomjs ../screenshot.js {$url} {$filename}");

	// run the process
	$process->mustRun();

	// read as a stream the content fo the created image
	$stream = new Stream(fopen($filename, 'r'));

	// prepare the response to automatically download the file
	$response = $response->withHeader('Content-Description', 'File Transfer')
	                ->withHeader('Content-Disposition', 'attachment; filename="'. basename($filename) .'"')
	                ->withHeader('Content-Transfer-Encoding', 'binary')
	                ->withHeader('Content-Type', 'image/png')
	                ->withBody($stream);

	// delete the image
	unlink($filename);

	// return the response
	return $response;
});