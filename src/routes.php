<?php

// Routes
//
/**
 * Dashboard
 */
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

	// Add route to args
	$args['route'] = $request->getAttribute('route')->getName();

	// Render index view
    return $this->view->render($response, 'dashboard/index.html', $args);
})->setName('dashboard');

/**
 * Upload form page
 */
$app->get('/image_upload', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/image_uplaod' route");

	// Add route to args
	$args['route'] = $request->getAttribute('route')->getName();

    // Render index view
    return $this->view->render($response, 'imagely/image_upload.html', $args);
})->setName('image_upload');

/**
 * Upload Files
 */
$app->post('/upload_image', 'Imagely\UploadController:upload')->setName('upload_image');

/**
 * Get images
 */
$app->get('/images', 'Imagely\UploadController:get')->setName('images');
