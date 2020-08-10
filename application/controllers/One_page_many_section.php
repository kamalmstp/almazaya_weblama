<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class One_page_many_section extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
        $this->data['lang_code'] = $this->idpages[0]->lang_code;
        if($this->idpages[0]->use_default == 0){
            $this->data['codebahasa'] = $this->idpages[0]->lang_code.'/';
            $this->lang->load($this->idpages[0]->lang_code, 'other');
        }else{
            $this->data['codebahasa'] = '';
            $this->lang->load($this->idpages[0]->lang_code, 'other');
        } 
        $this->data['parallax']=1; 
    }
    public function index(){
       
         
        $idpages = $this->db->query('SELECT pages.meta_title,pages.title,pages.meta_description,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        if (isset($idpages[0]->id)){
            $this->data['rec'] = $this->db->query('SELECT title,pic,link,sisterpages FROM banner WHERE sisterpages = '.$idpages[0]->sister.' ORDER BY posisi asc')->result_array();
            if($idpages[0]->use_default == 0){
                $this->data['codebahasa'] = $idpages[0]->lang_code.'/';
            }else{
                $this->data['codebahasa'] = '';
            }
            $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$idpages[0]->sister)->result_array();
           
            $this->data['langnow'] = $idpages[0]->idlang;
        }
        $this->data['controller']=$this; 
        $this->data['link'] = $this->link;
        $this->data['one_page'] = $this->db->query('SELECT a.* FROM one_page_many_section a LEFT JOIN pages b ON a.sisterpages=b.sister WHERE b.idlanguage = '.$idpages[0]->idlang.' AND a.idlanguage= '.$idpages[0]->idlang.' AND b.sister='.$idpages[0]->sister.' and a.draft=0 AND a.hapus=0 ORDER BY a.posisi ASC')->result_array();
        
        $data_orac = $this->db->query('SELECT graphic_orac.pic,graphic_orac.title,graphic_orac.hidden,graphic_orac.orac,graphic_orac.sister FROM `graphic_orac` where graphic_orac.idlanguage = '.$idpages[0]->idlang.' AND graphic_orac.hidden=0 AND graphic_orac.deleted=0  order by graphic_orac.posisi DESC')->result_array();
        $this->data['orac'] = $data_orac;
        $this->data['meta_title'] = $idpages[0]->title;
        if($idpages[0]->meta_title != ""){
            $this->data['meta_title'] = $idpages[0]->meta_title;
        }
        $this->data['meta_description'] = "";
        if($idpages[0]->meta_description != ""){
            $this->data['meta_description'] = $idpages[0]->meta_description;
        }
        //echo "<pre>";
        //print_r($this->data['one_page']);
        $this->load->view('one_page_many_section',$this->data);
    }
    function count_submenu($sister){
        $countnya = $this->db->query('SELECT COUNT(*) FROM pages WHERE sister='.$sister)->result_array();
        
    }
    function show_menu_lang(){
        $lang_menu = $this->db->query('SELECT title,id,lang_code,use_default FROM language WHERE draft = 0 AND hapus=0 ORDER BY use_default DESC')->result_array();
        $htmlString = "";
        $konter = 1;
        $countmenu = count($lang_menu);
        foreach ($lang_menu as $mn){
            if ($mn["use_default"] == 1){
                if (count($this->segs) == 2) {
                    if ($this->link_bahasa == ""){
                        $htmlString .= "<option selected='selected' value='".base_url($this->getMenuOtherLang($mn["id"],$this->link))."'>".strtoupper($mn["lang_code"])."</option>";
                    }else{
                        $htmlString .= "<option value='".base_url($this->getMenuOtherLang($mn["id"],$this->link))."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                }else{
                    if ($this->link_bahasa == ""){
                        $htmlString .= "<option selected='selected' value='".base_url()."'>".strtoupper($mn["lang_code"])."</option>";
                    }else{
                        $htmlString .= "<option value='".base_url()."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                }
            }else{
                if (count($this->segs) == 2) {
                    /*ada code lang bahasa dan di halaman selain home */
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<option selected='selected' value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                    }else{
                        $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link))."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                }else{
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<option selected='selected' value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                    }else{
                        if (isset($this->segs[1])){
                            $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1]))."'>".strtoupper($mn["lang_code"])."</option>";
                        }else{
                            $htmlString .= "<option value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                        }
                    }
                }
            }
            $konter++;
        }
        return $htmlString;
    }
}