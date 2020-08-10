<?php
date_default_timezone_set("Asia/Jakarta");
class Webadmin_pengaduan_nasabah extends Webadmin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
    //$this->load->helper('url');
    $this->load->helper(array('form', 'url', 'file'));
    $this->segs = $this->uri->segment_array();
  }
  public function index(){       
    
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
    function _edit_jenis_pertanyaan(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
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
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
            $editdata = array(    
                'idlanguage' => $lang, 
                'title'      => $title[$lang], 
                'description' => $description[$lang],  
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username')
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('pengaduan_nasabah_jenis_pertanyaan', $editdata); 
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
    function _save_jenis_pertanyaan(){
     
     
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
        $sister = $this->_nextAI('pengaduan_nasabah_jenis_pertanyaan');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
    
        
        //echo '<pre>';
//        print_r($step1);
//        print_r($success);
//        die();
//        $picname   = "";
//        $picname2  = "";
//        $thumbname = "";
        foreach ($idlang as $lang) {
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                    'idlanguage' => $lang, 
                    'title'      => $title[$lang], 
                    'description' => $description[$lang],  
                    'sister'     => $sister,
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('pengaduan_nasabah_jenis_pertanyaan', $inputdata);
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
  
    public function pengaduan_nasabah_jenis_pertanyaan(){
        $this->url_module = "setting_jenis_pertanyaan";
        $login = $this->_isLogin();
        $idmenudb = 33;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){   
            
          if (isset($this->segs[4])){
            
            
            if ($this->segs[4] == 'add'){
                $data['act'] = "add_jenis_pertanyaan";
                $this->_ispermit($permit->isadd);
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                    $status = $this->_save_jenis_pertanyaan();
                    $data['status'] = $status;
                } 
            }elseif ($this->segs[4] == 'edit'){
                $data['act'] = "edit_jenis_pertanyaan";
                $this->_ispermit($permit->isupdate);
                if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                    $form = $this->input->post('form');
                    if (isset($form) AND $form == 1 ){
                        $status = $this->_edit_jenis_pertanyaan();
                        $data['status'] = $status;
                    }
                    $data_rec = $this->db->query('SELECT id,idpages,title,description,link_ori,link FROM `pengaduan_nasabah_jenis_pertanyaan` WHERE sister = '.$this->segs[5])->result_array(); 
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
                $deleted = $this->deleteData('pengaduan_nasabah_jenis_pertanyaan',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('pengaduan_nasabah_jenis_pertanyaan',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('pengaduan_nasabah_jenis_pertanyaan',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('pengaduan_nasabah_jenis_pertanyaan',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('pengaduan_nasabah_jenis_pertanyaan',$this->segs[5]);
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
            $sqlwhere = 'hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'hapus = 0 and draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "hapus = 0 and draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          //$data_rec = $this->db->query('SELECT hubungan_investor.id,hubungan_investor.title,hubungan_investor.sister,hubungan_investor.thumb,hubungan_investor.pic FROM `hubungan_investor` where hubungan_investor.idlanguage = '.$deflang.' '.$sqlwhere.' order by hubungan_investor.posisi asc')->result_array();  
          //$data_count = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor` where 1=1 '.$sqlwhere.' order by posisi asc')->result();        
          $data_rec = $this->db->query('SELECT id,title,sister  FROM `pengaduan_nasabah_jenis_pertanyaan` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `pengaduan_nasabah_jenis_pertanyaan` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND parent=0 order by posisi asc')->result();
          if ($data['statuspage'] == 'publish') {
            if(count($data_rec) != 0){
              $urutanchild = 0;
              foreach ($data_rec as $parent) {
                $datachild[$urutanchild] = $this->db->query('SELECT id,title,sister FROM `pengaduan_nasabah_jenis_pertanyaan` where idlanguage = '.$deflang.' AND parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
                $urutanchild++;
              }
              $data['child'] = $datachild;
            }
          }    
          $data['rec']        = $data_rec;
          $data['act']        = 'default_jenis_pertanyaan';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNew('pengaduan_nasabah_jenis_pertanyaan',$deflang);
          $data['count_draft']      = $this->countDraftNew('pengaduan_nasabah_jenis_pertanyaan',$deflang);
          $data['count_trash']      = $this->countTrashNew('pengaduan_nasabah_jenis_pertanyaan',$deflang);
        }
          $data['submenu'] = FALSE;
          $data['active']  = 'Pengaduan Nasabah';
          $data['active2'] = 'setting_jenis_pertanyaan';
          $data['page']    = 'pengaduan_nasabah';
          $data['url_module']    = 'setting_jenis_pertanyaan';
        $this->load->view('cms/main_pengaduan_nasabah.php',$data); 
    }
    public function _save_hubungan_investor_report(){
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('hubungan_investor_report');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;

        foreach ($idlang as $lang) {
            $picname   = "";
            $thumbname = "";
            
            if ($step1 == TRUE AND isset($_FILES['filenya'.$lang]['name']) AND $_FILES['filenya'.$lang]['name'] != '') {
                $path_parts = pathinfo($_FILES['filenya'.$lang]['name']);
                $filenameold   = strtolower($_FILES['filenya'.$lang]['name']);
                $random_digit  = date("YmdHis");
                $new_file_name =  $lang."_".$this->slugify($title[$lang]).'_'.$random_digit.".".$path_parts['extension'];
                move_uploaded_file($_FILES['filenya'.$lang]['tmp_name'],FCPATH.'/uploads/hubungan_investor/'.$new_file_name);                
            }            
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                if ($_FILES['filenya'.$lang]['name'] != ''){
                    $inputdata = array(            
                        'idlanguage' => $lang, 
                        'title'      => $title[$lang],   
                        'file'       => $new_file_name,   
                        'draft'      => $statusdraft,   
                        'sister'     => $sister,
                        'id_hubungan_investor' => $this->segs[3],
                        'cretime'    => date('Y-m-d H:i:s'),
                        'creby'      => $this->session->userdata('username')
                    );   
                }else{
                    $inputdata = array(            
                        'idlanguage' => $lang, 
                        'title'      => $title[$lang],   
                        'draft'      => $statusdraft,   
                        'sister'     => $sister,
                        'id_hubungan_investor' => $this->segs[3],
                        'cretime'    => date('Y-m-d H:i:s'),
                        'creby'      => $this->session->userdata('username')
                    );   
                }
                $saved = $this->db->insert('hubungan_investor_report', $inputdata);
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
    
    
    
    public function pengaduan_nasabah_receiver(){
        $login = $this->_isLogin();
        $idpermit = 36;
        $permit = $this->_cekPermit($idpermit);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_pengaduan_nasabah_contact_receiver();
                $data['status'] = $status;
              }
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_pengaduan_nasabah_contact_receiver();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT id,name,email FROM `pengaduan_nasabah_contact_receiver` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec[0];
                } else {
                  redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
                }
              } else {
                redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('pengaduan_nasabah_contact_receiver',$this->segs[5]);
                if ($deleted){
                  redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
                }
              } else {
                redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('pengaduan_nasabah_contact_receiver',$this->segs[5]);
                if ($restore){
                  redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
                }
              } else {
                redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
              }
            }elseif ($this->segs[4] == 'trash'){
              $this->_ispermit($permit->isdelete);
              $hide = $this->db->query('UPDATE pengaduan_nasabah_contact_receiver SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
              if ($hide){
                redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
              }
            }else{
              redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
            }
          }else{
            redirect('/webadmin/list_penerima_email_pengaduan_nasabah', 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and hapus = 1';
            $data['statuspage'] = 'trash';
          } else {
            $sqlwhere = 'and hapus = 0 and draft = 0';
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT id,name,email FROM `pengaduan_nasabah_contact_receiver` where 1=1 '.$sqlwhere.' order by name asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `pengaduan_nasabah_contact_receiver` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
          $data['rec']   = $data_rec; 
          $data['act'] = 'default';
          $data['count_publish'] = $this->countPublish('pengaduan_nasabah_contact_receiver');
          $data['count_trash'] = $this->countTrash('pengaduan_nasabah_contact_receiver');
        }
        $data['active'] = 'Pengaduan Nasabah';
        $data['active2'] = 'list_penerima_email_pengaduan_nasabah';
        $data['url_module'] = 'list_penerima_email_pengaduan_nasabah';
        $data['page'] = 'list_penerima_email_pengaduan_nasabah';
        $data['tipe'] = '';
        $data['submenu'] = TRUE;
        $this->load->view('cms/main.php',$data); 
    }
    
    
    function _save_pengaduan_nasabah_contact_receiver(){
        $name  = $this->input->post('name');
        $email = $this->input->post('email');
        $notice = "";
        $success = true;
        //echo $title;
        if(isset($name) AND $name != ''){
        }else{
            $success = false;
            $notice .= "<li>Name : Must be filled</li>";
        }
        if(isset($email) AND $email != ''){
        }else{
            $success = false;
            $notice .= "<li>Email : Must be filled</li>";
        }
        if($success == true){
            $data = array();
            $inputdata = array(            
                'name'    => $name,
                'email'   => $email, 
                'cretime' => date('Y-m-d H:i:s')
            );     
            $saved = $this->db->insert('pengaduan_nasabah_contact_receiver', $inputdata);
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
            'name'  => $name,
            'email' => $email
        );
        $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
        );
        return $info;
    }
  }
  function _edit_pengaduan_nasabah_contact_receiver(){
        $name  = $this->input->post('name');
        $email = $this->input->post('email');
        $notice = "";
        $success = true;
        //echo $title;
        if(isset($name) AND $name != ''){
        }else{
            $success = false;
            $notice .= "<li>Name : Must be filled</li>";
        }
        if(isset($email) AND $email != ''){
        }else{
            $success = false;
            $notice .= "<li>Email : Must be filled</li>";
        }
        if($success == true){
            $editdata = array(            
                'name'     => $name,
                'email' => $email, 
                'modtime'   => date('Y-m-d H:i:s')
            );  
            $this->db->where('id', $this->segs[5]);
            $edit = $this->db->update('pengaduan_nasabah_contact_receiver', $editdata); 
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
                'name' => $name,
                'email'  => $email
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    
    
}
?>