<?php
/**
	* This is the controller for uploading files
	*
	* @author  MIEULET Léo <l.mieulet@gmail.com>
*/
class FileUploadController extends BaseController
{	
	private $prefix_img;
	private $id_assoc;
	private $id_gallery;
	private $file_name;
	private $file_ext;
	private $name;
	private $original_url;

 	/**
		* @param string header('X-Requested-With') Given by our upload API
		* @return AJAX URL to files
		* TODO : clean this controller
	*/
	public function postFileUpload(){
		$return = array();
		if(Request::header('X-Requested-With') == "XMLHttpRequest"){
			$this->getContext();
			Session::push('chucked_file', file_get_contents('php://input'));
			if($this->isFinished()){
				//We have all parts of this file
				$this->getFileName();
				if($this->isImg()){
					$this->original_url = $this->prefix_img .$this->id_assoc.'/'.$this->name;
					$this->sendObject(implode('',Session::get('chucked_file')),$this->original_url);
					Session::forget('chucked_file');
					$this->addToDatabase();
					$this->galleryThumbnail();
					$return["status"] = 200;
					$return["file"] = array($this->original_url);
					$return["img_name"] = array($this->name);
					$return["thumbnail"] = array($this->original_url. "_thumbnail.jpg");
				}else{
					return $this->postError('Not an image');	
				}
			}
		}
		return Response::json($return);
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
	public function getContext() {
    	$val = Request::header('Referer');
             //Exemple : http://association.vieassoc.lo/1/edit/file/3
        $pattern  = '/http:\/\/([a-z\.:]+)\/([0-9]+)\/([a-z\/:\.]+)\/([0-9]+)/s';
        if(preg_match($pattern, $val,$elements)){
        	$this->id_assoc = $elements[2];
        	$this->id_gallery = $elements[4];
        	$this->prefix_img = $this->getPrefixImg();
        }else{
        	return $this->postError(1);
        }
    }
	public function getPrefixImg(){
		if(App::environment() != "production"){
			return 'deva';
		}else{
			return 'a';
		}
	}
    public function getFileName(){
    	$val = Request::header('Content-Disposition');
             //Exemple : attachment; filename=cobravrai.png
        $name = explode('=', $val);
        if(isset($name[1]) && !empty($name[1])){
        	$this->cleanFileName($name[1]);
        }else{
        	return $this->postError(2);
        }
    }
    public function isFinished() {
    	$val = Request::header('Content-Range');
             //Exemple : bytes 2097152-3795036/3795037
        $pattern  = '/bytes ([0-9]+)-([0-9]+)\/([0-9]+)/s';
        if(preg_match($pattern, $val,$elements)){
        	return ($elements[2]+1) == $elements[3];
        }else{
        	return $this->postError(4);
        }
    }
	public function isImg(){
		$imgExtension = array('png','jpg','bmp','jpeg');
		return in_array(strtolower($this->file_ext), $imgExtension);
	}
    /**
    *	Get the file extension
    */
	public function cleanFileName($file){
		$file = preg_replace("#[^a-zA-Z0-9_\-.]#", "", $file);
		preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$file,$result);
		if(!empty($result[5])){
			$file_name=$result[3];
			$file_name = preg_replace('/[^\w\._]+/', '_', $file_name);
			$randomString =  Str::random(12);
			$this->file_name = $randomString.$file_name;
			$this->file_ext=$result[5];
			$this->name = $this->file_name.'.'.$this->file_ext;
		}else{
			return $this->postError(3);
		}
	}




	/**
	*	Not working ?
	*/
	public function removeImgFromDatabase($name){
		FolderFileImg::where('id_folder',$this->id_gallery)->where('name_img',$name)->delete();
		Img::where('name',$name)->delete();
		return $this->postError(5);
	}
	public function addToDatabase(){
		Img::add($this->name, $this->file_ext);
		FolderFileImg::addImg($this->id_gallery,$this->name);
		$a = Association::get($this->id_assoc);
		$a->nb_photos++;
		$a->touch();
		/*
		$idFile = Files::add($file[0], $file[2]);
		FolderFileImg::addFile($context['idGallery'],$idFile);
		*/
	}
	public function sendObject($src,$s3_url){
		$contentType = "image/png";//image/jpeg 
		try{
			$s3 = AWS::get('s3');
			$s3->putObject(array(
				'Bucket'      => 'img.vieassociative.fr',
				'Key'     	  => $s3_url,
				'Body' 		  => $src,
				'contentType' => $contentType,
				'ACL'         => 'public-read',
			));
		} catch (S3Exception $e) {
			//var_dump($e);
			return Response::json('error', 400);
		}
	}










