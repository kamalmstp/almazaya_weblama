<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Webadmin_produklayananconsumerbanking extends Webadmin_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('encrypt');
        //$this->load->helper('url');
        $this->load->helper(array('form', 'url', 'file'));
        $this->segs = $this->uri->segment_array();
    }
    public function index(){
    }
    function _save_produk_layanan_category(){
     
     
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $description    = $this->input->post('content');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('produklayananconsumerbanking_category');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
    
        
        
        foreach ($idlang as $lang) {
            $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"produklayananconsumerbanking_category"));
            if ($cek_slug > 0){
                $slugnya = $this->slugify($title[$lang]) . "-" . $cek_slug;
            }else{
                $slugnya = $this->slugify($title[$lang]);
            }  
            
            
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'consumer_banking_group_'.$random_digit."_".$file_edit;
                $folder       = 'consumer_banking';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 218;
                $height       = 218;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 218, 
                    'height' => 218
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                    $thumbname = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }      
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                    'idlanguage' => $lang, 
                    'title'      => $title[$lang], 
                    'idpages' =>  $_POST["cat"],
                    'description' => $description[$lang],
                    'draft'      => $statusdraft,     
                    'link'       => $slugnya,
                    'link_ori'   => $this->slugify($title[$lang]),
                    'sister'     => $sister,
                    'pic'        => $picname,
                    'thumb'      => $thumbname, 
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('produklayananconsumerbanking_category', $inputdata);
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($saved){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
            return $info;
            }
        }else{
            $form = array(
                'idpages'  => $idpages,
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _edit_produk_layanan_category(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $slugnya    = $this->input->post('slug');
        $slug_orinya = $this->input->post('slug_ori');
        $description    = $this->input->post('content');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
            $statusdraft = 0;
        }else{
            $statusdraft = 1;
        }
        $sister = $this->segs[5];
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        $new_file_name = $this->input->post('imagenya');
        /*if ($_FILES['file']['name'] != ""){
            $target_path = FCPATH.'/uploads/consumer_banking/'; //Declaring Path for uploaded images
            $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
            $ext = explode('.', basename($_FILES['file']['name']));//explode file name from dot(.) 
            $file_extension = end($ext); //store extensions in the variable
            $new_file_name = md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
            if (($_FILES["file"]["size"] < 2000000)
            && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$new_file_name)) {//if file moved to uploads folder
                    $this->resize($target_path.$new_file_name, $target_path.$new_file_name, 218, 218);
                }
            }else {}
        }*/
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
            
            $picname   = $this->input->post('oldpic'.$lang);
            $thumbname = $this->input->post('oldthumb'.$lang);
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'consumer_banking_group_'.$random_digit."_".$file_edit;
                $folder       = 'consumer_banking';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 218;
                $height       = 218;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 218, 
                    'height' => 218
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                    $thumbname = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }   
            $slug = $slugnya[$lang];
            $slug_ori = $slug_orinya[$lang];
            /* BEGIN CEK SLUG BRO */
            //echo $slug_orinya[$lang]; 
            if ($this->slugify($title[$lang]) != $slug_ori){
                /* param1=slugnya,param2=bahasanya,param3=tablenya*/
                $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"produklayananconsumerbanking_category"));
                if ($cek_slug > 0){
                    $slugnya_adalah = $this->slugify($title[$lang]) . "-" . $cek_slug;
                }else{
                    $slugnya_adalah = $this->slugify($title[$lang]);
                }
                $slug = $slugnya_adalah;
                $slug_ori = $this->slugify($title[$lang]);
            }
            $editdata = array(    
                'idlanguage' => $lang, 
                'title'      => $title[$lang], 
                'description'=> $description[$lang],  
                'link'       => $slug, 
                'link_ori'   => $slug_ori, 
                'sister'     => $sister,
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username'),                  
                'pic'        => $picname,
                'thumb'      => $thumbname
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('produklayananconsumerbanking_category', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{ 
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    public function kategori(){
        
        $this->url_module = "kategoriproduklayananconsumerbanking";
        $login = $this->_isLogin();
        $idmenudb = 38;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){   
            
          if (isset($this->segs[4])){
            
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
                $data['pages'] = $this->db->query('SELECT id,title,sister,link FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 13 AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                
                $this->_ispermit($permit->isadd);
                
                $form = $this->input->post('form');
                
                if (isset($form) AND $form == 1 ){
                    $status = $this->_save_produk_layanan_category();
                    $data['status'] = $status;
                } 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              $data['pages'] = $this->db->query('SELECT id,title,sister,link FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 13 AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_produk_layanan_category();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT id,idpages,title,description,link_ori,link,pic,thumb FROM `produklayananconsumerbanking_category` WHERE sister = '.$this->segs[5])->result_array(); 
                //print_r('SELECT id,idpages,title,description,link_ori,link FROM `produklayananconsumerbanking_category` WHERE sister = '.$this->segs[5]);
                //die();
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('produklayananconsumerbanking_category',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('produklayananconsumerbanking_category',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('produklayananconsumerbanking_category',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('produklayananconsumerbanking_category',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('produklayananconsumerbanking_category',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$this->url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$this->url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'produklayananconsumerbanking_category.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'produklayananconsumerbanking_category.hapus = 0 and produklayananconsumerbanking_category.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "produklayananconsumerbanking_category.hapus = 0 and produklayananconsumerbanking_category.draft = 0 ";
            $data['statuspage'] = 'publish';
          }        
          //$data_rec = $this->db->query('SELECT * FROM `produklayananconsumerbanking_category` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
          $data_rec = $this->db->query('SELECT produklayananconsumerbanking_category.id,produklayananconsumerbanking_category.title, produklayananconsumerbanking_category.sister, pages.link FROM `produklayananconsumerbanking_category` INNER JOIN `pages` ON produklayananconsumerbanking_category.idpages = pages.id where produklayananconsumerbanking_category.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND produklayananconsumerbanking_category.parent=0 order by produklayananconsumerbanking_category.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `produklayananconsumerbanking_category` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result();
           
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNew('produklayananconsumerbanking_category',$deflang);
          $data['count_draft']      = $this->countDraftNew('produklayananconsumerbanking_category',$deflang);
          $data['count_trash']      = $this->countTrashNew('produklayananconsumerbanking_category',$deflang);
        }
        $data['url_module'] = $this->url_module;
        $data['submenu'] = FALSE;
        $data['active']  = 'kategoriproduklayananconsumerbanking';
        $data['active2'] = '';
        $data['page']    = 'produklayananconsumerbankingcategory';
        $this->load->view('cms/main.php',$data); 
    }
    function _save_listprodukservice(){
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $description    = $this->input->post('content');
        $benefit    = $this->input->post('benefit');
        $syarat_pembukaan    = $this->input->post('syarat_pembukaan');
        $fitur_umum    = $this->input->post('fitur_umum');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('list_produk_service');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
    
        
        
        foreach ($idlang as $lang) {
            $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"list_produk_service"));
            if ($cek_slug > 0){
                $slugnya = $this->slugify($title[$lang]) . "-" . $cek_slug;
            }else{
                $slugnya = $this->slugify($title[$lang]);
            }  
            
            
            $picname   = "";
            $picname_home   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'list_produk_service_'.$random_digit."_".$file_edit;
                $folder       = 'list_produk_service';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 217;
                $height       = 267;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 217, 
                    'height' => 267
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                    $thumbname = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }      
            if ($step1 == TRUE AND isset($_FILES['pic_home'.$lang]['name']) AND $_FILES['pic_home'.$lang]['name'] != '') {
                $filenameold_home   = strtolower($_FILES['pic_home'.$lang]['name']);
                $file_edit_home     = str_replace(" ","_",$filenameold_home);
                $random_digit  = rand(000,999);
                $new_file_name_home = 'home_list_produk_service_'.$random_digit."_".$file_edit_home;
                $folder_home       = 'list_produk_service';
                $filename_home     = $new_file_name_home;
                $fieldname_home    = 'pic_home'.$lang;
                $resizable    = TRUE;
                $width        = 298;
                $height       = 169;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder_home,$filename_home,$fieldname_home,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname_home   = $hasilupload['filename'];
                    $thumbname_home = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname_home = ""; 
                }
            }   
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                    'idlanguage' => $lang, 
                    'title'      => $title[$lang], 
                    'idpages' =>  $_POST["cat"],
                    'description' => $description[$lang],
                    'benefit' => $benefit[$lang],
                    'syarat_pembukaan' => $syarat_pembukaan[$lang],
                    'fitur_umum' => $fitur_umum[$lang],
                    'draft'      => $statusdraft,     
                    'link'       => $slugnya,
                    'link_ori'   => $this->slugify($title[$lang]),
                    'sister'     => $sister,
                    'pic'        => $picname,
                    'pic_home'        => $picname_home,
                    'thumb'      => $thumbname, 
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('list_produk_service', $inputdata);
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($saved){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
            return $info;
            }
        }else{
            // $form = array(
            //     'idpages'  => $idpages,
            //     'title'    => $title,
            //     'link'     => $link,
            // );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _edit_listprodukservice(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $slugnya    = $this->input->post('slug');
        $slug_orinya = $this->input->post('slug_ori');
        $description    = $this->input->post('content');
        $benefit    = $this->input->post('benefit');
        $syarat_pembukaan    = $this->input->post('syarat_pembukaan');
        $fitur_umum    = $this->input->post('fitur_umum');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
            $statusdraft = 0;
        }else{
            $statusdraft = 1;
        }
        $sister = $this->segs[5];
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        $new_file_name = $this->input->post('imagenya');
        
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
            
            $picname   = $this->input->post('oldpic'.$lang);
            $picname_home   = $this->input->post('oldpic_home'.$lang);
            $thumbname = $this->input->post('oldthumb'.$lang);
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'list_produk_service_'.$random_digit."_".$file_edit;
                $folder       = 'list_produk_service';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 217;
                $height       = 267;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 217, 
                    'height' => 267
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                    $thumbname = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }   
            
            if ($step1 == TRUE AND isset($_FILES['pic_home'.$lang]['name']) AND $_FILES['pic_home'.$lang]['name'] != '') {
                $filenameold_home   = strtolower($_FILES['pic_home'.$lang]['name']);
                $file_edit_home     = str_replace(" ","_",$filenameold_home);
                $random_digit  = rand(000,999);
                $new_file_name_home = 'home_list_produk_service_'.$random_digit."_".$file_edit_home;
                $folder_home       = 'list_produk_service';
                $filename_home     = $new_file_name_home;
                $fieldname_home    = 'pic_home'.$lang;
                $resizable    = TRUE;
                $width        = 298;
                $height       = 169;
                $create_thumb = array(            
                    'status' => TRUE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                $hasilupload = $this->ryan_bas_img_upload($folder_home,$filename_home,$fieldname_home,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname_home   = $hasilupload['filename'];
                    $thumbname_home = $hasilupload['thumbname'];
                }else{
                    $success = $hasilupload['success'];
                    $step1   = $hasilupload['step1'];
                    $notice  .= $hasilupload['notice'];
                    $picname_home = ""; 
                }
            }   
            $slug = $slugnya[$lang];
            $slug_ori = $slug_orinya[$lang];
            /* BEGIN CEK SLUG BRO */
            //echo $slug_orinya[$lang]; 
            if ($this->slugify($title[$lang]) != $slug_ori){
                /* param1=slugnya,param2=bahasanya,param3=tablenya*/
                $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"produklayananconsumerbanking_category"));
                if ($cek_slug > 0){
                    $slugnya_adalah = $this->slugify($title[$lang]) . "-" . $cek_slug;
                }else{
                    $slugnya_adalah = $this->slugify($title[$lang]);
                }
                $slug = $slugnya_adalah;
                $slug_ori = $this->slugify($title[$lang]);
            }
            $editdata = array(    
                'idlanguage' => $lang, 
                'title'      => $title[$lang],  
                'description' => $description[$lang],
                'benefit' => $benefit[$lang],
                'syarat_pembukaan' => $syarat_pembukaan[$lang],
                'fitur_umum' => $fitur_umum[$lang],
                'link'       => $slug, 
                'link_ori'   => $slug_ori, 
                'sister'     => $sister,
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username'),                  
                'pic'        => $picname,
                'pic_home'        => $picname_home,
                'thumb'      => $thumbname
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('list_produk_service', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{ 
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                // 'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    public function listprodukservice(){
        
        $this->url_module = "listprodukservice";
        $login = $this->_isLogin();
        $idmenudb = 38;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){   
            
          if (isset($this->segs[4])){
            
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
                $data['pages'] = $this->db->query('SELECT id,title,sister,link FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 13 AND draft = 0 AND hapus = 0 ORDER BY parent asc, posisi asc')->result_array();
                
                $this->_ispermit($permit->isadd);
                
                $form = $this->input->post('form');
                
                if (isset($form) AND $form == 1 ){
                    $status = $this->_save_listprodukservice();
                    $data['status'] = $status;
                } 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              $data['pages'] = $this->db->query('SELECT id,title,sister,link FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 13 AND draft = 0 AND hapus = 0 ORDER BY parent asc, posisi asc')->result_array();
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_listprodukservice();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `list_produk_service` WHERE sister = '.$this->segs[5])->result_array(); 
                //echo "<pre>";
                //print_r($data_rec);
                //die();
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('list_produk_service',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('list_produk_service',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('list_produk_service',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('list_produk_service',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('list_produk_service',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$this->url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$this->url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'list_produk_service.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'list_produk_service.hapus = 0 and list_produk_service.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "list_produk_service.hapus = 0 and list_produk_service.draft = 0 ";
            $data['statuspage'] = 'publish';
          }        
          //$data_rec = $this->db->query('SELECT * FROM `list_produk_service` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
          $data_rec = $this->db->query('SELECT list_produk_service.id,list_produk_service.title,list_produk_service.sister,pages.link FROM `list_produk_service` INNER JOIN `pages` ON list_produk_service.idpages = pages.id where list_produk_service.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND list_produk_service.parent=0 order by list_produk_service.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `list_produk_service` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result();
           
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNew('list_produk_service',$deflang);
          $data['count_draft']      = $this->countDraftNew('list_produk_service',$deflang);
          $data['count_trash']      = $this->countTrashNew('list_produk_service',$deflang);
        }
        $data['url_module'] = $this->url_module;
        $data['submenu'] = FALSE;
        $data['active']  = 'kategoriproduklayananconsumerbanking';
        $data['active2'] = '';
        $data['page']    = 'listprodukservice';
        $this->load->view('cms/main.php',$data); 
    }
    function _save_management_list(){
     
     
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $position   = $this->input->post('position');
        $cat   = $this->input->post('cat');
        $description    = $this->input->post('content');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('management_list');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $new_file_name = "";
        if ($_FILES['file']['name'] != ""){
            $target_path = FCPATH.'/uploads/management/'; //Declaring Path for uploaded images
            $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
            $ext = explode('.', basename($_FILES['file']['name']));//explode file name from dot(.) 
            $file_extension = end($ext); //store extensions in the variable
            $new_file_name = md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
            if (($_FILES["file"]["size"] < 2000000)
            && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$new_file_name)) {//if file moved to uploads folder
                    $this->resize($target_path.$new_file_name, $target_path.$new_file_name, 238, 381);
                }
                
                
            }else {}
        }
        foreach ($idlang as $lang) {
            $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"management_list"));
            if ($cek_slug > 0){
                $slugnya = $this->slugify($title[$lang]) . "-" . $cek_slug;
            }else{
                $slugnya = $this->slugify($title[$lang]);
            }        
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                    'idlanguage' => $lang, 
                    'title'      => $title[$lang],
                    'position'   => $position[$lang],  
                    'description' => $description[$lang],
                    'management_category' => $cat,
                    'draft'      => $statusdraft,     
                    'link'       => $slugnya,
                    'link_ori'   => $this->slugify($title[$lang]),
                    'sister'     => $sister,
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username'),
                    'pic'        => $new_file_name
                );     
                $saved = $this->db->insert('management_list', $inputdata);
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($saved){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
            return $info;
            }
        }else{
            $form = array(
                'idpages'  => $idpages,
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _edit_management_list(){
        
        $id      = $this->input->post('id');
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $position   = $this->input->post('position');
        $slugnya    = $this->input->post('slug');
        $cat    = $this->input->post('category');
        $slug_orinya = $this->input->post('slug_ori');
        $description    = $this->input->post('content');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
       
        if(isset($publish) and $publish != '' and $publish == 'publish'){
            $statusdraft = 0;
        }else{
            $statusdraft = 1;
        }
        $sister = $this->segs[5];
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        
        $new_file_name = $this->input->post('imagenya');
        if ($_FILES['file']['name'] != ""){
            $target_path = FCPATH.'/uploads/management/'; //Declaring Path for uploaded images
            $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
            $ext = explode('.', basename($_FILES['file']['name']));//explode file name from dot(.) 
            $file_extension = end($ext); //store extensions in the variable
            $new_file_name = md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
            if (($_FILES["file"]["size"] < 2000000)
            && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$new_file_name)) {//if file moved to uploads folder
                    $this->resize($target_path.$new_file_name, $target_path.$new_file_name, 238, 381);
                }
            }else {}
        }
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
                
            $slug = $slugnya[$lang];
            $slug_ori = $slug_orinya[$lang];
            /* BEGIN CEK SLUG BRO */
            //echo $slug_orinya[$lang]; 
            if ($this->slugify($title[$lang]) != $slug_ori){
                /* param1=slugnya,param2=bahasanya,param3=tablenya*/
                $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"management_category"));
                if ($cek_slug > 0){
                    $slugnya_adalah = $this->slugify($title[$lang]) . "-" . $cek_slug;
                }else{
                    $slugnya_adalah = $this->slugify($title[$lang]);
                }
                $slug = $slugnya_adalah;
                $slug_ori = $this->slugify($title[$lang]);
            }
            $editdata = array(    
                'idlanguage' => $lang, 
                'title'      => $title[$lang],
                'position'   => $position[$lang],  
                'description' => $description[$lang],
                'management_category' => $cat,
                'link'       => $slug, 
                'link_ori'   => $slug_ori, 
                'sister'     => $sister,
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username'),
                'pic'        => $new_file_name
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('management_list', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{ 
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    public function managementlist(){
        
        $this->url_module = "managementlist";
        $login = $this->_isLogin();
        $idmenudb = 38;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){   
            
          if (isset($this->segs[4])){
            
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
                //$data_rec = $this->db->query('SELECT * FROM `management_category` a LEFT JOIN language b ON a.idlanguage=b.id  WHERE b.use_default = 1')->result_array(); 
                //$data['cat'] = $data_rec;
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 11 AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                
                $this->_ispermit($permit->isadd);
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                    $status = $this->_save_management_list();
                    $data['status'] = $status;
                } 
            }elseif ($this->segs[4] == 'edit'){
                //$data_rec = $this->db->query('SELECT a.id,a.title,a.sister FROM `management_category` a LEFT JOIN language b ON a.idlanguage=b.id  WHERE b.use_default = 1')->result_array(); 
                //$data['cat'] = $data_rec;
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 11 AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_management_list();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT pic,id,idpages,title,description,link_ori,link,position,management_category FROM `management_list` WHERE sister = '.$this->segs[5])->result_array(); 
                //echo "<pre>";
                //print_r($data_rec);
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `management_list` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('management_list',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('management_list',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('management_list',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('management_list',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('management_list',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$this->url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$this->url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'management_list.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'management_list.hapus = 0 and management_list.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "management_list.hapus = 0 and management_list.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          //$data_rec = $this->db->query('SELECT management_category.id,management_category.title,management_category.sister,management_category.thumb,management_category.pic FROM `management_category` where management_category.idlanguage = '.$deflang.' '.$sqlwhere.' order by management_category.posisi asc')->result_array();  
          //$data_count = $this->db->query('SELECT count(*) as jumlah FROM `management_category` where 1=1 '.$sqlwhere.' order by posisi asc')->result();        
          $data_rec = $this->db->query('SELECT management_list.id,management_list.title,management_list.sister FROM `management_list` where management_list.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND management_list.parent=0 order by management_list.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `management_list` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND management_list.parent=0 order by posisi asc')->result();
           
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNew('management_list',$deflang);
          $data['count_draft']      = $this->countDraftNew('management_list',$deflang);
          $data['count_trash']      = $this->countTrashNew('management_list',$deflang);
        }
        $data['url_module'] = $this->url_module;
        $data['submenu'] = FALSE;
        $data['active']  = 'Management';
        $data['active2'] = '';
        $data['page']    = 'managementlist';
        $this->load->view('cms/main.php',$data); 
    }
    function ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
        $config['upload_path']   = FCPATH.'/uploads/'.$folder;
        $config['file_name']     = $filename;
        $config['allowed_types'] = 'gif|jpg|png';
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
      
    
}