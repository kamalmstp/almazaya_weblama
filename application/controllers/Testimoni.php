<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni extends CI_Controller {
  public function __construct(){
      
    parent::__construct();

    $this->segs = $this->uri->segment_array();

  }
  public function index(){

    if (count($this->segs) == 2) {
      $bahasa = $this->segs[1];
      $link = $this->segs[2];
    }elseif (count($this->segs == 1)) {
      $codelang = $this->db->query('SELECT lang_code FROM language WHERE use_default = 1')->result();

      $bahasa = $codelang[0]->lang_code;
      $link = $this->segs[1];
    }
    
    $idpages = $this->db->query('SELECT pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$link.'" AND language.lang_code = "'.$bahasa.'"')->result();

    $data['rec'] = $this->db->query('SELECT title,pic,link,tahun FROM videotestimonial WHERE idpages = '.$idpages[0]->id)->result_array();

    $data['page'] = $this->db->query('SELECT title,subtitle,pic FROM pages WHERE id = '.$idpages[0]->id)->result();

    $data['menu'] = $this->db->query('SELECT pages.id,pages.title,pages.link,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = 0 AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$bahasa.'" ORDER BY pages.posisi asc')->result_array();

    $data['submenu'] = $this->db->query('SELECT pages.id,pages.title,pages.link,language.lang_code,pages.submenu,pages.parent FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent <> 0 AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$bahasa.'" ORDER BY pages.posisi asc')->result_array();

    if($idpages[0]->use_default == 0){
      $data['codebahasa'] = $idpages[0]->lang_code.'/';
    }else{
      $data['codebahasa'] = '';
    }

    $data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$idpages[0]->sister)->result_array();
    $data['langnow'] = $idpages[0]->idlang;
    $data['link'] = $link;

    $this->load->view('testi',$data);
  }
}
