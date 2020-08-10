<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hubungan_investor extends Base_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        //echo count($this->segs);
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        $idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.parent,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
      
        
        $this->data['description'] = "";
        $this->data['menu'] = $this->db->query('SELECT pages.id,pages.title,pages.link,parent,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = 0 AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi asc')->result_array();
        
        if($idpages[0]->use_default == 0){
            $this->data['codebahasa'] = $idpages[0]->lang_code.'/';
            if (!isset($this->segs[3])){
                $sqlwhere = "hapus = 0 and draft = 0";
                $data_rec = $this->db->query('SELECT title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
                if (count($data_rec) > 0){
                    redirect(base_url($idpages[0]->lang_code.'/'.$this->segs[2]."/".$data_rec[0]["link"]), 'refresh');
                }
            }else{
                $sqlwhere = "hapus = 0 and draft = 0 AND link='".$this->segs[3]."'";
                $data_rec = $this->db->query('SELECT id,title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
                if (count($data_rec) > 0){
                    $this->data['current_link'] = $data_rec[0]["link"];
                    $this->data['current_menu'] = $data_rec[0]["title"];
                    $this->data['description'] = $data_rec[0]["description"];
                    $id_report = $data_rec[0]["id"];
                }
            }
        }else{
            $this->data['codebahasa'] = '';
            if (!isset($this->segs[2])){
                $sqlwhere = "hapus = 0 and draft = 0 ";
                $data_rec = $this->db->query('SELECT title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
                if (count($data_rec) > 0){
                    redirect(base_url($this->segs[1]."/".$data_rec[0]["link"]), 'refresh');
                }
            }else{
                $sqlwhere = "hapus = 0 and draft = 0 AND link='".$this->segs[2]."'";                
                $data_rec = $this->db->query('SELECT id,title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
                if (count($data_rec) > 0){
                    $this->data['current_link'] = $data_rec[0]["link"];
                    $this->data['current_menu'] = $data_rec[0]["title"];
                    $this->data['description'] = $data_rec[0]["description"];
                    $id_report = $data_rec[0]["id"];
                }
            }
        }   
        $sqlwhere = "hapus = 0 and draft = 0 ";
        $data_rec_child = $this->db->query('SELECT id,title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent = '.$id_report.' order by posisi asc')->result_array();
        $this->data['rec_child'] = $data_rec_child;
        
        
        
        
        $data_rec = $this->db->query('SELECT id,title,description,link,sister FROM `hubungan_investor` where idlanguage = '.$idpages[0]->idlang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
        $this->data['rec'] = $data_rec;
        
        
        
        
        $data_rec_report = $this->db->query('SELECT title,file FROM hubungan_investor_report WHERE idlanguage = '.$idpages[0]->idlang.' AND id_hubungan_investor='.$id_report)->result_array();
        
        $this->data['controller']=$this; 
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$idpages[0]->sister)->result_array();
        $this->data['langnow'] = $idpages[0]->idlang;
        $this->data['current_page'] = $idpages[0]->title;
        $this->data['link'] = $this->link;
        $this->data['sidemenu'] = $this->sidemenu($idpages[0]->parent);
        $this->data['report'] = $data_rec_report;
        $this->load->view('hubungan_investor',$this->data);
    }
    function sidemenu($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return $sidemenunya;
    }
    function getChild($parent){
        $sidemenunya = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        return count($sidemenunya);
    }
    function show_child_level3($uid){
        
        $data_rec_child_report = $this->db->query('SELECT a.title,a.file FROM hubungan_investor_report a INNER JOIN language b on a.idlanguage=b.id WHERE  b.lang_code = "'.$this->bahasa.'" AND a.id_hubungan_investor='.$uid)->result_array();  
        //print_r($data_rec_child_report);
        return $data_rec_child_report;
        //echo 'SELECT title,file FROM hubungan_investor_report WHERE idlanguage = '.$idpages[0]->idlang.' AND id_hubungan_investor='.$uid;
        //return $data_rec_child_report;
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
                    $htmlString .= "<a href=\"".base_url($this->getMenuOtherLang($mn["id"],$this->link)."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                }
            }else{
                if (count($this->segs) == 2) {
                    /*ada code lang bahasa dan di halaman selain home */
                    if ($mn["lang_code"] == substr($this->link_bahasa, 0, -1)){
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."")."\">".$mn["title"]."</a>";
                    }else{
                        $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link)."/".$this->getReportOtherLang($mn["id"],$this->segs[2]))."\">".$mn["title"]."</a>";
                    }
                }else{
                    if (count($this->segs) == 3){
                        if ($mn["lang_code"] == $codelang[0]->lang_code){
                            $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                        }else{
                            if (isset($this->segs[1])){
                                if (isset($this->segs[2])){
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[2])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
                                }else{
                                    $htmlString .= "<a href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->segs[1])."/".$this->getReportOtherLang($mn["id"],$this->segs[3]))."\">".$mn["title"]."</a>";
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
    function javascript(){
        
    }
    function getReportOtherLang($idlang,$link){
        $pagenya = $this->db->query('SELECT a.title,link FROM hubungan_investor a WHERE a.sister = (SELECT sister FROM `hubungan_investor` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'')->result_array();
        return $pagenya[0]["link"];
    }
}