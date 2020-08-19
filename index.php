<?php

// Require everything we'll need
require_once('Feed/Feed.php');
require_once('Handlers/RequestHandler.php');
require_once('Request.php');
require_once('Feed/FeedRenderer.php');

// Create a new RequestHandler and Request object
$handler = new RequestHandler(new Request());

// Get feed data
$handler->getFeedData();

// Render result
$handler->handleRequest();

// In case something goes wrong, show 404 page
function renderError() {
    include('Src/views/404.php');
}