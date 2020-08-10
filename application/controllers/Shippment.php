<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Shippment extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->idpages = $this->db->query('SELECT pages.posisi,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.link = "'.$this->link.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        
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
        $this->key = 'eternaleaf-olshp';
        $this->data['key'] = $this->key;
        $this->load->library('encrypt');
    }
   
    public function index(){
        $data_session = $this->session->all_userdata();
        $session_data = $this->session->userdata('cart');
        //echo "<pre>";
        //print_r($data_session);
        if (!isset($data_session["cart"])){
            $menu_shopping_bag = $this->db->query('SELECT link FROM pages WHERE idmodule = 48 AND idlanguage = '.$this->idpages[0]->idlang)->result_array();
            if (count($menu_shopping_bag) > 0){
                //$this->data["menu_forgot"] = $menu_shopping_bag[0]["link"];  
                redirect(base_url($this->data['codebahasa'].$menu_shopping_bag[0]["link"]), 'refresh');
            }
        }
        if (isset($_GET["ceksession"])){
            echo "<pre>";
            print_r($data_session);
            die();
        }
        
        $this->data['aksi'] = "default";
        
        if (isset($this->segs) == 3 ){
            $codelang = $this->db->query('SELECT lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->bahasa = $codelang[0]->lang_code;
                $this->link = $this->segs[2];
            }
        }
        
        $this->data['lang'] = $this->db->query('SELECT language.id, language.title, language.lang_code, language.pic, language.use_default, pages.link FROM `language` INNER JOIN pages on pages.idlanguage=language.id WHERE pages.sister = '.$this->idpages[0]->sister)->result_array();
        $this->data['langnow'] = $this->idpages[0]->idlang;
        $this->data['current_page'] = $this->idpages[0]->title;
        $this->data['current_link_page'] = $this->idpages[0]->link;
        $this->data['content'] = $this->idpages[0]->content;
        $this->data['sisterpage'] = $this->idpages[0]->sister;
        
        $this->data['link'] = $this->link;
        
        
        $this->nextpages = $this->db->query('SELECT pages.parent,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'" AND pages.posisi > '.$this->idpages[0]->posisi. ' LIMIT 0,1')->result();
//        echo "<pre>";
//        print_r($this->nextpages);
        $this->data["next_pages"] = $this->nextpages[0]->link;
        $this->prevpages = $this->db->query('SELECT pages.parent,pages.link,pages.pic,pages.content,pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,pages.parent,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.parent = "'.$this->idpages[0]->parent.'" AND language.lang_code = "'.$this->bahasa.'" AND pages.posisi < '.$this->idpages[0]->posisi. ' LIMIT 0,1')->result();
//        echo "<pre>";
//        print_r($this->nextpages);
        $this->data["prev_pages"] = $this->prevpages[0]->link;
        
        $this->data["parameter"] = $this->parameter;
        $data["active"] = "all";
        $this->data['title_page'] = $this->idpages[0]->title;
        
        
        
        
        
        
        if (!isset($data_session["login_user"]["eternaleaf_user_login"])){
            if ($this->data['codebahasa'] == ""){
                redirect(base_url($this->data['codebahasa']."login"), 'refresh');
            }else{
                redirect(base_url($this->data['codebahasa']."masuk"), 'refresh');
            }
            
        }
        $query_account = $this->db->query('SELECT a.* FROM account a WHERE a.uid = '.$data_session["login_user"]["eternaleaf_user_login"])->result_array();;
        $this->data["account"] = $query_account;
        
        $query_alamat = $this->db->query('SELECT a.*,b.province,c.city_name,d.subdistrict_name,e.telepon as telepon_utama FROM address a LEFT JOIN province b ON a.uid_province=b.province_id LEFT JOIN city c ON a.uid_city=c.city_id LEFT JOIN subdistrict d ON a.uid_subdistrict=d.subdistrict_id LEFT JOIN account e ON a.uid_account=e.uid WHERE a.uid_account = '.$data_session["login_user"]["eternaleaf_user_login"].' AND a.default=1')->result_array();;
        $this->data["alamat"] = $query_alamat;
        if (count($query_alamat) > 0){
            $this->session->userdata['uid_shipping'] = $query_alamat[0]["uid"];
        }
        
        $query_alamat_other = $this->db->query('SELECT a.*,b.province,c.city_name,d.subdistrict_name,e.telepon as telepon_utama,e.fullname FROM address a LEFT JOIN province b ON a.uid_province=b.province_id LEFT JOIN city c ON a.uid_city=c.city_id LEFT JOIN subdistrict d ON a.uid_subdistrict=d.subdistrict_id LEFT JOIN account e ON a.uid_account=e.uid WHERE a.uid_account = '.$data_session["login_user"]["eternaleaf_user_login"])->result_array();;
        $this->data["other_alamat"] = $query_alamat_other;
        
        
        //echo "<pre>";
//        print_r($query_alamat);
//        die();
        
        if (isset($session_data['id_cart'])){
            $query = 'SELECT a.uid as id_detail,IFNULL(sum(a.qty),0) as totalnya,b.weight,b.title,b.pic,b.price,(b.price * sum(a.qty)) as totalharga,b.sister as sisterproduk FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data['id_cart'].' AND b.idlanguage=1 GROUP BY a.uid_produk';
            $top = $this->db->query($query)->result_array(); 
            if (count($top)){
                $no = 0;
                $harga  = 0;
                $total_weight = 0;
                foreach ($top as $dt){
                    $top[$no]["id_detail"] = $dt["id_detail"];
                    $top[$no]["totalnya"] = $dt["totalnya"];
                    $top[$no]["title"] = $dt["title"];
                    $top[$no]["pic"] = $dt["pic"];
                    $top[$no]["price"] = $dt["price"];
                    $top[$no]["totalharga"] = $dt["totalharga"];
                    $harga = (int)$dt["totalharga"] + $harga;
                    
                    $top[$no]["totalhargaall"] = $harga;
                    $top[$no]["weightnya"] = $dt["totalnya"] * $dt["weight"];
                    $total_weight = ((int)$dt["totalnya"] * $dt["weight"]) + $total_weight;
                    $top[$no]["total_weightnya"] = $total_weight;
                    $no++;
                    
                } 
                $no = $no - 1;
                //echo "<pre>";
                //print_r($top);
                $this->data["cart"] = $top;
                $this->data["totalhargaall"] = $top[$no]["totalhargaall"];
                $this->data["totalweightall"] = $top[$no]["total_weightnya"];
                $this->data["ongkir"] = "";
                $this->data["etd"] = "";
                if (count($query_alamat) > 0){
                    $ongkirnya = $this->ongkir($top[$no]["total_weightnya"],$query_alamat[0]["uid_subdistrict"]);
                    
                    //print_r($ongkirnya);
                    $this->data["ongkir"] = $ongkirnya[0]["value"];
                    $this->data["etd"] = $ongkirnya[0]["etd"];
                    $this->session->userdata['jne']['ongkir'] = $ongkirnya[0]["value"];
                    $this->session->userdata['jne']['etd'] = $ongkirnya[0]["etd"];
                    $this->session->userdata['jne']['tujuan'] = $query_alamat[0]["uid_subdistrict"];
                }
                
                
                
                //print_r($this->ongkir($top[$no]["total_weightnya"],$query_alamat[0]["uid_subdistrict"]));
                //die();
            }
            
        }
        
        
//        echo "<pre>";
//        print_r($data_session);
//        

        $this->load->view('shippment',$this->data);
    }
    /*function ongkir($weight,$uid_subdistrict){
        $getorigin = $this->getorigin();
        $uid_subdistrict = $uid_subdistrict;
        $weight = $weight;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://cdlab.co/rajaongkir/cekongkir.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "getorigin=$getorigin&uid_subdistrict=$uid_subdistrict&weight=$weight",
          
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        
        //echo "<pre>";
        //print_r($data);
        return $data;
    }*/
    function ongkir($weight,$uid_subdistrict){
        $getorigin = $this->getorigin();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$getorigin&originType=city&destination=$uid_subdistrict&destinationType=subdistrict&weight=$weight&courier=jne",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 83d0bea707a458d2ca3ed9c23498e9cb"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        //echo "<pre>";
        //print_r($data);
        $key = array_search("REG", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        if ($key == ""){
            $key = array_search("CTC", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        }
        return $data["rajaongkir"]["results"][0]["costs"][$key]["cost"];
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
        $idpages = $this->db->query('SELECT pages.title,pages.id,language.id as idlang,pages.sister,pages.idmodule,language.lang_code,language.use_default FROM pages INNER JOIN language on pages.idlanguage=language.id WHERE pages.sister = "'.$parent.'" AND language.lang_code = "'.$this->bahasa.'"')->result();
        return $idpages[0]->title;
    
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