<?php
class Image extends Objet {
    
    private $imageSource=NULL;
    private $imageDestination;
    private $extension;
    private $filenameSource;
    private $filenameDestination;
    private $largeurSource=0;
    private $hauteurSource=0;
    private $largeurDestination;
    private $hauteurDestination;
    private $dossier="../datas/images/";
    
    function __construct() {
        parent::__construct();
    }
    
    public function init($filename, $extension) {
        $this->filenameSource=$filename;
        $this->extension=$extension;
        if(file_exists($this->filenameSource)) {
        switch($this->extension) {
            case '.jpg':
                case '.jpeg':
                    $this->imageSource=  imagecreatefromjpeg($this->filenameSource);
                    break;
                case '.png':
                    $this->imageSource=  imagecreatefrompng($this->filenameSource);
                    break;
                case '.gif':
                    $this->imageSource=  imagecreatefromgif($this->filenameSource);
                    break;
                default :
                    $this->imageSource=NULL;
                    break;
        }
        if($this->imageSource!=NULL) {
            $this->largeurSource=  imagesx($this->imageSource);
            $this->hauteurSource=  imagesy($this->imageSource);
        }
        }
        
    }
    
    public function resizeWidth($size,$filename) {
        if($this->imageSource!=NULL) {
        $this->largeurDestination=$size;
        $this->hauteurDestination=($this->largeurDestination/$this->largeurSource)*$this->hauteurSource;
        $this->imageDestination=  imagecreatetruecolor($this->largeurDestination, $this->hauteurDestination);
        imagecopyresampled($this->imageDestination, $this->imageSource,0 ,0 ,0 ,0 , $this->largeurDestination, $this->hauteurDestination, $this->largeurSource, $this->hauteurSource);
            switch($this->extension) {
                case ".jpeg":
                    case ".jpg":
                    imagejpeg($this->imageDestination, $filename);
                        break;
                    case ".png":
                    imagepng($this->imageDestination, $filename);
                        break;
                    case ".gif":
                    imagegif($this->imageDestination, $filename);
                        break;
            }
        }
    }

     public function resizeHeight($size,$filename) {
        if($this->imageSource!=NULL) {
        $this->hauteurDestination=$size;
        $this->largeurDestination=($this->hauteurDestination/$this->hauteurSource)*$this->largeurSource;
        $this->imageDestination=  imagecreatetruecolor($this->largeurDestination, $this->hauteurDestination);
        imagecopyresampled($this->imageDestination, $this->imageSource,0 ,0 ,0 ,0 , $this->largeurDestination, $this->hauteurDestination, $this->largeurSource, $this->hauteurSource);
            switch($this->extension) {
                case ".jpeg":
                    case ".jpg":
                    imagejpeg($this->imageDestination, $filename);
                        break;
                    case ".png":
                    imagepng($this->imageDestination, $filename);
                        break;
                    case ".gif":
                    imagegif($this->imageDestination, $filename);
                        break;
            }
        }
    }
    
    public function resizeLimits($width, $height) {
        if($this->largeurSource>$width) {
            $this->resizeWidth($width, $this->filenameSource);
        }
        if($this->hauteurSource>$height) {
            $this->resizeHeight($height, $this->filenameSource);
        }
    }

    public function resizeAll($contenu) {
        $array=array();
        if(preg_match_all('#<img.+alt="".+src="(.+)".+style="width: ([0-9]{1,4})px#isU', $contenu, $array)) {
            //print_r($array);
            if(count($array[1])>0) {
                 for($k=0; $k<count($array[1]); $k++) {
                    $src='../..'.$array[1][$k];
                    //echo '<a href="'.$src.'">'.$src.'</a><br/>';
                    $width=$array[2][$k];
                    if(file_exists($src))
                        $this->miniResize($src, $width);
                }
            }
        }
    }


    private function miniResize($filename, $width) {
        //echo 'ok!';
        $this->extension= strtolower(strrchr($filename, "."));
        //$filename="../..".$filename;
        switch($this->extension) {
            case ".jpeg":
                case ".jpg":
                    $this->imageSource=  @imagecreatefromjpeg($filename);
                    break;
                case ".png":
                    $this->imageSource=  imagecreatefrompng($filename);
                    break;
                case ".gif":
                    $this->imageSource=  imagecreatefromgif($filename);
                    break;
        }
        if($this->imageSource!=FALSE) {
        $array=array();
        //print_r($array);
        $array=  getimagesize($filename);
        $this->largeurSource= $array[0];
        $this->hauteurSource= $array[1];
        //echo $width."-".$this->largeurSource."<br/>";
        if($width<$this->largeurSource&&  file_exists($filename)) {
            $this->largeurDestination=$width;
            $this->hauteurDestination=($this->largeurDestination/$this->largeurSource)*$this->hauteurSource;
            $this->imageDestination=  imagecreatetruecolor($this->largeurDestination, $this->hauteurDestination);
            imagecopyresampled($this->imageDestination, $this->imageSource, 0, 0, 0, 0, $this->largeurDestination, $this->hauteurDestination, $this->largeurSource, $this->hauteurSource);
            //
            switch($this->extension) {
                case ".jpeg":
                    case ".jpg":
                        imagejpeg($this->imageDestination, $filename);
                        //echo 'ok';
                        break;
                    case ".png":
                        imagepng($this->imageDestination, $filename);
                        break;
                    case ".gif":
                        imagegif($this->imageDestination, $filename);
                        break;
            }
        }
        }
    }

    public function getImageSource() {
        return $this->imageSource;
    }
    
    public function getLargeurSource() {
        return $this->largeurSource;
    }
    
    public function getHauteurSource() {
        return $this->hauteurSource;
    }
    
    public function getFilenameSource() {
        return $this->filenameSource;
    }
}

?>
