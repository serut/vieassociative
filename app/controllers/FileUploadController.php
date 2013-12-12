<?php
/**
	* This is the controller for uploading files
	*
	* @author  MIEULET Léo <l.mieulet@gmail.com>
*/
class FileUploadController extends BaseController
{	
	private $prefix_img;
	function __construct(){
		if(App::environment() != "prod"){
			$this->prefix_img = 'deva';
		}else{
			$this->prefix_img = 'a';
		}
	}
 	/**
		* @param string header('X-Requested-With') Given by our upload API
		* @return AJAX URL to files
	*/
	public function postFileUpload(){
		$return = array();
		if(Request::header('X-Requested-With') == "XMLHttpRequest"){
			$context = $this->getContext();
			if($infoSizeFile = $this->getInformationOfChuckedFile()){
				Session::push('chucked_file', file_get_contents('php://input'));
				if(($infoSizeFile[2]+1) == $infoSizeFile[3]){
					//We have all parts of this file
					$name =  $this->getFileName();
					$this->sendObject($name[0],implode('',Session::get('chucked_file')),$context);
					Session::forget('chucked_file');
					$return["status"] = 200;
					$return["files"] = array($this->prefix_img.$context['idAssoc'].'/'.$name[0]);
					$this->addToDatabase($name,$context);
				}
			}
		}
		return Response::json($return);
	}
	public function getContext() {
    	$val = Request::header('Referer');
             //Exemple : http://association.vieassoc.lo/1/edit/file/3
        $pattern  = '/http:\/\/([a-z\.:]+)\/([0-9]+)\/([a-z\/:\.]+)\/([0-9]+)/s';
        if(preg_match($pattern, $val,$elements))
        	return array('idAssoc'=>$elements[2],'idGallery'=>$elements[4]);
        throw new Exception("Error Processing Request", 1);
    }
		
    public function getInformationOfChuckedFile() {
    	$val = Request::header('Content-Range');
             //Exemple : bytes 2097152-3795036/3795037
        $pattern  = '/bytes ([0-9]+)-([0-9]+)\/([0-9]+)/s';
        if(preg_match($pattern, $val,$elements))
        	return $elements;
        throw new Exception("Error Processing Request", 1);
    }
    public function getFileName(){
    	$val = Request::header('Content-Disposition');
             //Exemple : attachment; filename=cobravrai.png
        $name = explode('=', $val);
        return $this->cleanFileName($name[1]);
    }
    /*Get the file extension*/
	public function cleanFileName($file){
		$file = preg_replace("#[^a-zA-Z0-9_\-.]#", "", $file);
		preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$file,$result);
		if(!empty($result[5])){
			$file_ext=$result[5];
			$file_name=$result[3];
			$file_name = preg_replace('/[^\w\._]+/', '_', $file_name);
			$randomString =  Str::random(12);
			$file_name = $randomString.$file_name;
			$name = $file_name.'.'.$file_ext;
		}else{
			//error - regex failed
			throw new Exception("Error Processing Request", 1);
		}
		return array($name,$file_name,$file_ext);
	}

	
	public function isImg($extension){
		$imgExtension = array('png','jpg','bmp','jpeg');
		return in_array(strtolower($extension), $imgExtension);
	}
	public function addToDatabase($file,$context){
		if($this->isImg($file[2])){
			Img::add($file[0], $file[2]);
			FolderFileImg::addImg($context['idGallery'],$file[0]);
		}else{
			$idFile = Files::add($file[0], $file[2]);
			FolderFileImg::addFile($context['idGallery'],$idFile);
		}
	}
	public function sendObject($name,$src,$context){
			if(isset($context['idAssoc'])){
				$name = $this->prefix_img .$context['idAssoc'].'/'.$name;
			}
			try{
				$s3 = AWS::get('s3');
				$s3->putObject(array(
					'Bucket'     => 'img.vieassociative.fr',
					'Key'     	  => $name,
					'Body' 		=> $src,
					'ACL'        => 'public-read',
				));
			} catch (S3Exception $e) {
				//var_dump($e);
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