	public function galleryThumbnail(){
		//$img = $this->creerImageDimensionnee($this->file_ext,$this->original_url);
		$img = $this->createImageFixedWidth($this->file_ext,$this->original_url,190);

        ob_start();
		imagejpeg($img, null);
		$img = ob_get_clean();

		$this->sendObject($img,$this->original_url . "_thumbnail.jpg");
	}
	public function creerImageDimensionnee($file_ext,$from_url, $imageX="180", $imageY="180") {
        // A partir du nom du fichier, recupere le nom et l'extension
        $qualite = 100; // Qualite de l'image
        $color = "ffffff"; // Couleur de fond

		$imageProvenance = "http://img.vieassociative.fr/".$from_url;

        $imageXAfter = 0; // Dimension de la future image
        $imageYAfter = 0;
        $imageXAfterPoint = 0; // decalage de l'ancienne image dans la nouvelle image
        $imageYAfterPoint = 0;

        //Calcul de la dimension de l'image résultante
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
        try{
	        if ($file_ext == 'jpg' OR $file_ext == 'jpeg') {
	            $image_new = imagecreatefromjpeg($imageProvenance);
	        } elseif ($file_ext == 'gif') {
	            $image_new = imagecreatefromgif($imageProvenance);
	        } elseif ($file_ext == 'png') {
	            $image_new = imagecreatefrompng($imageProvenance);
	        } elseif ($extension == 'bmp') {
	            $image_new = imagecreatefromwbmp($imageProvenance);
	        }
        }catch(Exception $e) {
        	$this->removeImgFromDatabase($this->name);
        }


        //Creation de l'image
        $image = imagecreatetruecolor($imageX, $imageY);
        $color = imagecolorallocate($image, hexdec($color[0] . $color[1]), hexdec($color[2] . $color[3]), hexdec($color[4] . $color[5]));
        imagefilledrectangle($image, 0, 0, $imageX, $imageY, $color);
        imagecopyresampled($image, $image_new, $imageXAfterPoint, $imageYAfterPoint, 0, 0, $imageXAfter, $imageYAfter, $size[0], $size[1]);
        return $image;
    }

	public function createImageFixedWidth($file_ext,$from_url, $width) {
	    // Loading the image and getting the original dimensions
		$imageProvenance = "http://img.vieassociative.fr/".$from_url;

		// Bonne création d'image

        try{
	        if ($file_ext == 'jpg' OR $file_ext == 'jpeg') {
	            $image = imagecreatefromjpeg($imageProvenance);
	        } elseif ($file_ext == 'gif') {
	            $image = imagecreatefromgif($imageProvenance);
	        } elseif ($file_ext == 'png') {
	            $image = imagecreatefrompng($imageProvenance);
	        } elseif ($extension == 'bmp') {
	            $image = imagecreatefromwbmp($imageProvenance);
	        }
        }catch(Exception $e) {
        	return $this->removeImgFromDatabase($this->name);
        }
		$orig_width = imagesx($image);
		$orig_height = imagesy($image);

		// Calc the new height
		$height = (($orig_height * $width) / $orig_width);

		// Create new image to display
		$new_image = imagecreatetruecolor($width, $height);

		// Create new image with changed dimensions
		imagecopyresized($new_image, $image,
			0, 0, 0, 0,
			$width, $height,
			$orig_width, $orig_height);

		// Print image
		return $new_image;
    }
	public function postCrop($idAssoc,$typeCrop,$action,$namePic){
        switch ($typeCrop) {
            case '400x400':
                $target_w = 400;
                $target_h = 400;
                break;
            case '120x120':
                $target_w = 120;
                $target_h = 120;
                break;
            case '1130x400':
                $target_w = 1130;
                $target_h = 400;
                break;
            case '940x350':
            	$target_w = 940;
				$target_h = 350;
                break;
            default:
                return Response::view('errors.404', array(), 404);
                break;
        }
		
		$x = intval(Input::get('x',0));
		$y = intval(Input::get('y',0));
		$w = intval(Input::get('w',0));
		$h = intval(Input::get('h',0));
		$jpeg_quality = 100;
		$i = Img::find($namePic);
		$this->prefix_img = $this->getPrefixImg();
		$src = "http://img.vieassociative.fr/".$this->prefix_img.$idAssoc.'/'.$i->name;
		$file_ext = $i->extension;
		try{
	        if ($file_ext == 'jpg' OR $file_ext == 'jpeg') {
	            $img_r = imagecreatefromjpeg($src);
	        } elseif ($file_ext == 'gif') {
	            $img_r = imagecreatefromgif($src);
	        } elseif ($file_ext == 'png') {
	            $img_r = imagecreatefrompng($src);
	        } elseif ($extension == 'bmp') {
	            $img_r = imagecreatefromwbmp($src);
	        }
        }catch(Exception $e) {
        	return $this->removeImgFromDatabase($this->name);
        }
		$dst_r = ImageCreateTrueColor( $target_w, $target_h );

		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$target_w,$target_h,$w,$h);


        ob_start();
		imagejpeg($dst_r, null);
		$img = ob_get_clean();


		$urlImg = $this->prefix_img . $idAssoc .'/'. $namePic . '-'.$typeCrop.".jpg";
		$this->sendObject($img,$urlImg);

		$a = Association::find($idAssoc);
		switch ($action) {
			case '-cover':
				$a->cover_img = $namePic;
				$a->touch();
				break;

			case '-logo':
				$a = Association::find($idAssoc);
				$a->logo_img = $namePic;
				$a->touch();
				break;
			
			default:
				# code...
				break;
		}
		return Redirect::to('/'.$idAssoc.'-'.$a->slug);
	}










	public function postError($codeError){
		$return = array('error'=> 'true','status'=>'Une erreur a été detecté pendant l\'upload. Code erreur : '.$codeError);
		return Response::json($return);
	}
}


