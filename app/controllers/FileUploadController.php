<?php

class FileUploadController extends BaseController
{	
	public function postFileUpload()
	{
		/*$v = new validators_fileUpload();
		$v->uploadFile();
		if(isset($result['success']))
		{
			
		}*/
		$s3 = AWS::get('s3');
		$return = array();
		foreach (Input::file("files") as $k => $file) {
			$name = Str::random(12).str_replace(" ", "_",$file->getClientOriginalName());
			$return[$k]["name"] = $name;
			$return[$k]["size"] = $file->getSize();
			try{
				$s3->putObject(array(
					'Bucket'     => 'img.vieassociative.fr',
					'Key'     	  => $name,
					'SourceFile' => $file->getRealPath(),
					'ACL'        => 'public-read',
				));
				$return[$k]["url"] = "http://img.vieassociative.fr/".$name;
				$return[$k]["thumbnailUrl"] = "http://img.vieassociative.fr/".$name;
				$return[$k]["deleteUrl"] = "http://img.vieassociative.fr/".$name;
				$return[$k]["type"] = "image/jpeg";
				$return[$k]["deleteType"] = "DELETE";
			} catch (S3Exception $e) {
				return Response::json('error', 400);
			}
		}
		return Response::json(array('files' => $return), 200);
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


