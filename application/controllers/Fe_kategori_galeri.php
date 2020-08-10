<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fe_kategori_galeri extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT record,meta_title,meta_description,pages.parent,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
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
        $this->data['aksi'] = "default";
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $this->idpages[0]->title;
        $this->data['description'] = $this->idpages[0]->content;
        $this->data['sisterpage'] = $this->idpages[0]->sister;
        $this->data['current_page_id'] = $this->idpages[0]->id;
        $this->data['current_parent_page'] = $this->pages_parent($this->idpages[0]->parent);
        $this->data['link_page'] = $this->idpages[0]->link;
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
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        $this->data['meta_title'] = $this->idpages[0]->title;
        if($this->idpages[0]->meta_title != ""){
            $this->data['meta_title'] = $this->idpages[0]->meta_title;
        }
        $this->data['meta_description'] = "";
        if($this->idpages[0]->meta_description != ""){
            $this->data['meta_description'] = $this->idpages[0]->meta_description;
        }
        if ($this->parameter != ""){
            $this->data['aksi'] = "detail";
            $query_detail = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages FROM `aktifitas` a  LEFT JOIN pages b ON b.record='.$this->idpages[0]->record.' WHERE a.idmenu='.$this->idpages[0]->record.' AND  a.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'"';
            $artikel_detail = $this->db->query($query_detail)->result_array();
            
            
            $query_related = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages FROM `aktifitas` a  LEFT JOIN pages b ON b.record='.$artikel_detail[0]["idmenu"].' WHERE a.idmenu='.$artikel_detail[0]["idmenu"].'  AND a.link != "'.$this->parameter.'" AND  a.idlanguage = '.$this->idpages[0]->idlang.' LIMIT 0,3';
            $artikel_related = $this->db->query($query_related)->result_array();
            
            
            
            
            $this->data['detail'] = $artikel_detail;
            $this->data['related'] = $artikel_related;
          
              
            
//            echo "<pre>";
//            print_r($data_rec_ads_banner_global);
            $this->data['prev'] = "";
            $this->data['next'] = "";
            if (count($artikel_detail) > 0){
                $query_prev_new = 'SELECT a.link as link_next,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND d.idlanguage = '.$this->idpages[0]->idlang.' AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.sisterpages LIKE "'.$this->idpages[0]->sister.'" OR c.sisterpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.sisterpages LIKE "'.$this->idpages[0]->sister.',%") AND a.posisi < '.$artikel_detail[0]["posisi"].' order by a.posisi DESC limit 0,1';
                $query_prev = 'SELECT a.posisi,a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.posisi < "'.$artikel_detail[0]["posisi"].'" AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,2';
                $artikel_prev = $this->db->query($query_prev_new)->result_array();
                $this->data['prev'] = $artikel_prev;
                $query_next_new = 'SELECT a.link as link_next,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.sisterpages LIKE "'.$this->idpages[0]->sister.'" OR c.sisterpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.sisterpages LIKE "'.$this->idpages[0]->sister.',%") AND d.idlanguage = '.$this->idpages[0]->idlang.' AND a.posisi > '.$artikel_detail[0]["posisi"].' order by a.posisi ASC limit 0,1';
                $query_next = 'SELECT a.posisi,a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.posisi > "'.$artikel_detail[0]["posisi"].'" AND a.title != "" AND (c.idpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,2';
                $artikel_next = $this->db->query($query_next_new)->result_array();
                $this->data['next'] = $artikel_next;
                //echo $query_next_new;
            }
            $bread = "";
            $data_bread = $this->pages_parent($this->idpages[0]->parent);
            if ($data_bread != ""){
                if ($this->pages_parent($this->idpages[0]->parent) != "0"){
                    $breadarray = explode(";",$this->pages_parent($this->idpages[0]->parent));
                    $bread = "<a href='".base_url($breadarray[1])."'>".$breadarray[0]."</a>";
                }
            }
            $this->data['link_page'] = $this->idpages[0]->link;
            $this->data['current_page_id'] = $this->idpages[0]->id;
            $this->data['link'] = $this->link;
            $this->data['current_page'] = $this->idpages[0]->title;
            $this->data['parent_breadcrumb'] = $bread;
            $this->data['meta_title'] = $artikel_detail[0]["title"];
            if($artikel_detail[0]["meta_title"] != ""){
                $this->data['meta_title'] = $artikel_detail[0]["meta_title"];
            }
            $this->data['meta_description'] = strip_tags($artikel_detail[0]["description"]);
            if($artikel_detail[0]["meta_description"] != ""){
                $this->data['meta_description'] = $artikel_detail[0]["meta_description"];
            }
            $this->load->view('detailnews',$this->data);
        }else{
            $limit = 8;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            /*$record = $this->idpages[0]->record;
            if ($record > 0){
                $query_others = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages,(select pages.title FROM pages where record = a.idmenu) as cat FROM infographic a LEFT JOIN pages b ON b.id='.$this->idpages[0]->id.' WHERE a.idmenu='.$this->idpages[0]->record.' AND a.hapus=0 AND a.deleted=0 order by a.cretime  DESC LIMIT  '.$start.','.$limit;
                $query_others_count = 'SELECT * FROM infographic WHERE idmenu='.$this->idpages[0]->record.' AND hapus=0 AND deleted=0 order by cretime DESC ';
                $this->idpages_sub = $this->db->query('SELECT record,meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
                $this->toppages = $this->db->query('SELECT record,meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.id = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
                $this->data['subnews']        = $this->idpages_sub;
                $this->data['allpage_link']        = $this->toppages[0]->link;
            }else{
                
                $query_others = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages,(select pages.title FROM pages where record = a.idmenu) as cat,(select pages.link FROM pages where record = a.idmenu) as link_pages FROM infographic a LEFT JOIN pages b ON b.id='.$this->idpages[0]->id.' WHERE a.hapus=0 AND a.deleted=0 order by a.cretime  DESC LIMIT  '.$start.','.$limit;
                //echo $query_others;
                $query_others_count = 'SELECT * FROM infographic WHERE hapus=0 AND deleted=0  order by cretime DESC ';
                $this->idpages_sub = $this->db->query('SELECT record,meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$this->idpages[0]->id.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
                $this->data['subnews']        = $this->idpages_sub;
                $this->data['allpage_link']        = $this->idpages[0]->link;
            }*/
            
            
            $query_others = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages,b.title as cat,b.link as link_pages FROM galeri a LEFT JOIN pages b ON b.id=a.cat WHERE a.hapus=0 AND a.deleted=0 AND a.cat='.$this->idpages[0]->id.' order by a.cretime  DESC LIMIT  '.$start.','.$limit;
                //echo $query_others;
                $query_others_count = 'SELECT a.*,DATE_FORMAT(a.cretime,"%d %M %Y") AS datenya,b.link as link_pages,b.title as cat,b.link as link_pages FROM galeri a LEFT JOIN pages b ON b.id=a.cat WHERE a.hapus=0 AND a.deleted=0 AND a.cat='.$this->idpages[0]->id.' order by a.cretime  DESC';
                $this->idpages_sub = $this->db->query('SELECT record,meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
                $this->data['subnews']        = $this->idpages_sub;
                $this->toppages = $this->db->query('SELECT record,meta_title,meta_description,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.id = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
                //echo $query_others_count;
                //print_r('SELECT * FROM pages WHERE parent = '.$this->idpages[0]->id);
                $this->data['allpage_link']        = $this->toppages[0]->link;
            //echo $query_others;
                
                $data_rec = $this->db->query($query_others)->result_array();  
                //echo "<pre>";
                //print_r($data_rec);
                
                
                $data_rec_count = $this->db->query($query_others_count)->result_array();
                $pengurangan = ($page - 1);
                $urut = count($data_rec_count) - $pengurangan;
                $query_string = $_GET;
                if (isset($query_string['page']))
                {
                    unset($query_string['page']);
                }  
                $config['uri_segment'] = 4;
                $config['first_link'] = false;
                $config['last_link'] = false;       
                $config['uri_segment'] = 4;
                $config['base_url'] = base_url($this->data['codebahasa'].$this->idpages[0]->link);
                $config['total_rows'] = count($data_rec_count);
                $config['per_page'] = $limit;        
                $config['full_tag_open'] = '<div id="pagination" class="pagination_wrap pagination_pages">';
                $config['full_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<span class="pager_current active ">';
                $config['cur_tag_close'] = '</span>';
                $config['next_link'] = '&gt;';
                $config['prev_link'] = '&lt;';
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
            $this->load->view('galeri',$this->data);
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