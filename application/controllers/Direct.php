<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Direct extends Base_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok"); 
    }
    public function index(){
        
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://nutrivebenecol.com");

    }
    
}
