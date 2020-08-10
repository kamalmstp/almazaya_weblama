<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cekkalorimakanan extends Base_Controller {
    public function __construct(){
        parent::__construct();
        
    }
    public function index(){
        
        
        $this->data['data'] = "";
        $this->load->view('cekkalorimakanan',$this->data);
    }
    
}