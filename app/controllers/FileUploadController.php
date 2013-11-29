<?php

class FileUploadController extends BaseController
{	
	public function postFileUpload(){
		/*$v = new validators_fileUpload();
		$v->uploadFile();
		if(isset($result['success']))
		{
			
		}*/
		$return = array();
		$file = Input::file('filedata');
		if($file){
			$name = $this->generateName($file->getClientOriginalName());
			$return["status"] = 200;
			$return["files"] = array($name);

			$this->sendObjectFile($name,$file->getRealPath());
			File::addFile($name, $extension);

			/*$if(){
				//create a thumb
				$this->sendFile($name,$file->getRealPath());
			}*/
		}else{
			if(Request::header('X-Requested-With') == "XMLHttpRequest"){
				if($infoSizeFile = $this->getInformationOfChuckedFile()){
					Session::push('chucked_file', file_get_contents('php://input'));
					if(($infoSizeFile[2]+1) == $infoSizeFile[3]){
						//We have all parts of this file
						$name = $this->generateName($this->getFileName());
						$this->sendObjectString($name,implode('',Session::get('chucked_file')));
						Session::forget('chucked_file');
						$return["status"] = 200;
						$return["files"] = array($name);
						File::addFile($name, $extension);
					}
				}
			}
		}
		return Response::json($return);
	}
    public function getInformationOfChuckedFile() {
    	$val = Request::header('Content-Range');
             //Exemple : bytes 2097152-3795036/3795037
        $pattern  = '/bytes ([0-9]+)-([0-9]+)\/([0-9]+)/s';
        if(preg_match($pattern, $val,$elements))
        	return $elements;
        return false;
    }
    public function getFileName(){
    	$val = Request::header('Content-Disposition');
             //Exemple : attachment; filename=cobravrai.png
        $name = explode('=', $val);
        return $name[1];
    }
	public function isImg($extension){
		$imgExtension = array('png','jpg');
		return in_array($extension, $imgExtension);
	}
	public function generateName ($str){
		return Str::random(12).str_replace(" ", "_",$str);
	}
	public function sendObjectFile($name,$pathSrc){
			try{
				$s3 = AWS::get('s3');
				$s3->putObject(array(
					'Bucket'     => 'img.vieassociative.fr',
					'Key'     	  => $name,
					'SourceFile' => $pathSrc,
					'ACL'        => 'public-read',
				));
			} catch (S3Exception $e) {
				var_dump($e);
				return Response::json('error', 400);
			}
	}
	public function sendObjectString($name,$src){
			try{
				$s3 = AWS::get('s3');
				$s3->putObject(array(
					'Bucket'     => 'img.vieassociative.fr',
					'Key'     	  => $name,
					'Body' 		=> $src,
					'ACL'        => 'public-read',
				));
			} catch (S3Exception $e) {
				var_dump($e);
				return Response::json('error', 400);
			}
	}
	public function fileUpload(){
		$http_origin = $_SERVER['HTTP_ORIGIN'];
		if ($http_origin == "http://www.vieassoc.lo" || $http_origin == "http://www.vieassociative.fr" || $http_origin == "http://association.vieassoc.lo" )
		{  
	        return Response::make('',200,array('Access-Control-Allow-Origin' => $http_origin,
	        			'Access-Control-Allow-Methods'=>'POST, GET, OPTIONS',
	        			'Access-Control-Allow-Credentials'=>'true',
	        			'Access-Control-Allow-Headers'=>'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type'));
		}
	    return;
	}
	private function creerImageDimensionnee($tmpLocation,$file_ext, $imageX, $imageY) {
        // A partir du nom du fichier, recupere le nom et l'extension
        $file = $this->getFileName($fileOri);
        $file_ext = $file[1];
        $file_name = $file[0];
        $qualite = 100; // Qualite de l'image
        $color = "ffffff"; // Couleur de fond

        $imageProvenance = $this->url .DIRECTORY_SEPARATOR. "original" .DIRECTORY_SEPARATOR. $fileOri;

        $imageXAfter = 0; // Dimension de la future image
        $imageYAfter = 0;
        $imageXAfterPoint = 0; // decalage de l'ancienne image dans la nouvelle image
        $imageYAfterPoint = 0;

        //Calcul de la dimension de l'image rÃ©sultante
        $size = getimagesize($imageProvenance);
        if ($size[0] >= $imageX AND $size[1] >= $imageY) {
            if (($size[0] / $imageX) > ($size[1] / $imageY)) {
                $imageXAfter = $imageX;
                $imageYAfter = floor(($size[1] * $imageX) / $size[0]);
                $imageXAfterPoint = 0;
                $imageYAfterPoint = ($imageY / 2) - ($imageYAfter / 2);
            } else {
                $imageXAfter = floor(($size[0] * $imageY) / $size[1]);
                $imageYAfter = $imageY;
                $imageXAfterPoint = ($imageX / 2) - ($imageXAfter / 2);
                $imageYAfterPoint = 0;
            }
        } else {
            $imageXAfter = $size[0];
            $imageYAfter = $size[1];
            $imageXAfterPoint = ($imageX / 2) - ($imageXAfter / 2);
            $imageYAfterPoint = ($imageY / 2) - ($imageYAfter / 2);
        }
        
        // Bonne création d'image
        if ($file_ext == 'jpg' OR $file_ext == 'jpeg') {
            $image_new = imagecreatefromjpeg($imageProvenance);
        } elseif ($file_ext == 'gif') {
            $image_new = imagecreatefromgif($imageProvenance);
        } elseif ($file_ext == 'png') {
            $image_new = imagecreatefrompng($imageProvenance);
        } elseif ($extension == 'bmp') {
            $image_new = imagecreatefromwbmp($imageProvenance);
        } else {
            die("Erreur 001 : Impossible de trouver le bon format pour recreer l'image");
            exit;
        }


        //Creation de l'image
        $image = imagecreatetruecolor($imageX, $imageY);
        $color = imagecolorallocate($image, hexdec($color[0] . $color[1]), hexdec($color[2] . $color[3]), hexdec($color[4] . $color[5]));
        imagefilledrectangle($image, 0, 0, $imageX, $imageY, $color);
        imagecopyresampled($image, $image_new, $imageXAfterPoint, $imageYAfterPoint, 0, 0, $imageXAfter, $imageYAfter, $size[0], $size[1]);

        return $image;
    }
}


