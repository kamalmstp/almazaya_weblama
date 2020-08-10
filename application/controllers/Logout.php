<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
        //echo "<pre>";
        //print_r($this->idpages);
        
        $this->data['description'] = "";
        $this->data['lang_code'] = $this->idpages[0]->lang_code;
        $this->parameter = "";
        $this->category = "";
        //echo $this->idpages[0]->use_default;
        if($this->idpages[0]->use_default == 0){
            $this->data['codebahasa'] = $this->idpages[0]->lang_code.'/';
            $this->lang->load($this->idpages[0]->lang_code, 'other');
            if (isset($this->segs[3])){
                $this->parameter = $this->segs[3];
                $this->category = $this->segs[2];
            }
        }else{
            $this->data['codebahasa'] = '';
            $this->lang->load($this->idpages[0]->lang_code, 'other');
            if (isset($this->segs[2])){
                $this->parameter = $this->segs[2];
                $this->category = $this->segs[1];
            }
        } 
        $this->output->nocache();
        //echo "tset".$this->data['codebahasa'];
        //$this->output->clear_all_cache();
    }
    
    public function index(){
      
        $this->session->unset_userdata('login_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('divisi');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('pic');
        $this->session->unset_userdata('statuslogin');
        $data_session = $this->session->all_userdata();
        //echo "<pre>";
//        print_r($data_session);
//        die();
        $this->session->unset_userdata('cart');
        $this->session->unset_userdata('some_name');
        session_destroy();
        session_unset();
        redirect(base_url(), 'refresh');
        die();
    }
    
    
}