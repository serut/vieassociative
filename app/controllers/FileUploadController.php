<?php

use Aws\Common\Aws;
use Aws\S3\S3Client;
		
class FileUploadController extends BaseController
{	
	public function postFileUpload()
	{
		/*
		$v = new validators_fileUpload();
		$v->uploadFile();
		if(isset($result['success']))
		{
			
		}
		*/

		$client = S3Client::factory(array(
		    'key'    => get_env("KEY_S3"),
		    'secret' => get_env("SECRET_S3")
		));	

		var_dump($client);
		// Get the client from the builder by namespace
		$client = $aws->get('S3');


	}
}


