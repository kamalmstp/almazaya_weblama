<?php
class Base1_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->segs = $this->uri->segment_array();
        if (count($this->segs) == 0) {
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE use_default = 1')->result();
            $this->bahasa = $codelang[0]->lang_code;
            $this->link_bahasa = "";
            $this->link = '';
        } else {
            if (count($this->segs) == 2) {
                $this->bahasa = $this->segs[1];
                $this->link = $this->segs[2];
                $this->link_bahasa = $this->segs[1]."/";
            }elseif (count($this->segs) == 1) {
                $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                
                if (count($codelang) > 0){
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = $codelang[0]->lang_code . "/";
                    $this->link = "";
                }else{
                    $codelang = $this->db->query('SELECT lang_code FROM language WHERE use_default = 1')->result();
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = "";
                    $this->link = $this->segs[1];
                }
            }
        }  
        
        $this->data["controller"]  =  $this;
        $this->data["link_bahasa"]  =  $this->link_bahasa;    
    }
    function submenu($parent){
        $submenu = $this->db->query('SELECT pages.id,pages.title,pages.link,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = (SELECT sister FROM pages WHERE id='.$parent.') AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi asc')->result_array();
        $htmlString = "<ul class=\"submenu\">";
        foreach ($submenu as $submn){
            $htmlString .= "<li><a href=\"".base_url().$this->link_bahasa.$submn["link"]."\">".$submn["title"]."</a></li>";
        }
        $htmlString .= "</ul>";
        return $htmlString;
        
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
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->segs[2]))."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->segs[2]))."\">".$mn["title"]."</a>";
                    }
                }else{
                    if ($this->link_bahasa == ""){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url()."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url()."\">".$mn["title"]."</a>";
                    }
                }
                            
            }else{
                
                if (count($this->segs) == 2) {
                    
                    /*ada code lang bahasa dan di halaman selain home */
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                    }
                }else{
                    
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                    }else{
                        if (isset($this->segs[1])){
                            $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1]))."\">".$mn["title"]."</a>";
                        }else{
                            $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
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
    function getMenuOtherLang($idlanguage,$menu_current){
        $pagenya = $this->db->query('SELECT a.title,link FROM pages a WHERE a.sister = (SELECT sister FROM `pages` WHERE `link` LIKE "'.$menu_current.'") AND idlanguage = '.$idlanguage.'')->result_array();
        //print_r('SELECT a.title FROM pages a WHERE a.sister = (SELECT sister FROM `pages` WHERE `link` LIKE "'.$menu_current.'" AND idlanguage = '.$idlanguage.')');
        return $pagenya[0]["link"];
    }
}
?>