# Slim Framework 3 - Implementation of blueimp/jQuery-File-Upload


This is a simple upload controller for use with BlueImp/JQuery-File-Upload. This repo contains multiple file uplaod example.

Project also has a model to save images and their names into database with the Eloquent ORM.

## Installation


Clone project to your folder. 

Run this command to install dependencies
    
    php composer.phar install
   
src/dependencies.php

    // Import your controller
    $container['Imagely\UploadController'] = function ($c) {
      return new Imagely\UploadController($c);
    };


if you set up a database you will also get a listing page at /images route
