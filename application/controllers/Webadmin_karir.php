<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Webadmin_karir extends Webadmin_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('encrypt');
        //$this->load->helper('url');
        $this->load->helper(array('form', 'url', 'file'));
        $this->segs = $this->uri->segment_array();
    }
    public function index(){
    }
    function _save_joblist(){
     
     
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $date   = $this->input->post('tanggal_lahir');
        $date = explode("-",$date);
        $date = $date[2]."-".$date[1]."-".$date[0];
        $description    = $this->input->post('content');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('joblist');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
    
        
        foreach ($idlang as $lang) {
            $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"joblist"));
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
                    'batas_akhir' => $date,  
                    'description' => $description[$lang],
                    'draft'      => $statusdraft,     
                    'link'       => $slugnya,
                    'link_ori'   => $this->slugify($title[$lang]),
                    'sister'     => $sister,
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('joblist', $inputdata);
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
    function _edit_joblist(){
        $id      = $this->input->post('id');
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $date   = $this->input->post('tanggal_lahir');
        $date = explode("-",$date);
        $date = $date[2]."-".$date[1]."-".$date[0];
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
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
                
            $slug = $slugnya[$lang];
            $slug_ori = $slug_orinya[$lang];
            /* BEGIN CEK SLUG BRO */
            //echo $slug_orinya[$lang]; 
            if ($this->slugify($title[$lang]) != $slug_ori){
                /* param1=slugnya,param2=bahasanya,param3=tablenya*/
                $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,"joblist"));
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
                'batas_akhir' => $date,  
                'description'=> $description[$lang],  
                'link'       => $slug, 
                'link_ori'   => $slug_ori, 
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username')
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('joblist', $editdata); 
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
    public function joblist(){
        
        $this->url_module = "joblist";
        $login = $this->_isLogin();
        $idmenudb = 45;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){   
            
          if (isset($this->segs[4])){
            
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
                
              $this->_ispermit($permit->isadd);
              
              $form = $this->input->post('form');
              
              if (isset($form) AND $form == 1 ){
                
                $status = $this->_save_joblist();
                $data['status'] = $status;
              } 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_joblist();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `joblist` WHERE sister = '.$this->segs[5])->result_array();
                //echo 'SELECT * FROM `joblist` WHERE sister = '.$this->segs[5]; 
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
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `joblist` WHERE id = '.$this->segs[5])->result_array(); 
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
                $deleted = $this->deleteData('joblist',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('joblist',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('joblist',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('joblist',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('joblist',$this->segs[5]);
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
            $sqlwhere = 'joblist.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'joblist.hapus = 0 and joblist.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "joblist.hapus = 0 and joblist.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          //$data_rec = $this->db->query('SELECT management_category.id,management_category.title,management_category.sister,management_category.thumb,management_category.pic FROM `management_category` where management_category.idlanguage = '.$deflang.' '.$sqlwhere.' order by management_category.posisi asc')->result_array();  
          //$data_count = $this->db->query('SELECT count(*) as jumlah FROM `management_category` where 1=1 '.$sqlwhere.' order by posisi asc')->result();        
          $data_rec = $this->db->query('SELECT joblist.id,joblist.title,joblist.sister FROM `joblist` where joblist.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND joblist.parent=0 order by joblist.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `joblist` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND joblist.parent=0 order by posisi asc')->result();
           
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNew('joblist',$deflang);
          $data['count_draft']      = $this->countDraftNew('joblist',$deflang);
          $data['count_trash']      = $this->countTrashNew('joblist',$deflang);
        }
        $data['url_module'] = $this->url_module;
        $data['submenu'] = FALSE;
        $data['active']  = 'Karir';
        $data['active2'] = 'joblist';
        $data['page']    = 'joblist';
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
    
}