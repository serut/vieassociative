<?php

class PictureController  extends BaseController {

    private $root;
    private $url;
    function __construct(){
        $this->root = dirname(dirname(dirname(__FILE__)));
        $this->url = $this->root.DIRECTORY_SEPARATOR.'banque-image'.DIRECTORY_SEPARATOR;
    }
    public function getAssociationPictures($idAssoc){
        return View::make('picture.gestion-image')
                ->with('type',Input::get('change'));
    }
    /* ZEND
    public function getDesactiverImage(){
       $id = Input::get('id');
       $result = Image::desactiverImage($id, Session::get('associationEnManagement'));
       if($result == 1){
           $URL = $this->url()->fromRoute('association', array('action'=>'profil'));
           die(Json::encode(array('id'=>$id,'etat'=>'succes','url'=>$URL)));
       }
       die(Json::encode(array('id'=>$id,'etat'=>'echec','result'=>$result)));
    }
    */
    public function getVoir($qualite,$nomImage) {
        if(empty($nom_image) || empty($qualite) || !in_array($qualite,array('400x400','195x195','195x180','original'))){
            return false;
        }
        
        $dossier_image_originalle = $this->url . 'original' . DIRECTORY_SEPARATOR;
        $dossier_image = $this->url . $qualite . DIRECTORY_SEPARATOR;
        if (!file_exists($dossier_image_originalle . $nom_image)) 
        {
            $imageAfficher = "image-introuvable-vieassoc.png";
        }else{
            if (!file_exists($dossier_image . $nom_image)) {
                $imageX = $this->getX($qualite);
                $imageY = $this->getY($qualite);
                $image = $this->creerImageDimensionnee($nom_image, $imageX, $imageY);
                imagejpeg($image,$dossier_image. $nom_image);
            }
            
            $imageAfficher = $nom_image;
            Image::ajouterVue($nom_image);
            if(! Image::isImageToujoursActive($nom_image)){
                $imageAfficher = "image-introuvable-vieassoc.png";
            }
        }
        header('content-type: image/jpeg');
        readfile($dossier_image . $imageAfficher);
    }
    private function getX($qualite){
        $result = preg_split("/[x]/", $qualite);
        return $result[0];
    }
    private function getY($qualite){
        $result = preg_split("/[x]/", $qualite);
        return $result[1];
    }

    private function creerImageDimensionnee($fileOri, $imageX, $imageY) {
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
        
        // Bonne cr�ation d'image
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
    /*Get the file extension*/
    private function getFileName($file){
        $file = preg_replace("#[^a-zA-Z0-9_\-.]#", "", $file);
        preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$file,$result);
        if(!empty($result[5])){
                $file_ext=$result[5];
                $file_name=$result[3];
                $file_name = preg_replace('/[^\w\._]+/', '_', $file_name);
        }else{
                $file_ext='jpg';
                $file_name = $this->genererNomAleatoire();
        }
        return array($file_name,$file_ext);
    }
    private function genererNomAleatoire(){
        $file_name="";
        $chaine = "abcdefghijklmnpqrstuvwxy"; // Chaine de caractère généré aléatoire. Cool non ?
        srand((double)microtime()*1000000);
        for($i=0; $i<12; $i++) {
                $file_name .= $chaine[rand()%strlen($chaine)];
        }
        return $file_name;
    }
    // Script que je n'ai pas cod� qui prends des images en petit morceaux ( chunk )
    // Et qui donne des images comme il faut à la fin
    public function postUpload() {
        @set_time_limit(5 * 60);
        $max_file_size = "5000";

        /* Path to store files on your server If this fails use $fullpath below. With trailing slash. */
        $targetDir =  $this->url . "original";

        /* Types of files that are acceptiable for uploading. Keep the array structure. */
        $allow_types = array("jpg", "png", "jpeg", "bmp",'gif');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Get parameters
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

        // Clean the fileName for security reasons
        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
        // Make sure the fileName is unique 
        if (file_exists($targetDir . '/' . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . '/' . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }
        $file = $this->getFileName($fileName);
        $file_ext = $file[1];
        $file_name = $file[0];


        $filePath = $targetDir . '/' . $file_name . "." . $file_ext;

        /* Check if the file type uploaded is a valid file type. */
        if (!in_array(strtolower($file_ext), $allow_types)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "The file is not with the good type : ' . $file_ext . '"}, "id" : "id"}');
        }

		
        // Create target dir
        if (!file_exists($targetDir))
            @mkdir($targetDir);

        // Look for the content type header
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];

        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                // Open temp file
                $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = fopen($_FILES['file']['tmp_name'], "rb");
                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    } else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    fclose($in);
                    fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                fclose($in);
                fclose($out);
            } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            $idImage = Image::ajouterImage(Auth::user()->id,"Session::get('associationEnManagement')",$fileName,IP);
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
            die('{"jsonrpc" : "2.0", "result" : "done", "id" : '.$idImage.' ,"name" : "' . $fileName . '"}');
        }
        // Return JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }

}