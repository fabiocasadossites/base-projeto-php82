<?php

use App\Helpers\Check as HelpersCheck;

/**
 * Upload.class [ HELPER ]
 * class responsável em fazer a gestão de upload do sistema. 
 * @copyright (c) 2014, Fabio Augusto CASA DOS SITES
 */
class Upload
{

    private $File;
    private $Name;
    private $Send;

    /** IAMGEM UPLOAD */
    private $Width;
    private $Heigt;
    private $Image;

    /** RESULTADOS */
    private $Result;
    private $Error;

    /** DIRETORIOS */
    private $Folder;
    private static $BaseDir;

    function __construct($BaseDir = null)
    {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir : 'img/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)) :
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function Image(array $Image, $Name = null, $Width = null, $Folder = null, $Heigt = null)
    {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ((int) $Width ? $Width : 1024);
        $this->Heigt = $Heigt ? $Heigt : '';
        $this->Folder = ((string) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }

    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null)
    {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'arquivos');
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 40);

        $FileAccept = [
            'application/pdf', //PDF
            'application/octet-stream', // ZIP
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //DOC
            'application/msword', //DOC
            'application/msword', //DOC
            'application/vnd.openxmlformats-officedocument.wordprocessingml.template', //DOC
            'application/vnd.ms-word.document.macroEnabled.12', //DOC
            'application/vnd.ms-word.template.macroEnabled.12', //DOC
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //DOC
            'application/vnd.ms-excel', //EXCEL
            'application/vnd.ms-excel', //EXCEL
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //EXCEL
            'application/vnd.openxmlformats-officedocument.spreadsheetml.template', //EXCEL
            'application/vnd.ms-excel.sheet.macroEnabled.12', //EXCEL
            'application/vnd.ms-excel.addin.macroEnabled.12', //EXCEL
            'application/vnd.ms-excel.sheet.binary.macroEnabled.12', //pOWER PONT
            'application/vnd.ms-powerpoint', //pOWER PONT
            'application/vnd.ms-powerpoint', //pOWER PONT
            'application/vnd.ms-powerpoint', //pOWER PONT
            'application/vnd.openxmlformats-officedocument.presentationml.presentation', //pOWER PONT
            'application/vnd.openxmlformats-officedocument.presentationml.template', //pOWER PONT
            'application/vnd.openxmlformats-officedocument.presentationml.slideshow', //pOWER PONT
            'application/vnd.ms-powerpoint.addin.macroEnabled.12', //pOWER PONT
            'application/vnd.ms-powerpoint.presentation.macroEnabled.12', //pOWER PONT
            'application/vnd.ms-powerpoint.template.macroEnabled.12', //pOWER PONT
            'application/vnd.ms-powerpoint.slideshow.macroEnabled.12', //pOWER PONT
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //EXE
            'application/vnd.ms-powerpoint', //POWERPONT
            'application/gzip', //Gzip
            'audio/mp3', //MP3
            'audio/wav', // WAV
            'video/mp4', //MP4
            'application/x-internet-signup',
            'application/x-internet-signup',
            'application/x-iphone',
            'application/x-javascript',
            'application/x-latex',
            'application/x-msaccess',
            'application/x-mscardfile',
            'application/x-msclip',
            'application/x-msdownload',
            'application/x-msmediaview',
            'application/x-msmediaview',
            'application/x-msmediaview',
            'application/x-msmetafile',
            'application/x-msmoney',
            'application/x-mspublisher',
            'application/x-msschedule',
            'application/x-msterminal',
            'application/x-mswrite',
            'application/x-netcdf',
            'application/x-netcdf',
            'application/x-perfmon',
            'application/x-perfmon',
            'application/x-perfmon',
            'application/x-perfmon',
            'application/x-perfmon',
            'application/x-pkcs12',
            'application/x-pkcs12',
            'application/x-pkcs7-certificates',
            'application/x-pkcs7-certificates',
            'application/x-pkcs7-certreqresp',
            'application/x-pkcs7-mime',
            'application/x-pkcs7-mime',
            'application/x-pkcs7-signature',
            'application/x-sh',
            'application/x-shar',
            'application/x-shockwave-flash',
            'application/x-stuffit',
            'application/x-sv4cpio',
            'application/x-sv4crc',
            'application/x-tar',
            'application/x-tcl',
            'application/x-tex',
            'application/x-texinfo',
            'application/x-texinfo',
            'application/x-troff',
            'application/x-troff',
            'application/x-troff',
            'application/x-troff-man',
            'application/x-troff-me',
            'application/x-troff-ms',
            'application/x-ustar',
            'application/x-wais-source',
            'application/x-x509-ca-cert',
            'application/x-x509-ca-cert',
            'application/x-x509-ca-cert',
            'application/ynd.ms-pkipko',
            'application/zip',
            'audio/basic',
            'audio/basic',
            'audio/mid',
            'audio/mid',
            'audio/mpeg',
            'audio/x-aiff',
            'audio/x-aiff',
            'audio/x-aiff',
            'audio/x-mpegurl',
            'audio/x-pn-realaudio',
            'audio/x-pn-realaudio',
            'audio/x-wav',
            'image/bmp',
            'image/cis-cod',
            'image/gif',
            'image/ief',
            'image/jpeg',
            'image/jpeg',
            'image/jpeg',
            'image/pipeg',
            'image/svg+xml',
            'image/tiff',
            'image/tiff',
            'image/x-cmu-raster',
            'image/x-cmx',
            'image/x-icon',
            'image/x-portable-anymap',
            'image/x-portable-bitmap',
            'image/x-portable-graymap',
            'image/x-portable-pixmap',
            'image/x-rgb',
            'image/x-xbitmap',
            'image/x-xpixmap',
            'image/x-xwindowdump',
            'message/rfc822',
            'message/rfc822',
            'message/rfc822',
            'text/css',
            'text/h323',
            'text/html',
            'text/html',
            'text/html',
            'text/iuls',
            'text/plain',
            'text/plain',
            'text/plain',
            'text/plain',
            'text/richtext',
            'text/scriptlet',
            'text/tab-separated-values',
            'text/webviewhtml',
            'text/x-component',
            'text/x-setext',
            'text/x-vcard',
            'video/mpeg',
            'video/mpeg',
            'video/mpeg',
            'video/mpeg',
            'video/mpeg',
            'video/mpeg',
            'video/quicktime',
            'video/quicktime',
            'video/x-la-asf',
            'video/x-la-asf',
            'video/x-ms-asf',
            'video/x-ms-asf',
            'video/x-ms-asf',
            'video/x-msvideo',
            'video/x-sgi-movie',
            'x-world/x-vrml',
            'x-world/x-vrml',
            'x-world/x-vrml',
            'x-world/x-vrml',
            'x-world/x-vrml',
            'x-world/x-vrml',
            'image/png',
            'image/PNG',
            'image/x-png',
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))) :
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->File['type'], $FileAccept)) :
            $this->Result = false;
            $this->Error = 'Tipo de arquivo invalido, por favor envie .PDF, .ZIP, .DOC ou .DOCX, .xlsx(Excel)!';
        else :
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null)
    {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'medias');
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 40);

        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))) :
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->File['type'], $FileAccept)) :
            $this->Result = false;
            $this->Error = 'Tipo de arquivo não suportado. Envie audio MP3 ou vídeo MP4!';
        else :
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    function getResult()
    {
        return $this->Result;
    }

    function getError()
    {
        return $this->Error;
    }

    //PRIVATE
    private function CheckFolder($Folder)
    {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    private function CreateFolder($Folder)
    {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)) :
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName()
    {
        $FileName = HelpersCheck::Name($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)) :
            $FileName = HelpersCheck::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    private function UploadImage()
    {

        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png':
            case 'image/PNG':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;

        if (!$this->Image) :
            $this->Result = false;
            $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
        else :
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            if ($this->Width == '') :
                $ImageX = ($this->Width < $x ? $this->Width : $x);
            else :
                $ImageX = $this->Width;
            endif;
            if ($this->Heigt == '') :
                $imageH = ($ImageX * $y) / $x;
            else :
                $imageH = $this->Heigt;
            endif;
            $NewImage = imagecreatetruecolor($ImageX, $imageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $imageH, $x, $y);

            switch ($this->File['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
                case 'image/png':
                case 'image/PNG':
                case 'image/x-png':
                    imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
            endswitch;

            if (!$NewImage) :
                $this->Result = false;
                $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
            else :
                $this->Result = $this->Send . $this->Name;
                $this->Error = null;
            endif;

            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }

    //envia arquivo e midias
    private function MoveFile()
    {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)) :
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        else :
            $this->Result = false;
            $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
        endif;
    }
}