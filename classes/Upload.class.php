<?php
class Upload extends Objet {
    
    protected $tmpName;
    protected $mime;
    protected $extension;
    protected $error;
    private $name;
    private $size;
    protected $fieldName;
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    protected function getInfos() {
            $this->tmpName=$_FILES[$this->fieldName]['tmp_name'];
            $this->size=  filesize($this->tmpName);
            $this->mime=$_FILES[$this->fieldName]['type'];
            $this->error=$_FILES[$this->fieldName]['error'];
            $this->name=$_FILES[$this->fieldName]['name'];
            $this->extension= strtolower(strrchr($this->name, "."));
    }
    
    protected function isExtension($array) {
        if(in_array($this->extension, $array))
            return TRUE;
        else
            return FALSE;
    }
    
    protected  function testSize($maxSize) {
        if($this->size>$maxSize)
            return FALSE;
        else
            return TRUE;
    }
    
    protected function testErrors($maxSize, $addComment="") {
        switch ($this->error) {
            case UPLOAD_ERR_INI_SIZE:
                $this->errorMsg.="Le fichier (".$addComment.") depasse le poids maximum de la configuration du serveur.<br />";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->errorMsg.="Fichier (".$addComment.") trop gros.(".$maxSize." Maxi).<br />";
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->errorMsg.="Le fichier (".$addComment.") n'a été que partiellement téléchargé.<br />";
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->errorMsg.="Aucun fichier (".$addComment.") n'a été téléchargé.<br />";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->errorMsg.="Le dossier (".$addComment.") temporaire est manquant.<br />";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->errorMsg.="échec de l'écriture du fichier (".$addComment.") sur le disque.<br />";
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->errorMsg.="Une extension PHP a arreté l'envoi de fichier (".$addComment.").<br />";
                break;
        }
    }


    protected function upload($filename) {
        move_uploaded_file($this->tmpName, $filename);
        chmod($filename, 0777);
    } 
    
    public function getMime() {
        return str_replace('\\', '', $this->mime);
    }
}

?>
