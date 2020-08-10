<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Promo_info_list extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
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
            $this->lang->load($this->idpages[0]->lang_code, 'default');
            if (isset($this->segs[2])){
                $this->parameter = $this->segs[2];
                $this->category = $this->segs[1];
            }
        } 
        $this->output->nocache();
        //$this->output->clear_all_cache();
    }
   
    public function index(){
        //echo $this->parameter;
        $this->data['aksi'] = "default";
        if ($this->parameter != ""){
            $this->data['aksi'] = "detail";
            $artikel_detail = $this->db->query('SELECT a.posisi,a.title,a.pic2,a.description,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'" order by a.crdate_set')->result_array();
            $this->data['detail'] = $artikel_detail;
            
            
            $this->data['prev'] = "";
            $this->data['next'] = "";
            if (count($artikel_detail) > 0){
                $query_prev = 'SELECT a.posisi,a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.posisi < "'.$artikel_detail[0]["posisi"].'" AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,2';
                $artikel_prev = $this->db->query($query_prev)->result_array();
                $this->data['prev'] = $artikel_prev;
                
                $query_next = 'SELECT a.posisi,a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.posisi > "'.$artikel_detail[0]["posisi"].'" AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,2';
                $artikel_next = $this->db->query($query_next)->result_array();
                $this->data['next'] = $artikel_next;
               
            }
            
            
        }
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        
        $this->data['menu'] = $this->db->query('SELECT a.idmodule,a.id,a.title,a.link,a.parent,language.lang_code,a.submenu,a.sister,(SELECT COUNT(*) FROM pages d WHERE a.sister=d.parent AND d.idlanguage=language.id) AS hasubmenu FROM pages a INNER JOIN language on a.idlanguage = language.id  WHERE a.parent = 0 AND a.hapus = 0 AND a.draft = 0 AND language.lang_code = "'.$this->bahasa.'" AND a.type=1 ORDER BY a.posisi ASC')->result_array();
        
        $this->data['controller']=$this; 
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $this->idpages[0]->title;
        $this->data['description'] = $this->idpages[0]->content;
        $this->data['sisterpage'] = $this->idpages[0]->sister;
        
        
        if ($this->idpages[0]->idlang == 1){
            $this->data['new'] = $this->idpages[0]->title. " Terbaru";
        }
        else{
            $this->data['new'] = "Latest ".$this->idpages[0]->title;
        }
        $this->data['current_parent_page'] = $this->pages_parent($this->idpages[0]->parent);
        $bread = "";
        $data_bread = $this->pages_parent($this->idpages[0]->parent);
        if ($data_bread != ""){
            if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                $bread = "<a href='".base_url($breadarray[1])."'>".$breadarray[0]."</a>";
            }
        }
        
        $this->data['parent_breadcrumb'] = $bread;
        
        
        $this->data['link'] = $this->link;
        $limit = 6;
        
        
        
        $newquery = 'SELECT a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.idpages=d.sister AND d.idlanguage = '.$this->idpages[0]->idlang.' where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,4';
        $newartikel = $this->db->query($newquery)->result_array();
        $this->data['new_rec_artikel'] = $newartikel;
        
        
        $query = 'SELECT a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.idpages=d.sister AND d.idlanguage = '.$this->idpages[0]->idlang.' where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 4,'.$limit;
        $artikel = $this->db->query($query)->result_array();
        $count_artikel = $this->db->query('SELECT count(*) as total FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.crdate_set ASC')->result_array();
        $this->data['rec_artikel'] = $artikel;
        
        
        
        $this->data['total_artikel'] = $count_artikel[0]["total"];
        $newartikel = $this->db->query('SELECT a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail,DATE_FORMAT(crdate_set,"%w") AS tgl,DATE_FORMAT(crdate_set,"%d") AS tglnya,DATE_FORMAT(crdate_set,"%m") AS bln,DATE_FORMAT(crdate_set,"%Y") AS thn FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" order by a.posisi DESC limit 0,5')->result_array();
        $this->data['new_artikel'] = $newartikel;
            
        $data["active"] = "all";
        $this->data['banner'] = $this->idpages[0]->pic;
        $this->data['title_page'] = $this->idpages[0]->title;
        
        $where = 'idpages LIKE ",'.$this->idpages[0]->sister.'%" OR ';
        $where .= 'idpages LIKE "'.$this->idpages[0]->sister.',%" ';  
        $where .= 'OR idpages LIKE "%,'.$this->idpages[0]->sister.'%"';
        $where .= 'OR idpages LIKE "%'.$this->idpages[0]->sister.',"';
        $where .= 'OR idpages LIKE "%,'.$this->idpages[0]->sister.',%"';
        $where .= 'OR idpages LIKE "'.$this->idpages[0]->sister.'"';
        $this->data['sidebar'] = $this->db->query('SELECT a.title,a.link,a.pic,a.tipe,a.target FROM banner_sidebar a WHERE a.hapus = 0 AND a.draft = 0 AND a.idlanguage = "'.$this->idpages[0]->idlang.'" AND ('.$where.') ORDER BY a.posisi asc')->result_array();
        
        $this->load->view('listpromoinfo',$this->data);
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
        $idpages = $this->db->query('SELECT pages.parent,pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        $htmlstring = "";
        //echo "<pre>";
        //print_r($idpages[0]);
        if (isset($idpages[0]->parent)){
            if ($idpages[0]->parent == 0){
                //echo "babase";
                $htmlstring = $idpages[0]->title .";". $idpages[0]->link;
            }else{
                $htmlstring = 0;
            }
        }
        
        return $htmlstring;
    
    }
    function sidemenu($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return $sidemenunya;
    }
    function getChild($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
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
        $query = 'SELECT a.title,link FROM artikel a WHERE a.sister IN (SELECT sister FROM `artikel` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'';
        //echo $query;
        $pagenya = $this->db->query($query)->result_array();
        return $pagenya[0]["link"];
    }
    
}