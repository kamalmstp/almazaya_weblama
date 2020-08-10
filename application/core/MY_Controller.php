<?php
class Base_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->library('session');
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";        
        preg_match("/[^\/]+$/", $actual_link, $matches);
        $last_word = $matches; // test
        if (count($last_word) == 0){
        }else{
            if(!$_GET){
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $actual_link/"); 
            }
        }
        $this->segs = $this->uri->segment_array();
        $this->link_bahasa = "";
        $this->link = '';
        if (count($this->segs) > 0) {
            $codelang = $this->db->query('SELECT lang_code,id FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
            if (count($codelang) > 0){
                $this->link_bahasa = $codelang[0]->lang_code."/";
                $this->link = $this->segs[1];
                $this->bahasa = $codelang[0]->lang_code;
            }else{
                $this->link_bahasa = "";
                $this->link = '';
                $this->bahasa = "";
            }
        } 
        if (count($this->segs) == 0) {
            $codelang = $this->db->query('SELECT lang_code,id FROM language WHERE use_default = 1')->result();
            $this->bahasa = $codelang[0]->lang_code;
            $this->link_bahasa = "";
            $this->link = '';
        } else {
            if (count($this->segs) == 2) {
                $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                if(count($codelang) == 0){
                    $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE use_default = 1')->result();
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link = $this->segs[1];
                    $this->link_bahasa = "";
                    $this->id_bahasa = $codelang[0]->id;
                }else{
                    $this->bahasa = $this->segs[1];
                    $this->link = $this->segs[2];
                    $this->link_bahasa = $this->segs[1]."/";
                    $this->id_bahasa = $codelang[0]->id;
                    $codelang1 = $this->db->query('SELECT * FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                    if ((trim($this->segs[1]) == trim($codelang1[0]->lang_code)) && $codelang1[0]->use_default == 1){
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".base_url()); 
                        die();
                    }
                }
            }elseif (count($this->segs) == 1) {
                $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                if (count($codelang) > 0){
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = $codelang[0]->lang_code . "/";
                    $this->link = "";
                    $this->id_bahasa = $codelang[0]->id;
                }else{
                    $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE use_default = 1')->result();
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = "";
                    $this->link = $this->segs[1];
                    $this->id_bahasa = $codelang[0]->id;
                }
            }
            elseif (count($this->segs) == 3) {
                $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                if (count($codelang) > 0){
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = $codelang[0]->lang_code . "/";
                    $this->link = $this->segs[2];
                    $this->id_bahasa = $codelang[0]->id;
                    $codelang1 = $this->db->query('SELECT * FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
                    if ((trim($this->segs[1]) == trim($codelang1[0]->lang_code)) && $codelang1[0]->use_default == 1){
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".base_url()); 
                        die();
                    } 
                }else{
                    $codelang = $this->db->query('SELECT id,lang_code FROM language WHERE use_default = 1')->result();
                    $this->bahasa = $codelang[0]->lang_code;
                    $this->link_bahasa = "";
                    $this->link = $this->segs[1];
                    $this->id_bahasa = $codelang[0]->id;
                }
            }
            //$codelang = $this->db->query('SELECT * FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
//             if ($codelang[0]->use_default == 1){
//                $this->link_bahasa = "";
//             }
        }
//        $codelang = $this->db->query('SELECT * FROM language WHERE lang_code = "'.$this->segs[1].'"')->result();
//         if ($codelang[0]->use_default == 1){
//            $this->link_bahasa = "";
//         }
        if(count($codelang) == 0){
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".base_url()); 
        }
        $this->id_bahasa = $codelang[0]->id;
        //print_r($this->id_bahasa);
        $title_footer = $this->db->query('SELECT title,description FROM content WHERE idmenu = 96')->result_array();
        $this->data['title_footer'] = $title_footer;
        $social_media = $this->db->query('SELECT * FROM socialmedia')->result_array();
        $this->data['socialmedia'] = $social_media;
        $alamat_sekolah = $this->db->query('SELECT title,description FROM content WHERE idmenu = 98')->result_array();
        $this->data['alamat_sekolah'] = $alamat_sekolah;
        $jam_sekolah = $this->db->query('SELECT title,description FROM content WHERE idmenu = 99')->result_array();
        $this->data['jam_sekolah'] = $jam_sekolah;
        $lokasi_footer = $this->db->query('SELECT address FROM location WHERE idmenu = 100')->result_array();
        $this->data['lokasi_footer'] = $lokasi_footer;
        $gallery = $this->db->query('SELECT * FROM infographic WHERE draft=0 AND hapus=0 LIMIT 0,6')->result_array();
        $this->data['gallery'] = $gallery;
        $this->data["id_lang"]  =  $this->id_bahasa;
        $this->data["controller"]  =  $this;
        $this->data["link_bahasa"]  =  $this->link_bahasa; 
        $this->data['menu'] = $this->db->query('SELECT a.idmodule,a.id,a.title,a.link,a.parent,language.lang_code,a.submenu,a.sister,(SELECT COUNT(*) FROM pages d WHERE a.sister=d.parent AND d.idlanguage=language.id) AS hasubmenu FROM pages a INNER JOIN language on a.idlanguage = language.id  WHERE a.parent = 0 AND a.hapus = 0 AND a.draft = 0 AND language.lang_code = "'.$this->bahasa.'" AND a.type=1 AND a.hide_in_menu=0 ORDER BY a.posisi asc')->result_array();
        $this->data['footer'] = $this->db->query('SELECT a.idmodule,a.id,a.title,a.link,a.parent,language.lang_code,a.submenu,a.sister,(SELECT COUNT(*) FROM pages d WHERE a.sister=d.parent AND d.idlanguage=language.id) AS hasubmenu FROM pages a INNER JOIN language on a.idlanguage = language.id  WHERE a.parent = 0 AND a.hapus = 0 AND a.draft = 0 AND language.id = "'.$codelang[0]->id.'" AND a.type=2 AND a.hide_in_menu=0 ORDER BY a.posisi asc')->result_array();
        //echo "<pre>";
        //print_r($this->data['menu']);
        $this->lang->load($codelang[0]->lang_code, 'other');
        //die();
    }
    function hari($hari){
        switch($hari){      
            case 0 : {
                        $hari='Minggu';
                    }break;
            case 1 : {
                        $hari='Senin';
                    }break;
            case 2 : {
                        $hari='Selasa';
                    }break;
            case 3 : {
                        $hari='Rabu';
                    }break;
            case 4 : {
                        $hari='Kamis';
                    }break;
            case 5 : {
                        $hari="Jum'at";
                    }break;
            case 6 : {
                        $hari='Sabtu';
                    }break;
            default: {
                        $hari='UnKnown';
                    }break;
        }
        return $hari;
    }
    function rupiah($angka)
    {
        $jadi = number_format($angka,0,',','.').",-";
        return $jadi;
    }
    function getorigin()
    {
        $hasil = 153;
        $origin = $this->db->query('SELECT city_id FROM shipping_origin WHERE uid=1')->result_array();
        if (count($origin) > 0){
            $hasil = $origin[0]["city_id"];
        }
        return $hasil;
    }
    function bulan($bulan)
    {
    Switch ($bulan){
        case 1 : $bulan="Januari";
            Break;
        case 2 : $bulan="Februari";
            Break;
        case 3 : $bulan="Maret";
            Break;
        case 4 : $bulan="April";
            Break;
        case 5 : $bulan="Mei";
            Break;
        case 6 : $bulan="Juni";
            Break;
        case 7 : $bulan="Juli";
            Break;
        case 8 : $bulan="Agustus";
            Break;
        case 9 : $bulan="September";
            Break;
        case 10 : $bulan="Oktober";
            Break;
        case 11 : $bulan="November";
            Break;
        case 12 : $bulan="Desember";
            Break;
        }
    return $bulan;
    }
    function submenu($parent){
        $submenu = $this->db->query('SELECT pages.idmodule,pages.id,pages.title,pages.link,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = (SELECT sister FROM pages WHERE id='.$parent.') AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" AND pages.hide_in_menu=0 ORDER BY pages.posisi asc')->result_array();
        $htmlString = "<ul class=\"dropdown-menu\">";
        foreach ($submenu as $submn){
            if ($submn["idmodule"] == 37){
                $htmlString .= "<li><a target='_blank'  href=\"".$submn["link"]."\">".$submn["title"]."</a></li>";
            }else{
                $htmlString .= "<li><a href=\"".base_url().$this->link_bahasa.$submn["link"]."\">".$submn["title"]."</a></li>";
            }
        }
        $htmlString .= "</ul>";
        return $htmlString;
    }
    function meta($title,$desc){
        $htmlstring = "<title>Prenagen - Frekuensi Hubungan Seks agar Cepat Hamil</title>";
        return $htmlstring;
    }
    function submenu_mobile($parent){
        $submenu = $this->db->query('SELECT pages.id,pages.title,pages.link,language.lang_code,pages.submenu FROM pages INNER JOIN language on pages.idlanguage = language.id WHERE pages.parent = (SELECT sister FROM pages WHERE id='.$parent.') AND pages.hapus = 0 AND pages.draft = 0 AND language.lang_code = "'.$this->bahasa.'" ORDER BY pages.posisi asc')->result_array();
        $htmlString = "<ul>";
        foreach ($submenu as $submn){
            $htmlString .= "<li><a href=\"".base_url().$this->link_bahasa.$submn["link"]."\">".$submn["title"]."</a></li>";
        }
        $htmlString .= "</ul>";
        return $htmlString;
    }
    function getMenuOtherLang($idlanguage,$menu_current){
        $pagenya = $this->db->query('SELECT a.title,link FROM pages a WHERE a.sister IN (SELECT sister FROM `pages` WHERE `link` LIKE "'.$menu_current.'" ) AND a.idlanguage = '.$idlanguage.'')->result_array();
        //print_r('SELECT a.title,link FROM pages a WHERE a.sister IN (SELECT sister FROM `pages` WHERE `link` LIKE "'.$menu_current.'" ) AND a.idlanguage = '.$idlanguage.'');
        return $pagenya[0]["link"];
    }
    function thejavascript($method="javascript")
    {
        if(method_exists($this,$method))
        {
            call_user_func(array($this, $method));
            return false;
        }
        else
        {
            //echo 'Method not found!';
        }
    }
    function xss_filter($val) { 
        $val = htmlentities($val); 
        $val = strip_tags($val); 
        $val = filter_var($val, FILTER_SANITIZE_STRING);   
        return $val; 
    }
    function getcart_qty(){
        $totalnya = "0";
        $session_data = $this->session->userdata('cart');
        //echo 'SELECT uid,sum(qty) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'];
        if (isset($session_data['id_cart'])){
            $query_total = $this->db->query('SELECT uid,IFNULL(sum(qty),0) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'])->result_array();;
            if (count($query_total) > 0){
                $totalnya = $query_total[0]["totalnya"];
            }else{
                $totalnya = "0";
            }
        }
        return "($totalnya)";        
    }
    function pages_account(){
        $pagenya = $this->db->query('SELECT a.title,link FROM pages a WHERE parent = (SELECT sister FROM pages WHERE idmodule=53 AND idlanguage = '.$this->id_bahasa.') AND a.idlanguage = '.$this->id_bahasa.' ORDER BY a.posisi ASC')->result_array();
        //print_r('SELECT a.title,link FROM pages a WHERE a.sister IN (SELECT sister FROM `pages` WHERE `link` LIKE "'.$menu_current.'" ) AND a.idlanguage = '.$idlanguage.'');
        return $pagenya;
    }
}
class Webadmin_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    function _isLogin(){
        $username    = $this->session->userdata('username');         
        $statuslogin = $this->session->userdata('statuslogin');
        if (!isset($username) or $username == "" or !isset($statuslogin) or $statuslogin == 0){
          redirect('/webadmin/login', 'refresh');
          die();
        }
    }
    function _cekLogin($username,$password){
        $username = $username;
        $password = sha1(MD5($password));
        $query = $this->db->query("SELECT * FROM `user` WHERE username = '$username' AND password = '$password'"); 
        return $query->num_rows();        
    }
    function do_login(){
        $number_of_days = 30 ;
        $date_of_expiry = time() + 60 * 60 * 24 * $number_of_days ;
        setcookie( "userlogin", "1", $date_of_expiry, "/", "almazayaislamicschool.com" );
        $username = $this->xss_filter($this->input->post('username'));
        $password = $this->xss_filter($this->input->post('password'));
        $remember = $this->xss_filter($this->input->post('remember'));
        $time = date("Y-m-d H:i:s");  
        if (isset($username) AND $username != '' AND isset($password) AND $password != ''){
          $result = $this->_cekLogin($username,$password);
          if ($result == 1){
            $query = $this->db->query("SELECT id,iddivisi,nama,username,pic FROM `user` WHERE username = '$username'")->result(); 
            $newdata = array(
              'username'    => $username,
              'user_id'     => $query[0]->id,
              'divisi'      => $query[0]->iddivisi,
              'nama'        => $query[0]->nama,
              'pic'         => $query[0]->pic,
              'statuslogin' => 1
            );
            $this->session->set_userdata($newdata);
            $data = $this->db->query('UPDATE user SET lastlogin = NOW() WHERE id = '.$query[0]->id);
            $menuawal = $this->db->query('SELECT * FROM `divisi` where id = '.$this->session->userdata('divisi').' ORDER BY `cretime` asc')->result_array();
            $menuawal = explode(';',$menuawal[0]['idmenu']);
            $menupertama = $this->db->query('SELECT * FROM `menu` where id = '.$menuawal[0].' ORDER BY `cretime` asc')->result_array();
            $menupertama2 = explode(' ',strtolower($menupertama[0]['title']));
            if ($remember == 1) {
              echo "bebas";
              redirect('/webadmin', 'refresh');
            }
            redirect('/webadmin', 'refresh');
          }else{
            $datasalah = array(
              'username' => $username,
              'statuslogin' => "gagal"
            );
            $this->session->set_userdata($datasalah);
            $data['logingagal'] = $this->session->userdata('statuslogin');
            redirect('/webadmin/login', 'refresh');
          }
        }else{
          redirect('/webadmin/login', 'refresh');
        }
    }
    public function cek_slug_ajax()
    {  
        $title = $_POST["title"];
        $lang = $_POST["lang"];
        $table = $_POST["table"];
        if (isset($_POST["oldtitle"])){
            if (trim($_POST["title"]) == trim($_POST["oldtitle"])){
                echo $_POST["oldlink"];
                die();
            }
        }
        $cek_slug = intval($this->cekslugifydatabase($this->slugify($title),$lang,$table));
        if ($cek_slug > 0){
            $slugnya = $this->slugify($title) . "-" . $cek_slug;
        }else{
            $slugnya = $this->slugify($title);
        }  
        echo $slugnya;
        die(); 
    }
    function reorder_menu(){
        $table = $this->input->post('table');
        $id = json_decode($this->input->post('id'), true);
        $posisi = 1;
        foreach ($id as $row) {
          //echo $row['id'];
          $data = array();
          $editdata = array(            
            'posisi' => $posisi,
            'parent' => 0,
          );                    
          $this->db->where('id', $row['id']);
          $edit = $this->db->update($table, $editdata);   
          $posisi++;
          $child = 1;
          if (isset($row['children'])) {
            foreach ($row['children'] as $row2) {
              $data = array();
              $editdata2 = array(            
                'posisi'  => $child,
                'parent' => $row['id'],
                'submenu' => 0
              );
              $this->db->where('id', $row2['id']);
              $edit = $this->db->update($table, $editdata2); 
              $child++;
            }
          }
        }
    }
    public function login(){
        $data['statuslogin'] = $this->session->userdata('statuslogin');
        if ($data['statuslogin'] == 1) {
          redirect('/webadmin', 'refresh');
          die();
        }
        $this->session->unset_userdata('statuslogin');
        $data['logingagal'] = "";
        $data['username'] = $this->session->userdata('username');
		$this->load->view('cms/login.html',$data);       
	}
    function xss_filter($val) { 
        $val = htmlentities($val); 
        $val = strip_tags($val); 
        $val = filter_var($val, FILTER_SANITIZE_STRING);   
        return $val; 
    }
    function reorder_pages(){
    $table = $this->input->post('table');
    $id = json_decode($this->input->post('id'), true);
    //echo "<pre>";
    //die();
    $counternya1 = 0;
    $posisi1 = 1;
    $child = 1;
    foreach ($id as $row) {
        $id[$counternya1]["page"] = $row["id"];
        $id[$counternya1]["parent"] = 0;
            $editdata1 = array(            
                'posisi'  => $child,
                'parent' => 0,
                'submenu' => 0
            );
            $this->db->where('sister', $row['id']);
            $edit = $this->db->update($table, $editdata1);
        if (isset($row["children"])){
            $counternya2=0;
            $child1=1;
            foreach ($row['children'] as $row2) {
                $id[$counternya1]["children"][$counternya2]["page"] = $row2["id"];
                $id[$counternya1]["children"][$counternya2]["parent"] = $row["id"];
                    $editdata2 = array(            
                        'posisi'  => $child1,
                        'parent' => $row['id'],
                        'submenu' => 0
                    );
                    $this->db->where('sister', $row2['id']);
                    $edit = $this->db->update($table, $editdata2); 
                    $editdata22 = array( 
                        'submenu' => 1
                    );
                    $this->db->where('sister', $row['id']);
                    $edit = $this->db->update($table, $editdata22); 
                if (isset($row2["children"])){
                    $counternya3=0;
                    $child2 = 1;
                    foreach ($row2['children'] as $row3) {
                        //$id[$counternya1]["children"][$counternya2]["children"][$counternya3]["page"] = $row3["id"];
                        //$id[$counternya1]["children"][$counternya2]["children"][$counternya3]["parent"] = $row2["id"];
                            $editdata3 = array(            
                                'posisi'  => $child2,
                                'parent' => $row2['id'],
                                'submenu' => 0
                            );
                            $this->db->where('sister', $row3['id']);
                            $edit = $this->db->update($table, $editdata3); 
                            $editdata33 = array(   
                                'submenu' => 1
                            );
                            $this->db->where('sister', $row2['id']);
                            $edit = $this->db->update($table, $editdata33); 
                        $child2++;
                        $counternya3++;
                    }
                }
                $child1++;
                $counternya2++;
            }
        }
        $child++;
        $posisi1++;
        $counternya1++;
    }
    //print_r($id);
    die();
    $posisi = 1;
    foreach ($id as $row) {
     // echo $row['id'];
      $data = array();
      $editdata = array(            
        'posisi' => $posisi,
        'parent' => 0,
      );                    
      $this->db->where('sister', $row['id']);
      $edit = $this->db->update($table, $editdata);   
      $posisi++;
      $child = 1;
      if (isset($row['children'])) {
        foreach ($row['children'] as $row2) {
          $data = array();
          $editdata2 = array(            
            'posisi'  => $child,
            'parent' => $row['id'],
            'submenu' => 0
          );
          $this->db->where('sister', $row2['id']);
          $edit = $this->db->update($table, $editdata2); 
          $child++;
          $child2 = 1;
          if (isset($row2['children'])) {
            foreach ($row2['children'] as $row3) {
              $data = array();
              $editdata3 = array(            
                'posisi'  => $child2,
                'parent' => $row2['id'],
                'submenu' => 0
              );
              $this->db->where('sister', $row3['id']);
              $edit = $this->db->update($table, $editdata3); 
              $child2++;
            }
          }
        }
      }
    }
  }
  function reorder_list(){
    $table = $this->input->post('table');
    $id = json_decode($this->input->post('id'), true);
    $posisi = 1;
    foreach ($id as $row) {
      $data = array();
      $editdata = array(            
        'posisi' => $posisi
      );                    
      $this->db->where('id', $row['id']);
      $edit = $this->db->update($table, $editdata);   
      $posisi++;
    }
  }
  function reorder_sister(){
    $table = $this->input->post('table');
    $id = json_decode($this->input->post('id'), true);
    //print_r($id);
    $posisi = 1;
    foreach ($id as $row) {
      $data = array();
      $editdata = array(            
        'posisi' => $posisi
      );                    
      $this->db->where('sister', $row['id']);
      $edit = $this->db->update($table, $editdata);   
      $posisi++;
    }
  }
  function reorder_sister_desc(){
    $table = $this->input->post('table');
    $id = json_decode($this->input->post('id'), true);
    //echo "<pre>";
//    print_r($id);
//    die();
    $posisi = $id[0]["urut"];
    foreach ($id as $row) {
      $data = array();
      $editdata = array(            
        'posisi' => $posisi
      );                    
      $this->db->where('sister', $row['id']);
      $edit = $this->db->update($table, $editdata);   
      $posisi--;
    }
  }
  function edittable(){
    $status = $this->input->post('status');
    $table  = $this->input->post('table');
    $title  = $this->input->post('title');
    if($status == 'save'){
      $inputdata = array(            
        'title'   => $title,
        'cretime' => date('Y-m-d H:i:s'),
        'creby'   => $this->session->userdata('username')
      );     
      $saved = $this->db->insert($table, $inputdata);
      if($saved){
        echo $this->db->insert_id();
      }
    }elseif($status == 'update'){
      $id = $this->input->post('id');
      $editdata = array(            
        'title'   => $title,
        'modtime' => date('Y-m-d H:i:s'),
        'modby'   => $this->session->userdata('username')
      );     
      $this->db->where('id', $id);
      $edit = $this->db->update($table, $editdata); 
      if($edit){
        echo $id;
      }
    }elseif($status == 'trash'){
      //print_r($_POST);
      $id = $this->input->post('id');
      $editdata = array(            
        'hapus'   => 1,
        'modtime' => date('Y-m-d H:i:s'),
        'modby'   => $this->session->userdata('username')
      );     
      $this->db->where('id', $id);
      $edit = $this->db->update($table, $editdata); 
      if($edit){
        echo $id;
      } 
    }elseif($status == 'restore'){
      //print_r($_POST);
      $id = $this->input->post('id');
      $editdata = array(            
        'hapus'   => 0,
        'modtime' => date('Y-m-d H:i:s'),
        'modby'   => $this->session->userdata('username')
      );     
      $this->db->where('id', $id);
      $edit = $this->db->update($table, $editdata); 
      if($edit){
        echo $id;
      } 
    }
    elseif($status == 'delete'){
      //print_r($_POST);
      $id = $this->input->post('id');
      $deleted = $this->deleteData($table,$id);     
      if($deleted){
        echo $id;
      } 
    }
  }
  public function profile(){  
    $login = $this->_isLogin();
    $data['menulist'] = $this->_cekAkses();    
    $form = $this->input->post('form');
    if (isset($form) AND $form == 1 ){
      $status = $this->_edit_ubahpass();
      $data['status'] = $status;
    }
    $data_user = $this->db->query('SELECT id,iddivisi,username,nama,pic FROM `user` WHERE id = '.$this->session->userdata('user_id'))->result_array();
    $data['user'] = $data_user[0];
    $data['active']  = 'profile';
    $data['page']    = 'Profile';
    $data['tipe']    = '';
    $data['active2'] = '';
    $data['act']     = 'default';
    $data['submenu'] = FALSE;
    $this->load->view('cms/main.php',$data);
  }
  function countDraft($table){
    $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 0 and draft = 1')->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countPublishdateNew($table,$lang){
    $datenow = date('Y-m-d H:i:s');
    $count = $this->db->query("SELECT count(id) as jumlah FROM `".$table."` where idlanguage = '.$lang.' AND hapus = 0 AND draft = 0 and datestart <= '".$datenow."' and dateend >= '".$datenow."'")->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countSchedulingNew($table,$lang){
    $datenow = date('Y-m-d H:i:s');
    $count = $this->db->query("SELECT count(id) as jumlah FROM `".$table."` where idlanguage = '.$lang.' AND hapus = 0 AND draft = 0 and datestart >= '".$datenow."'")->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countExpiredNew($table,$lang){
    $datenow = date('Y-m-d H:i:s');
    $count = $this->db->query("SELECT count(id) as jumlah FROM `".$table."` where idlanguage = '.$lang.' AND hapus = 0 AND draft = 0 and dateend <= '".$datenow."'")->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function deleted($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET deleted = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function hide($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hidden = 1 where sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function unhide($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hidden = 0 where sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function visible(){
    if($_POST['status'] == 0){
      $query = $this->db->query('UPDATE '.$_POST['from'].' SET status = 1 WHERE deleteData = "'.$_POST['post'].'"'); 
      $status = 1;
    }else{
      $query = $this->db->query('UPDATE '.$_POST['from'].' SET status = 0 WHERE deleteData = "'.$_POST['post'].'"'); 
      $status = 0;
    }
    if ($query){
      echo $status;
    }else{
      echo 2;
    }
  }
    function _cekPermit($idmenu){
        $iddivuser = $this->session->userdata('divisi');
        $cekPermit = $this->db->query('SELECT isview,isadd,isupdate,isdelete,ishide FROM `detail_divisi` WHERE iddivisi = '.$iddivuser.' and idmenu = '.$idmenu.' ORDER BY `cretime` desc')->result();
        if(isset($cekPermit[0])){
            //echo "<pre>";
    //        print_r('SELECT isview,isadd,isupdate,isdelete,ishide FROM `detail_divisi` WHERE iddivisi = '.$iddivuser.' and idmenu = '.$idmenu.' ORDER BY `cretime` desc');
          return $cekPermit[0];
        }else{
          redirect('/webadmin/', 'refresh');
        }
      }
    function _ispermit($valpermit){
        if($valpermit != 1){
          redirect('/webadmin/', 'refresh');
        }
    }
    function _cekAkses(){
        $menulist = $this->db->query('SELECT id,idmenu FROM `divisi` where id = '.$this->session->userdata('divisi').' ORDER BY `cretime` asc')->result_array();
        $menulist = str_replace(';',',',$menulist[0]['idmenu']);
        $menu = $this->db->query('SELECT id,title,link,submenu,icon FROM `menu` where id IN ('.$menulist.') and parent = 0 AND hapus = 0 ORDER BY `posisi` asc')->result_array();
        $r = 0;
        foreach ($menu as $rowsub) {
            $submenu[$r] = $this->db->query('SELECT id,title,link,submenu,icon FROM `menu` where id IN ('.$menulist.') and parent = '.$rowsub['id'].' AND hapus = 0 ORDER BY `posisi` asc')->result_array();
            $r++;
        }
        return array($menu,$submenu);
    }
    function _cekLanguage(){
        $listlanguage = $this->db->query('SELECT id,title,lang_code,use_default FROM `language` WHERE hapus = 0 AND draft = 0 ORDER BY use_default DESC')->result_array();
        return $listlanguage;
    }
    function _cekDefLang(){
        $deflang = $this->db->query('SELECT id,title,lang_code FROM `language` WHERE use_default = 1 AND hapus = 0 AND draft = 0 ORDER BY use_default DESC')->result_array();
        return $deflang[0]['id'];
    }
    function countPublish($table){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 0 AND draft = 0')->result();
        $hasil = $count[0]->jumlah;
        return $hasil;
    }
    function countTrash($table){
    $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 1')->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
    function countPublishNew($table,$lang,$idmenu){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 0 AND draft = 0 AND idmenu='.$idmenu)->result();
        $hasil = $count[0]->jumlah;
        return $hasil;
    }
    function countDraftNew($table,$lang,$idmenu){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 0 and draft = 1 AND idmenu='.$idmenu)->result();
        $hasil = $count[0]->jumlah;
        return $hasil;
    }
    function countTrashNew($table,$lang,$idmenu){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 1 AND idmenu='.$idmenu)->result();
        $hasil = $count[0]->jumlah;
        return $hasil;
    }
    function _nextAI($table){
        $next = $this->db->query("SHOW TABLE STATUS LIKE '".$table."'");
        $next = $next->row(0);
        $next->Auto_increment;
        return $next->Auto_increment;
    }
    function trashData_haveParent($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 1, parent=0 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function trashData($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function publishData($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0, draft = 0 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function draftData_haveParent($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0, parent=0, draft = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function draftData($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0, draft = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function restoreData($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function deleteData($tablename,$id){
    $query = $this->db->query('DELETE FROM '.$tablename.' where sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function trashDataNew($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function publishDataNew($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0, draft = 0 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function draftDataNew($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0, draft = 1 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function restoreDataNew($tablename,$id){
    $query = $this->db->query('UPDATE '.$tablename.' SET hapus = 0 WHERE sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function deleteDataNew($tablename,$id){
    $query = $this->db->query('DELETE FROM '.$tablename.' where sister = "'.$id.'"'); 
    if ($query){
      return 1;
    }else{
      return 0;
    }
  }
  function countPublishNewPage($table,$lang,$type){
    $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND type='.$type.' AND hapus = 0 AND draft = 0')->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countDraftNewPage($table,$lang,$type){
    $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where type='.$type.' AND idlanguage = '.$lang.' AND hapus = 0 and draft = 1')->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countTrashNewPage($table,$lang,$type){
    $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where type='.$type.' AND idlanguage = '.$lang.' AND hapus = 1')->result();
    $hasil = $count[0]->jumlah;
    return $hasil;
  }  
  function countPublishNewBase($table,$lang,$idmenu){
    if ($lang == ""){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 0 AND draft = 0 AND idmenu='.$idmenu)->result();
    }else{
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 0 AND draft = 0 AND idmenu='.$idmenu)->result();
    }
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countDraftNewbase($table,$lang,$idmenu){
    if ($lang == ""){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 0 and draft = 1  AND idmenu = '.$idmenu)->result();
    }else{
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 0 and draft = 1  AND idmenu = '.$idmenu)->result();
    }
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function countTrashNewBase($table,$lang,$idmenu){
    if ($lang == ""){
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where hapus = 1  AND idmenu = '.$idmenu)->result();
    }else{
        $count = $this->db->query('SELECT count(*) as jumlah FROM `'.$table.'` where idlanguage = '.$lang.' AND hapus = 1  AND idmenu = '.$idmenu)->result();
    }
    $hasil = $count[0]->jumlah;
    return $hasil;
  }
  function _nextPosisi($table,$idmenu){
    $next = $this->db->query("SELECT MAX(posisi) as terbesar FROM $table WHERE idmenu=".$idmenu)->result();
    return $next[0]->terbesar;
  }
  function _nextPosisiPages($table,$idmenu,$idparent){
    $next = $this->db->query("SELECT MAX(posisi) as terbesar FROM $table WHERE idmenu=".$idmenu." AND parent=". $idparent)->result();
    return $next[0]->terbesar;
  }
  function ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
    $config['upload_path']   = './assets/images/'.$folder;
    $config['file_name']     = $filename;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['overwrite']     = TRUE;
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    $field_name = $fieldname;
    if ( !$this->upload->do_upload($field_name)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  = $this->upload->display_errors('<li>Picture :','</li>');
      return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
    }else{
      $dataupload = $this->upload->data();
      if($resizable == TRUE){
        if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
          $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
          $full_path = $dataupload['full_path'];
          if($ratio == 0){
            $resize = $this->resize_img($full_path,$width,$height,'auto');
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio > 0){
            $resize = $this->resize_img($full_path,$width,$height,'height');
            $size   = getimagesize($full_path);
            $y_axis = 0;
            $x_axis = ($size[0]-$width)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio < 0){
            $resize = $this->resize_img($full_path,$width,$height,'width');
            $size   = getimagesize($full_path);
            $x_axis = 0;
            $y_axis = ($size[1]-$height)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }
        }else{
          if ($create_thumb['status'] == TRUE) {
            $full_path = $dataupload['full_path'];
            $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
          }
        }
      }
      return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
    }
  }
  function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    	$imgsize = getimagesize($source_file);
    	$width = $imgsize[0];
    	$height = $imgsize[1];
    	$mime = $imgsize['mime'];
    	switch($mime){
    		case 'image/gif':
    			$image_create = "imagecreatefromgif";
    			$image = "imagegif";
    			break;
    		case 'image/png':
    			$image_create = "imagecreatefrompng";
    			$image = "imagepng";
    			$quality = 7;
    			break;
    		case 'image/jpeg':
    			$image_create = "imagecreatefromjpeg";
    			$image = "imagejpeg";
    			$quality = 80;
    			break;
    		default:
    			return false;
    			break;
    	}
    	$dst_img = imagecreatetruecolor($max_width, $max_height);
    	$src_img = $image_create($source_file);
    	$width_new = $height * $max_width / $max_height;
    	$height_new = $width * $max_height / $max_width;
    	//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    	if($width_new > $width){
    		//cut point by height
    		$h_point = (($height - $height_new) / 2);
    		//copy image
    		imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    	}else{
    		//cut point by width
    		$w_point = (($width - $width_new) / 2);
    		imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    	}
    	$image($dst_img, $dst_dir, $quality);
    	if($dst_img)imagedestroy($dst_img);
    	if($src_img)imagedestroy($src_img);
    }
  function bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
    $config['upload_path']   = './uploads/'.$folder;
    $config['file_name']     = $filename;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['overwrite']     = TRUE;
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    $field_name = $fieldname;
    if ( !$this->upload->do_upload($field_name)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  = $this->upload->display_errors('<li>Picture :','</li>');
      return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
    }else{
      $dataupload = $this->upload->data();
      if($resizable == TRUE){
        if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
          $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
          $full_path = $dataupload['full_path'];
          if($ratio == 0){
            $resize = $this->resize_img($full_path,$width,$height,'auto');
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio > 0){
            $resize = $this->resize_img($full_path,$width,$height,'height');
            $size   = getimagesize($full_path);
            $y_axis = 0;
            $x_axis = ($size[0]-$width)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio < 0){
            $resize = $this->resize_img($full_path,$width,$height,'width');
            $size   = getimagesize($full_path);
            $x_axis = 0;
            $y_axis = ($size[1]-$height)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }
        }else{
          if ($create_thumb['status'] == TRUE) {
            $full_path = $dataupload['full_path'];
            $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
          }
        }
      }
      return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
    }
  }
    function resize_img($full_path,$width,$height,$master_dim){
        $configresize['image_library']  = 'gd2';
        $configresize['source_image']   = $full_path;
        $configresize['maintain_ratio'] = TRUE;
        $configresize['width']          = $width;
        $configresize['height']         = $height;
        $configresize['master_dim']     = $master_dim;
        $this->load->library('image_lib', $configresize);
        $this->image_lib->initialize($configresize);
        $resize = $this->image_lib->resize();
        $this->image_lib->clear();
        return $resize;
    }
    function awal_thumb_img($full_path,$width,$height){
        $configthumb['image_library']  = 'gd2';
        $configthumb['source_image']   = $full_path;
        $configthumb['maintain_ratio'] = TRUE;
        $configthumb['create_thumb']   = TRUE;
        $configthumb['width']          = $width;
        $configthumb['height']         = $height;
        $configthumb['thumb_marker']   = '_small';
        $this->load->library('image_lib', $configthumb);
        //$this->image_lib->initialize($configthumb); 
        $thumb1 = $this->image_lib->resize();
        $this->image_lib->clear();
        return $thumb1;
    }
    function thumb_img($full_path,$width,$height){
        $configthumb['image_library']  = 'gd2';
        $configthumb['source_image']   = $full_path;
        $configthumb['maintain_ratio'] = TRUE;
        $configthumb['create_thumb']   = TRUE;
        $configthumb['width']          = $width;
        $configthumb['height']         = $height;
        $configthumb['thumb_marker']   = '_small';
        //$this->load->library('image_lib', $configthumb);
        $this->image_lib->initialize($configthumb); 
        $thumb1 = $this->image_lib->resize();
        $this->image_lib->clear();
        return $thumb1;
    }
    function crop_img($full_path,$width,$height,$x_axis,$y_axis){
        $configcrop['image_library']  = 'gd2';
        $configcrop['source_image']   = $full_path;
        $configcrop['maintain_ratio'] = FALSE;
        $configcrop['x_axis']         = $x_axis;
        $configcrop['y_axis']         = $y_axis;
        $configcrop['height']         = $height;
        $configcrop['width']          = $width;
        $this->image_lib->initialize($configcrop); 
        $crop = $this->image_lib->crop();
        $this->image_lib->clear();
        return $crop;
    }
    function resize($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
    {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);
        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }
        #Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);
        #Do some math to figure out which way we'll need to crop the image
        #to get it proportional to the new size, then crop or adjust as needed
        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;
        if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
            $new_w = $src_w;
            $new_h = $src_h;
        } elseif (($x_ratio * $src_h) < $tn_h) {
            $new_h = ceil($x_ratio * $src_h);
            $new_w = $tn_w;
        } else {
            $new_w = ceil($y_ratio * $src_w);
            $new_h = $tn_h;
        }
        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, 236, 236, 238);
        imagefill($final, 0, 0, $backgroundColor);
        //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
        #if we need to add a watermark
        if ($wmsource) {
            #find out what type of image the watermark is
            $info    = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);
            #assuming the mime type is correct
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    break;
                default:
                    die('Invalid watermark type.');
            }
            #if we're adding a watermark, figure out the size of the watermark
            #and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
        }
        if (imagejpeg($final, $destination, $quality)) {
            return true;
        }
        return false;
    }
    function resize2($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
    {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);
        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }
        #Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);
        #Do some math to figure out which way we'll need to crop the image
        #to get it proportional to the new size, then crop or adjust as needed
        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;
        if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
            $new_w = $src_w;
            $new_h = $src_h;
        } elseif (($x_ratio * $src_h) < $tn_h) {
            $new_h = ceil($x_ratio * $src_h);
            $new_w = $tn_w;
        } else {
            $new_w = ceil($y_ratio * $src_w);
            $new_h = $tn_h;
        }
        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, 251, 247, 143);
        imagefill($final, 0, 0, $backgroundColor);
        //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
        #if we need to add a watermark
        if ($wmsource) {
            #find out what type of image the watermark is
            $info    = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);
            #assuming the mime type is correct
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    break;
                default:
                    die('Invalid watermark type.');
            }
            #if we're adding a watermark, figure out the size of the watermark
            #and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
        }
        if (imagejpeg($final, $destination, $quality)) {
            return true;
        }
        return false;
    }
    public function cekslugifydatabase($slug_ori,$lang,$my_table)
    {
        $query = $this->db->query('SELECT id FROM '.$my_table.' WHERE link_ori = "'.$slug_ori.'" AND idlanguage = '.$lang);
        return $query->num_rows(); 
    }
    public function cekslugifyedit($slug_ori,$my_table,$uid)
    {
        $query = $this->db->query('SELECT id FROM '.$my_table.' WHERE link_ori = "'.$slug_ori.'"');
        return $query->num_rows(); 
    }
    function rupiah($angka)
    {
        $jadi = number_format($angka,0,',','.').",-";
        return $jadi;
    }
    static public function slugify($text)
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
      // trim
      $text = trim($text, '-');
      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      // lowercase
      $text = strtolower($text);
      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);
      if (empty($text))
      {
        return 'n-a';
      }
      return $text;
    }
    public function _getSubPagesEdit($sister,$separator,$parent){
    $deflang = $this->_cekDefLang();
    $submenu = $this->db->query('SELECT id,title,sister,parent FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    //echo "test";
    $htmlstring = "";
    foreach ($submenu as $dt){
        if ($parent == $dt["id"]){
            $htmlstring .= "<option selected=\"selected\" value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        }else{
            $htmlstring .= "<option value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        }
        //$htmlstring .= $this->_getSubPages($dt["sister"],$separator);
    }
    return $htmlstring;
  }
  public function getPagesChild($sister){
    $deflang = $this->_cekDefLang();
    $login = $this->_isLogin();
    $idpermit = 21;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $submenu = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    $data["rec"] = $submenu;
    $this->load->view('cms/subPages.php',$data); 
  }
}
?>