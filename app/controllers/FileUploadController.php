<?php

use Aws\Common\Aws;
use Aws\S3\S3Client;
		
class FileUploadController extends BaseController
{	
	public function postFileUpload()
	{
		$http_origin = $_SERVER['HTTP_ORIGIN'];
		if ($http_origin == "http://www.vieassoc.lo" || $http_origin == "http://www.vieassociative.fr" || $http_origin == "http://association.vieassoc.lo" )
		{  
			/*$v = new validators_fileUpload();
			$v->uploadFile();
			if(isset($result['success']))
			{
				
			}*/
			$client = S3Client::factory(array(
			    'key'    => get_env("KEY_S3"),
			    'secret' => get_env("SECRET_S3")
			));	
			$fileTempName = $upload['tmp_name'];
            $fileName = (isset($_SERVER['HTTP_X_FILE_NAME']) ? $_SERVER['HTTP_X_FILE_NAME'] : $upload['name']);
            $fileName =  $prefix.str_replace(" ", "_", $fileName);
			$response = $s3->create_object($bucket, $fileName, array('fileUpload' => $fileTempName,
																	'acl' => AmazonS3::ACL_PUBLIC,
																	'meta' => array('keywords' => 'example, test'),
																	));
	        if ($response->isOK()) {
	            $info[] = getFileInfo($bucket, $fileName);
	        } else {
	            //     echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
	            
	        }
			var_dump($client);
			// Get the client from the builder by namespace
			$client = $aws->get('S3');
	        return Response::make('',200,array('Access-Control-Allow-Origin' => $http_origin,
	        			'Access-Control-Allow-Methods'=>'POST, GET, OPTIONS',
	        			'Access-Control-Max-Age'=>'1000',
	        			'Access-Control-Allow-Headers'=>'Content-Type, Content-Range, Content-Disposition, Content-Description'));
		}
	}
	public function fileUpload(){
		$http_origin = $_SERVER['HTTP_ORIGIN'];
		if ($http_origin == "http://www.vieassoc.lo" || $http_origin == "http://www.vieassociative.fr" || $http_origin == "http://association.vieassoc.lo" )
		{  
	        return Response::make('',200,array('Access-Control-Allow-Origin' => $http_origin,
	        			'Access-Control-Allow-Methods'=>'POST, GET, OPTIONS',
	        			'Access-Control-Max-Age'=>'1000',
	        			'Access-Control-Allow-Headers'=>'Content-Type, Content-Range, Content-Disposition, Content-Description'));
		}
	    return;
	}
}


