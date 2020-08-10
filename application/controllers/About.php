<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class About extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
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
    }
    public function index(){
        //echo $this->parameter;
        $this->data['aksi'] = "default";
        if ($this->parameter != ""){
            $this->data['aksi'] = "detail";
            $query = 'SELECT a.posisi,a.title,a.pic,a.link_youtube,b.title as title_cat FROM `foto` a LEFT JOIN kategori_video b ON a.cat=b.id LEFT JOIN pages c ON b.idpages=c.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND b.link LIKE "'.$this->parameter.'" order by a.posisi DESC LIMIT 0,6';
            $artikel_detail = $this->db->query($query)->result_array();
            $this->data['detail'] = $artikel_detail;
            $query_cat = 'SELECT a.title as title_cat FROM `kategori_foto` a WHERE a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'" order by a.posisi DESC LIMIT 0,6';
            $query_cat_detail = $this->db->query($query_cat)->result_array();
            $this->data['cat_title'] = $query_cat_detail[0]["title_cat"];
            $count_artikel = $this->db->query('SELECT count(*) as total FROM `foto` a  LEFT JOIN kategori_foto b ON a.cat=b.id LEFT JOIN pages c ON b.idpages=c.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND b.link LIKE "'.$this->parameter.'" order by a.posisi')->result_array();
            $this->data['total_detail_artikel'] = $count_artikel[0]["total"];
        }
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        $getabout = $this->db->query('SELECT title,description FROM content WHERE module = "'.$this->idpages[0]->idmodule.'"')->result();
        $this->data['controller']=$this; 
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $getabout[0]->title;
        $this->data['current_link_page'] = $this->idpages[0]->link;
        $this->data['description'] = $getabout[0]->description;
        $this->data['isicontent'] = $getabout[0]->description;
        $this->data['sisterpage'] = $this->idpages[0]->sister;
        $this->data['pic'] = $this->idpages[0]->pic;
        $this->data['link'] = $this->link;
        $bread = "";
        $data_bread = $this->pages_parent($this->idpages[0]->parent);
        if ($data_bread != ""){
            if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                $bread = "<li><a href='".base_url($breadarray[0])."'>".$breadarray[1]."</a></li>";
            }
        }
        $this->data['parent_breadcrumb'] = $bread;
        $this->data['meta_title'] = $this->idpages[0]->title;
        if($this->idpages[0]->meta_title != ""){
            $this->data['meta_title'] = $this->idpages[0]->meta_title;
        }
        $this->data['meta_description'] = "";
        if($this->idpages[0]->meta_description != ""){
            $this->data['meta_description'] = $this->idpages[0]->meta_description;
        }
        $data_rec_about_detail = $this->db->query('SELECT * FROM `about_detail`  where deleted=0 AND hapus=0 AND idlanguage = '.$this->id_bahasa.' order by posisi desc')->result_array();  
        //print_r($data_rec_about_detail);
        $this->data["about_detail"] = $data_rec_about_detail;
        $this->data["parameter"] = $this->parameter;
        $data["active"] = "all";
        $this->load->view('about',$this->data);
    }
    public function _getSubSideMenu($sister){
        $deflang = $this->id_bahasa;
        $submenu = $this->db->query('SELECT id,title,sister,link FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
        $htmlstring = "";
        $htmlstring .= "<div id=\"panel1d\" class=\"accordion-content\" role=\"tabpanel\" data-tab-content aria-labelledby=\"panel1d-heading\">";
        if (count($submenu) > 0){
            $htmlstring .= "<ul>";
            foreach ($submenu as $dt){
                $htmlstring .= "<li><a href='".base_url($this->link_bahasa.$dt["link"]."'>".$dt["title"])."</a></li>";
            }
            $htmlstring .= "</ul>";
        }
        $htmlstring .= "</div>";
        return $htmlstring;
    }
    function pages_parent($parent){
        $idpages = $this->db->query('SELECT pages.link,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        if (count($idpages) > 0){
             return $idpages[0]->link.";".$idpages[0]->title;
            }
        return 0;
    }
    function sidemenu($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return $sidemenunya;
    }
    function getChild($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return count($sidemenunya);
    }
    function show_menu_lang(){
        $lang_menu = $this->db->query('SELECT title,id,lang_code,use_default FROM language WHERE draft = 0 AND hapus=0 ORDER BY use_default DESC')->result_array();
        $htmlString = "";
        $konter = 1;
        $countmenu = count($lang_menu);
        $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
        foreach ($lang_menu as $mn){
            if ($mn["use_default"] == 1){
                if (count($this->segs) == 2) {
                    if ($mn["lang_code"] == $this->segs[1]){
                        $htmlString .= "<option selected='selected' value='".base_url($this->segs[1]."/".$this->segs[2])."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                    else{
                        $htmlString .= "<option selected='selected' value='".base_url($this->getMenuOtherLang($mn["id"],$this->link))."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                }
                if (count($this->segs) == 1){
                    $htmlString .= "<option selected='selected' value='".base_url($this->segs[1])."'>".strtoupper($mn["lang_code"])."</option>";
                }
                if (count($this->segs) == 3){
                    $htmlString .= "<option selected='selected' value='".base_url($this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."'>".strtoupper($mn["lang_code"])."</option>";
                }
            }else{
                if (count($this->segs) == 2) {
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<option selected='selected' value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link))."'>".strtoupper($mn["lang_code"])."</option>";
                    }else{
                        $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link)."/".$this->getReportOtherLang($mn["id"],$this->segs[2]))."'>".strtoupper($mn["lang_code"])."</option>";
                    }
                }else{
                    if (count($this->segs) == 3){
                        if ($mn["lang_code"] == $codelang[0]->lang_code){
                            $htmlString .= "<option selected='selected' value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."'>".strtoupper($mn["lang_code"])."</option>";
                        }else{
                            if (isset($this->segs[1])){
                                if (isset($this->segs[2])){
                                    $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."'>".strtoupper($mn["lang_code"])."</option>";
                                }else{
                                    $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."'>".strtoupper($mn["lang_code"])."</option>";
                                }
                            }else{
                                $htmlString .= "<option value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                            }
                        }
                    }else{
                        if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                            $htmlString .= "<option value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                        }else{
                            if (isset($this->segs[1])){
                                if (isset($this->segs[2])){
                                    $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2]))."'>".strtoupper($mn["lang_code"])."</option>";
                                }else{
                                    $htmlString .= "<option value='".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1]))."'>".strtoupper($mn["lang_code"])."</option>";
                                }
                            }else{
                                $htmlString .= "<option value='".base_url("".$mn["lang_code"]."")."'>".strtoupper($mn["lang_code"])."</option>";
                            }
                        }
                    }
                }
            }
            $konter++;
        }
        return $htmlString;
    }
    function getReportOtherLang($idlang,$link){
        $pagenya = $this->db->query('SELECT a.title,link FROM hubungan_investor a WHERE a.sister = (SELECT sister FROM `hubungan_investor` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'')->result_array();
        return $pagenya[0]["link"];
    }
}