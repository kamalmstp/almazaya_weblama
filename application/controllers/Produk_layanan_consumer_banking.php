<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Produk_layanan_consumer_banking extends Base_Controller {
    public function __construct(){
        parent::__construct(); 
        
        $this->idpages = $this->db->query('SELECT pages.link,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->segs[count($this->segs)].'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        if (count($this->idpages) == 0){
            $this->idpages = $this->db->query('SELECT pages.link,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->segs[count($this->segs)-1].'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        }
        //echo 'SELECT pages.link,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->segs[count($this->segs)].'" AND language.lang_code = "'.$this->bahasa.'"';
        $this->data['description'] = "";
        $this->data['menu'] = $this->db->query('SELECT pages.id,pages.title,pages.link,parent,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = 0 AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi asc')->result_array();
        $this->data['lang_code'] = $this->idpages[0]->lang_code;
        if($this->idpages[0]->use_default == 0){
            $this->data['codebahasa'] = $this->idpages[0]->lang_code.'/';
            $this->lang->load($this->idpages[0]->lang_code, 'other');
            if (!isset($this->segs[3])){
                $this->cekHasSubmenu();
                $this->parameter = $this->segs[2];
            }else{
                $this->parameter = $this->segs[3];
            }
            
            
        }else{ 
            $this->data['codebahasa'] = '';
            $this->lang->load($this->idpages[0]->lang_code, 'default');
            if (!isset($this->segs[2])){
                $this->cekHasSubmenu();
                $this->parameter = $this->segs[1];
                
            }else{
                $this->parameter = $this->segs[2];
            }
            
        } 
        
    }
    public function index(){
        
        
        //$link = $this->segs[count($this->segs)];
        
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
        $this->data['current_sister'] = $this->idpages[0]->sister;
        $this->data['current_parent_page'] = $this->pages_parent($this->idpages[0]->parent);
        $this->data['link'] = $this->link;
        $this->data['sidemenu'] = $this->sidemenu($this->idpages[0]->parent);
        $rec = $this->db->query('SELECT a.* FROM list_produk_service a WHERE a.idpages = "'.$this->idpages[0]->sister.'" AND a.idlanguage = "'.$this->idpages[0]->idlang.'" AND a.link = "'.$this->parameter.'"')->result();
        $this->data['rec'] = $rec;
        


        $rec_all = $this->db->query('SELECT a.* FROM list_produk_service a WHERE a.idpages = "'.$this->idpages[0]->sister.'" AND a.idlanguage = "'.$this->idpages[0]->idlang.'" AND a.hapus = 0 AND a.draft = 0  order by a.posisi asc')->result();
        $this->data['rec_all'] = $rec_all;
        
        $rec_other = $this->db->query('SELECT a.* FROM list_produk_service a WHERE a.idlanguage = "'.$this->idpages[0]->idlang.'" AND a.idpages='.$this->idpages[0]->sister)->result();
        $this->data['rec_other'] = $rec_other;
        // echo "<pre>";
        // print_r($rec_all);
        // die();
        $this->load->view('produk_layanan_consumer_banking',$this->data);
    }
    
    function pages_parent($parent){
        $idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        return $idpages[0]->title;
    
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
    function cekHasSubmenu(){
        $idpages = $this->db->query('SELECT a.* FROM list_produk_service a WHERE a.idpages = "'.$this->idpages[0]->sister.'" AND a.idlanguage = "'.$this->idpages[0]->idlang.'"')->result();
        //echo 'SELECT a.* FROM list_produk_service a WHERE a.idpages = "'.$this->idpages[0]->sister.'" AND a.idlanguage = "'.$this->idpages[0]->idlang.'"';
        //print_r(count($idpages));
        if (count($idpages) > 0){
            redirect($this->data['codebahasa'].$this->link."/".$idpages[0]->link, 'refresh');
        }
    }
    function sidemenu($parent){
        $sidemenunya = $this->db->query('SELECT pages.parent,pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        
        
        if(count($sidemenunya) > 0){
            if ($sidemenunya[0]->parent != 0){
                $sidemenunya = $this->db->query('SELECT pages.parent,pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
                
                if ($sidemenunya[0]->parent != 0){
                    $sidemenunya = $this->db->query('SELECT pages.parent,pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$sidemenunya[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
                    
                }
            }
        }
        
        if ($sidemenunya[0]->parent == 0){
            $sidemenunya = $this->db->query('SELECT pages.parent,pages.title,pages.link,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default,(SELECT count(*) FROM pages a INNER JOIN language on a.idlanguage=language.id WHERE a.parent = pages.sister AND language.lang_code = "'.$this->bahasa.'") AS total FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$sidemenunya[0]->sister.'" AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi ASC')->result();
        }
        //echo "<pre>";
//        print_r($sidemenunya);
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
                        $htmlString .= "<a class=\"aktif-bahasa\" href=\"".base_url("".$mn["lang_code"]."/".$this->getMenuOtherLang($mn["id"],$this->link))."\">".$mn["title"]."</a>";
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
    function getReportOtherLang($idlang,$link){
        //echo 'SELECT a.title,link FROM hubungan_investor a WHERE a.sister = (SELECT sister FROM `hubungan_investor` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'';
        //die();
        //$pagenya = $this->db->query('SELECT a.title,link FROM hubungan_investor a WHERE a.sister = (SELECT sister FROM `hubungan_investor` WHERE `link` LIKE "'.$link.'") AND idlanguage = '.$idlang.'')->result_array();
        //return $pagenya[0]["link"];
    }
    function save_pengaduan_nasabah(){
        session_start();
        //echo "<pre>";
        //print_r($_SESSION);
        //print_r($_FILES);
        if ($_POST["nama"] != "" && $_POST["alamat_email"] != "" && $_POST["alamat_domisili"] != "" && $_POST["telepon_rumah"] != "" && $_POST["telepon_selular"] != "" && $_POST["nasabah_muamalat"] != "" && $_POST["jenis_pertanyaan"] != "" && $_POST["masalah"] != ""){
            if ($_POST["captcha"] == $_SESSION["captcha"]){
            
                $new_file_name = "";
                if (isset($_FILES)){
                    $filenameold   = strtolower($_FILES['file']['name']);
                    $random_digit  = date("YmdHis");
                    $new_file_name =  $random_digit."_".$filenameold;
                    move_uploaded_file($_FILES['file']['tmp_name'],FCPATH.'/uploads/pengaduan_nasabah/'.$new_file_name);
                }
                
                $inputdata = array(    
                    'cretime'    => date('Y-m-d H:i:s'),
                    'nama' => $_POST["nama"],
                    'email' => $_POST["alamat_email"],
                    'alamat_domisili' => $_POST["alamat_domisili"],
                    'telepon_rumah' => $_POST["telepon_rumah"],
                    'telepon_selular' => $_POST["telepon_selular"],
                    'sudah_menjadi_nasabah' => $_POST["nasabah_muamalat"],
                    'tipe_pertanyaan' => $_POST["jenis_pertanyaan"],
                    'isi_masalah' => $_POST["masalah"],
                    'file' => $new_file_name
                );   
                $saved = $this->db->insert('pengaduan_nasabah', $inputdata);
                $insert_id = $this->db->insert_id();
                echo $insert_id;
            }else{
                echo 0;
            }
        }
        
    }
}