<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->linkCatPromo =  isset($this->segs[2]) ? $this->segs[2] : '';
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
                $this->linkCatPromo =  isset($this->segs[3]) ? $this->segs[3] : '';
            }
        }        
        $this->idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        $this->data['description'] = "";
        $this->data['menu'] = $this->db->query('SELECT pages.id,pages.title,pages.link,parent,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = 0 AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi asc')->result_array();
        $this->data['lang_code'] = $this->idpages[0]->lang_code;
        if($this->idpages[0]->use_default == 0){
            $this->data['codebahasa'] = $this->idpages[0]->lang_code.'/';
        }else{
            $this->data['codebahasa'] = '';
        } 
    }
    public function index(){
        $this->data['controller']=$this; 
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $this->idpages[0]->title;
        $this->data['current_parent_page'] = str_replace('<br>', ' ', $this->pages_parent($this->idpages[0]->parent));
        $this->data['link'] = $this->link;
        $this->data['sidemenu'] = $this->sidemenu($this->idpages[0]->parent);
        
        $wLang = "and idlanguage = " . $this->idpages[0]->idlang . " ";
        $wDef  = "WHERE draft = 0 AND hapus=0 ".$wLang;
        $this->data['promoCategory'] = $this->db->query('SELECT id, title, description, sister, link FROM promotion_category '.$wDef.' order by title')->result_array();
        $this->data['promoBanner']   = $this->db->query('SELECT id, title, description, pic, link FROM promotion_banner '.$wDef.' order by title')->result_array();
        if(empty($this->linkCatPromo)) $this->linkCatPromo = $this->data['promoCategory'][0]['link'];
        
        $this->data['catActive'] = $this->linkCatPromo;
        $page   = isset($_GET['p']) ? $_GET['p'] : 1;
        $limit  = 4;
        $offset = ($page - 1) * $limit;
        $wLimit = "limit " . $limit . " offset " . $offset;
        $query  = 'SELECT id, title, sub_title, description, pic, thumb FROM promotion '.$wDef.' and category=(select sister from promotion_category where link = "'.$this->linkCatPromo.'") order by title '.$wLimit;
        //die($query);
        $this->data['promo'] = $this->db->query($query)->result_array();
        $this->data['page']  = $page;
        //print_r($this->data['promo']); die($this->data['promo'][0]['id']);
        if(isset($_GET['data']) && $_GET['data'] == 'json') { echo json_encode($this->data['promo']); die(); }
        $this->load->view('promotion',$this->data);
    }
    
    function sidemenu($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return $sidemenunya;
    }
    
    function pages_parent($parent){
        $idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        return $idpages[0]->title;
    
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
                    if ($this->link_bahasa == ""){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->link)."/".$this->segs[2])."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->link))."\">".$mn["title"]."</a>";
                    }
                }
                if (count($this->segs) == 1){
                    if ($this->link_bahasa == ""){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url($this->segs[1])."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url()."\">".$mn["title"]."</a>";
                    }
                }
                if (count($this->segs) == 3){
                    $htmlString .= "<a href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->link)."/".$this->getCatOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                }
            }else{
                if (count($this->segs) == 2) {
                    /*ada code lang bahasa dan di halaman selain home */
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link)."/".$this->getCatOtherLang($mn["id"],$this->segs[2]))."\">".$mn["title"]."</a>";
                    }
                }else{
                    if (count($this->segs) == 3){
                        if ($mn["lang_code"] == $codelang[0]->lang_code){
                            $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getCatOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                        }else{
                            if (isset($this->segs[1])){
                                if (isset($this->segs[2])){
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getCatOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                                }else{
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1])."/".$this->getCatOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                                }
                            }else{
                                $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                            }
                        }
                    }else{
                        if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                            $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                        }else{
                            if (isset($this->segs[1])){
                                if (isset($this->segs[2])){
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2]))."\">".$mn["title"]."</a>";
                                }else{
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1]))."\">".$mn["title"]."</a>";
                                }
                            }else{
                                $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                            }
                        }
                    }
                    
                }
            }
            if ($konter < $countmenu){
                $htmlString .= "<span>|</span>";
            }
            $konter++;
        }
        return $htmlString;
    }
    
    function getReportOtherLang($idlang,$link){
        $pagenya = $this->db->query('SELECT a.title,id FROM promotion_category a WHERE a.id = (SELECT id FROM `promotion_category` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'')->result_array();
        return $pagenya[0]["id"];
    }
    
    function getCatOtherLang($idlang, $link){
        $pagenya = $this->db->query('SELECT title, link FROM promotion_category WHERE sister = (SELECT sister FROM `promotion_category` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'')->result_array();
        return $pagenya[0]["link"];
    }        
    
}
