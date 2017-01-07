<?php

namespace Imagely;

use \Interop\Container\ContainerInterface as ContainerInterface;
use Imagely\ProductImage;
use Imagely\UploadHandler;

final class UploadController
{
    protected $ci;

    //Constructor
    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;

    }

    public function upload($request, $response, $args){
		$this->ci->get('logger')->info("Slim-Skeleton '/upload' route");
		$allPostPutVars = $request->getParsedBody();

        $options = array(
            'upload_dir' => 'files/',
            'upload_url' => 'files/',
			'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
            );
        $result = new UploadHandler($options);
		$imageName = $result->response['files'][0]->name;
		//Save image into database;
        $images = new ProductImage();
		$images->imageName = $imageName;
        $images->save();
	}


	/**
	 * Get images
	 */
	public function get($request, $response, $args){

		$this->ci->get('logger')->info("Slim-Skeleton '/get' route");

		$images = ProductImage::all();
		$args['images'] = $images;
		$args['route'] = $request->getAttribute('route')->getName();
    	return $this->ci->get('view')->render($response,'imagely/images.html', $args);
	}
}
