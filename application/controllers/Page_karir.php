<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Page_karir extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.title,pages.meta_title,pages.meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
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
        
        if (isset($_POST["nama"])){
            echo "<pre>";
            print_r($_POST);
        }
        
        $this->data['aksi'] = "default";
        if ($this->parameter != ""){

            $this->data['aksi'] = "detail";
            $query = 'SELECT a.posisi,a.title,a.pic,a.link_youtube,b.title as title_cat FROM `video` a LEFT JOIN kategori_video b ON a.cat=b.id LEFT JOIN pages c ON b.idpages=c.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND b.link LIKE "'.$this->parameter.'" order by a.posisi DESC LIMIT 0,6';
            $artikel_detail = $this->db->query($query)->result_array();
            $this->data['detail'] = $artikel_detail;
            /*
            $query_cat = 'SELECT a.title as title_cat FROM `kategori_video` a WHERE a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'" order by a.posisi DESC LIMIT 0,6';
            $query_cat_detail = $this->db->query($query_cat)->result_array();
            $this->data['cat_title'] = $query_cat_detail[0]["title_cat"];
            */
            $count_artikel = $this->db->query('SELECT count(*) as total FROM `video` a  LEFT JOIN kategori_video b ON a.cat=b.id LEFT JOIN pages c ON b.idpages=c.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND b.link LIKE "'.$this->parameter.'" order by a.posisi')->result_array();
            $this->data['total_detail_artikel'] = $count_artikel[0]["total"];
            
        }
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        
        $this->data['controller']=$this; 
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $this->idpages[0]->title;
        $this->data['current_link_page'] = $this->idpages[0]->link;
        $this->data['content'] = $this->idpages[0]->content;
        $this->data['sisterpage'] = $this->idpages[0]->sister;
        
        $this->data['link'] = $this->link;
        $data["active"] = "all";
        $this->data['banner'] = $this->idpages[0]->pic;
        $this->data['title_page'] = $this->idpages[0]->title;
        $this->data['meta_title'] = $this->idpages[0]->title;
        if($this->idpages[0]->meta_title != ""){
            $this->data['meta_title'] = $this->idpages[0]->meta_title;
        }
        $this->data['meta_description'] = "";
        if($this->idpages[0]->meta_description != ""){
            $this->data['meta_description'] = $this->idpages[0]->meta_description;
        }
        $bread = "";
        $data_bread = $this->pages_parent($this->idpages[0]->parent);
        if ($data_bread != ""){
            if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                $bread = "<a href='".base_url($breadarray[1])."'>".$breadarray[0]."</a>";
            }
        }
        $this->data['parent_breadcrumb'] = $bread;
        
        
        
        $limit = 9;
        if (isset($_GET["page"])){
            
            $start = ($_GET["page"]*$limit) - $limit;
            $page = $_GET["page"];
            $no = (($_GET["page"]*$limit) - $limit) + 1;
        }else{
            $start = 0;
            $no = 1;
            $page = 1;
        }
        
       
            $where = "a.id > 0 ";
            if (isset($_GET["province"])){
                if ($_GET["province"] != ""){
                    $where .= " AND b.province_id = ".$_GET["province"];
                }
                if ($_GET["city"] != ""){
                    $where .= " AND c.city_id = ".$_GET["city"];
                }
                if ($_GET["q"] != ""){
                    $where .= " AND (a.title LIKE '%".$_GET["q"]."%' OR a.address LIKE '%".$_GET["q"]."%')";
                }
            }
            
            $query_others = 'SELECT a.* FROM karir a WHERE  a.deleted=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' order by a.cretime DESC LIMIT  '.$start.','.$limit;
            $query_others_count = 'SELECT a.* FROM karir a  WHERE  a.deleted=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' order by a.cretime DESC';
            
            $data_rec = $this->db->query($query_others)->result_array();  
            $data_rec_count = $this->db->query($query_others_count)->result_array();
            
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->data['codebahasa'].$this->idpages[0]->link);
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }        
            if (count($query_string) > 0)
            {
                $config['suffix'] = '&' . http_build_query($query_string, '', "&");
                $config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
            } 
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            
            $this->pagination->initialize($config);
            $this->data['paging'] = $this->pagination->create_links();    
            $this->data['urutan']        = $urut;
            $this->data['limit']       = $limit;
            
            $this->data['rec']        = $data_rec;
            $this->data['act']        = 'default';
            $this->data['jumlahdata'] = count($data_rec_count);
            $this->data['title'] = $this->idpages[0]->title;
        $this->load->view('karir',$this->data);
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