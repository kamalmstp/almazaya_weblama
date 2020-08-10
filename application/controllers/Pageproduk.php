<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pageproduk extends Base_Controller {
    public function __construct(){
        
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
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
    }
   
    public function index(){
        //echo $this->parameter;
        $this->data['aksi'] = "default";
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        if ($this->parameter != ""){

            $this->data['aksi'] = "detail";
            
            $query_detail = 'SELECT a.link,a.price,a.linkyoutube,a.pic2,a.sister,a.id,a.idlanguage,a.posisi,a.title,a.shipping_return,a.product_detail,a.pic,a.description,a.thumb,a.pic,a.cretime,a.link as link_produk,d.link as link_detail FROM `produk` a LEFT JOIN pages d ON a.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND d.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'" AND d.idlanguage = '.$this->idpages[0]->idlang.' AND d.idlanguage = '.$this->idpages[0]->idlang;
            $artikel_detail = $this->db->query($query_detail)->result_array();
            $this->data['detail'] = $artikel_detail;
            $this->data["other_produk"] = array();
            if (count($artikel_detail) > 0){
                $query_others = 'SELECT a.sister as sisternya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_produk,c.link as link_detail from produk a LEFT JOIN pages c ON a.sisterpages=c.sister WHERE a.idlanguage = '.$this->idpages[0]->idlang.' AND ((a.sisterpages='.$this->idpages[0]->sister.')  OR  (a.otherpages LIKE "'.$this->idpages[0]->sister.'" OR a.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR a.otherpages LIKE "'.$this->idpages[0]->sister.',%"))  AND c.idlanguage = '.$this->idpages[0]->idlang.' AND a.sister != '.$artikel_detail[0]["sister"].' order by a.posisi DESC LIMIT 0,2';
                $otherproduk = $this->db->query($query_others)->result_array();  
                $this->data["other_produk"] = $otherproduk;
            }
            $data["controller"] = $this;
            $bread = "";
            $data_bread = $this->pages_parent($this->idpages[0]->parent);
            if ($data_bread != ""){
                if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                    $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                    $bread = "<a href='".base_url($breadarray[1])."'>".$breadarray[0]."</a>";
                }
            }
            $this->data['link'] = $this->link;
            $this->data['current_page'] = $this->idpages[0]->title;
            $this->data['parent_breadcrumb'] = $bread;
            
            $this->load->view('detailproduk',$this->data);
            
        }else{
            
            $query_product = 'SELECT a.sister as sisternya,a.title,a.icon,a.short_description,a.thumb,a.pic,a.cretime,a.description,a.link as link_produk,c.title as title_pages,c.link as link_detail from produk a  LEFT JOIN pages c ON a.sisterpages=c.sister WHERE a.idlanguage = '.$this->idpages[0]->idlang.' AND ((a.sisterpages='.$this->idpages[0]->sister.')  OR  (a.otherpages LIKE "'.$this->idpages[0]->sister.'" OR a.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR a.otherpages LIKE "'.$this->idpages[0]->sister.',%"))  AND a.idlanguage='.$this->idpages[0]->idlang.' AND c.idlanguage = '.$this->idpages[0]->idlang.' AND a.hidden=0 order by a.posisi DESC';
            $product_list = $this->db->query($query_product)->result_array();  
            $this->data["product_list"] = $product_list;
            //echo "<pre>";
            //print_r($product_list);
            
            
            $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
            $this->data['langnow'] = $this->idpages[0]->idlang;
            $this->data['current_page'] = $this->idpages[0]->title;
            $this->data['current_link_page'] = $this->idpages[0]->link;
            $this->data['content'] = $this->idpages[0]->content;
            $this->data['sisterpage'] = $this->idpages[0]->sister;
            $this->data['link'] = $this->link;
            
            $this->data["parameter"] = $this->parameter;
            $data["active"] = "all";
            $bread = "";
            $data_bread = $this->pages_parent($this->idpages[0]->parent);
            if ($data_bread != ""){
                if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                    $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                    $bread = "<a href='".base_url($breadarray[1])."'>".$breadarray[0]."</a>";
                }
            }
            $this->data['parent_breadcrumb'] = $bread;
            $this->data['banner'] = $this->idpages[0]->pic;
            $this->data['title_page'] = $this->idpages[0]->title;
            $this->load->view('produk',$this->data);
        }
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