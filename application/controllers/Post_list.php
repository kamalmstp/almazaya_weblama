<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Post_list extends Base_Controller {

    public function __construct(){

        parent::__construct();

        $this->idpages = $this->db->query('SELECT pages.title,pages.meta_title,pages.meta_description,pages.pic,pages.link,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();

        

//        echo "<pre>";

//        print_r($this->idpages);

        

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

            $this->data['other_article'] = $this->idpages[0]->title." Lainnya";

        }else{

            $this->data['codebahasa'] = '';

            $this->lang->load($this->idpages[0]->lang_code, 'other');

            if (isset($this->segs[2])){

                $this->parameter = $this->segs[2];

                $this->category = $this->segs[1];

            }

            

            $this->data['other_article'] = "Other ".$this->idpages[0]->title;

        } 

        $this->output->nocache();

        //$this->output->clear_all_cache();

    }

   

    public function index(){

        $this->data['aksi'] = "default";

        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();

        $this->data['langnow'] = $this->idpages[0]->idlang;

        $this->data['current_page'] = $this->idpages[0]->title;

        $this->data['description'] = $this->idpages[0]->content;

        $this->data['sisterpage'] = $this->idpages[0]->sister;

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

            $query_detail = 'SELECT a.show,a.use_top_banner,a.link_ads_banner_top,a.ads_banner_top,a.ads_banner_top_m,a.use_bottom_banner,a.link_ads_banner_bottom,a.ads_banner_bottom,a.ads_banner_bottom_m,a.ads_side_banner,a.link_ads_banner,a.use_side_banner,a.meta_title,a.meta_description,a.link,a.id,DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.idlanguage,a.posisi,a.title,a.pic2,a.description,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.link LIKE "'.$this->parameter.'" AND d.idlanguage = '.$this->idpages[0]->idlang;

            $artikel_detail = $this->db->query($query_detail)->result_array();

            $this->data['detail'] = $artikel_detail;

            

            if($artikel_detail[0]["show"] == 0){

                header("HTTP/1.1 301 Moved Permanently"); 

                header("Location: https://www.eternaleaf.com"); 

            }

            

            $query_top = 'SELECT a.ads_side_banner,a.link_ads_banner,a.use_side_banner,a.sister as sisternya,DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,b.title as title_cat,c.link as link_detail from artikel a LEFT JOIN kategori_artikel b ON a.cat=b.sister LEFT JOIN pages c ON b.sisterpages=c.sister WHERE  a.deleted=0 AND a.hidden=0 AND a.show=1 AND   a.idlanguage = '.$this->idpages[0]->idlang.' AND ((c.sister='.$this->idpages[0]->sister.')  OR  (b.otherpages LIKE "'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "'.$this->idpages[0]->sister.',%"))  AND b.idlanguage='.$this->idpages[0]->idlang.' AND c.idlanguage = '.$this->idpages[0]->idlang.' order by a.posisi DESC LIMIT 0,3';

            $topnews = $this->db->query($query_top)->result_array();  

            $this->data["recent_post"] = $topnews;

            

            

            $data_rec_ads_banner_global = $this->db->query('SELECT * FROM `ads_banner_side` WHERE  idlanguage = '.$this->idpages[0]->idlang.'')->result_array();  

            $this->data['rec_ads_banner_global'] = $data_rec_ads_banner_global;

            

            $data_rec_ads_banner_top = $this->db->query('SELECT * FROM `ads_banner_top` WHERE  idlanguage = '.$this->idpages[0]->idlang.'')->result_array();  

            $this->data['rec_ads_banner_top'] = $data_rec_ads_banner_top;

            

            $data_rec_ads_banner_bottom = $this->db->query('SELECT * FROM `ads_banner_bottom` WHERE  idlanguage = '.$this->idpages[0]->idlang.'')->result_array();  

            $this->data['rec_ads_banner_bottom'] = $data_rec_ads_banner_bottom;

            

            $query_others = 'SELECT a.ads_side_banner,a.link_ads_banner,a.use_side_banner,a.sister as sisternya,DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,b.title as title_cat,c.link as link_detail from artikel a LEFT JOIN kategori_artikel b ON a.cat=b.sister LEFT JOIN pages c ON b.sisterpages=c.sister WHERE a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND ((b.sister='.$this->idpages[0]->sister.')  OR  (b.otherpages LIKE "'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "'.$this->idpages[0]->sister.',%"))  AND b.idlanguage='.$this->idpages[0]->idlang.' AND c.idlanguage = '.$this->idpages[0]->idlang.' AND a.show=1 order by a.posisi DESC LIMIT 3,4';

            $othernews = $this->db->query($query_others)->result_array();  

            $this->data["other_post"] = $othernews;

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

            $limit = 6;

            $query = 'SELECT a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.sisterpages=d.sister AND d.idlanguage = '.$this->idpages[0]->idlang.' where a.deleted=0 AND a.hapus=0 AND a.show=1 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.posisi DESC limit 0,'.$limit;

            

            $artikel = $this->db->query($query)->result_array();

            $count_artikel = $this->db->query('SELECT count(*) as total FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.sisterpages=d.sister where a.deleted=0 AND a.show=1 AND a.hapus=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") order by a.crdate_set ASC')->result_array();

            $this->data['rec_artikel'] = $artikel;

            $this->data['total_artikel'] = $count_artikel[0]["total"];

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

            

            $query_top = 'SELECT a.sister as sisternya,DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,b.title as title_cat,c.link as link_detail from artikel a LEFT JOIN kategori_artikel b ON a.cat=b.sister LEFT JOIN pages c ON b.sisterpages=c.sister WHERE a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND ((b.sisterpages='.$this->idpages[0]->sister.')  OR  (b.otherpages LIKE "'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR b.otherpages LIKE "'.$this->idpages[0]->sister.',%"))  AND b.idlanguage='.$this->idpages[0]->idlang.' AND c.idlanguage = '.$this->idpages[0]->idlang.' AND a.show=1 order by a.posisi DESC LIMIT 0,1';

            $topnews = $this->db->query($query_top)->result_array();  

            $this->data["topnews"] = $topnews;

            

            //echo "<pre>";

    //        print_r($query_top);

            

            if (count($topnews) > 0){

                $query_others = 'SELECT DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.sisterpages=d.sister AND d.idlanguage = '.$this->idpages[0]->idlang.' where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") AND a.sister != '.$topnews[0]["sisternya"].' AND a.show=1 order by a.posisi DESC LIMIT  '.$start.','.$limit;

                $query_others_count = 'SELECT DATE_FORMAT(crdate_set,"%d %M %Y") AS datenya,a.title,a.thumb,a.pic,a.cretime,a.description,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.sister AND c.idlanguage = '.$this->idpages[0]->idlang.'  LEFT JOIN pages d ON c.sisterpages=d.sister AND d.idlanguage = '.$this->idpages[0]->idlang.' where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$this->idpages[0]->idlang.' AND a.title != "" AND (c.sisterpages='.$this->idpages[0]->sister.'  OR  c.otherpages LIKE "'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "%,'.$this->idpages[0]->sister.'" OR c.otherpages LIKE "'.$this->idpages[0]->sister.',%") AND a.sister != '.$topnews[0]["sisternya"].' AND a.show=1 order by a.posisi';

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

            }

            $this->load->view('listnews',$this->data);

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