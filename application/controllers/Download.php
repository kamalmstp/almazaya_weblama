<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends Base_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        print_r($this->segs[3]);
        
        
        $file = $this->segs[3];
        $filename = $file;
        $filepath = FCPATH.'/uploads/' . $filename;
        $chunk = 10 * 1024 * 1024; // bytes per chunk (10 MB)

        $fh = fopen($filepath, "rb");
        
        if ($fh === false) {
            echo "Unable open file";
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Repeat reading until EOF
        while (!feof($fh)) {
            echo fread($handle, $chunk);
           
            ob_flush();  // flush output
            flush();
        }
        
        exit;
    }
    
}