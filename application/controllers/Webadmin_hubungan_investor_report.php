<?php
date_default_timezone_set("Asia/Jakarta");
class Webadmin_hubungan_investor_report extends Webadmin_Controller {
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
    function _edit_hubungan_investor(){
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
        $sister = $this->_nextAI('hubungan_investor');
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
                'sister'     => $sister,
                'modtime'    => date('Y-m-d H:i:s'),
                'modby'      => $this->session->userdata('username')
            );     
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('hubungan_investor', $editdata); 
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
    function _save_hubungan_investor(){
     
     
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
        $sister = $this->_nextAI('hubungan_investor');
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
                $saved = $this->db->insert('hubungan_investor', $inputdata);
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
  
    public function hubungan_investor_report(){
        
        $this->url_module = "hubungan_investor";
        $login = $this->_isLogin();
        $idmenudb = 29;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[4]) AND $this->segs[4] == 'act'){   
            
          if (isset($this->segs[5])){
            
            $data['act'] = $this->segs[5];
            if ($this->segs[5] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_hubungan_investor_report();
                $data['status'] = $status;
              } 
            }elseif ($this->segs[5] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[6]) AND $this->segs[6] != '' AND is_numeric($this->segs[6])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_hubungan_investor();
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT id,title,file FROM `hubungan_investor_report` WHERE sister = '.$this->segs[6])->result_array(); 
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
                $data_row = $this->db->query('SELECT id,title,link,file,datestart,dateend,draft FROM `hubungan_investor_report` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$this->url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[6] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[6]) AND $this->segs[6] != '') {
                $deleted = $this->deleteData('hubungan_investor_report',$this->segs[6]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[5] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[6]) AND $this->segs[6] != '') {
                $restore = $this->restoreData('hubungan_investor_report',$this->segs[6]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$this->url_module, 'refresh');
              }
            }elseif ($this->segs[5] == 'movetrash'){
                
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData_haveParent('hubungan_investor_report',$this->segs[6]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[5] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData_haveParent('hubungan_investor_report',$this->segs[6]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[5] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('hubungan_investor_report',$this->segs[6]);
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
          if (isset($this->segs[4]) AND $this->segs[4] == 'trash') {
            $sqlwhere = 'hubungan_investor_report.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[4]) AND $this->segs[4] == 'draft') {
            $sqlwhere = 'hubungan_investor_report.hapus = 0 and hubungan_investor_report.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "hubungan_investor_report.hapus = 0 and hubungan_investor_report.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          //$data_rec = $this->db->query('SELECT hubungan_investor.id,hubungan_investor.title,hubungan_investor.sister,hubungan_investor.thumb,hubungan_investor.pic FROM `hubungan_investor` where hubungan_investor.idlanguage = '.$deflang.' '.$sqlwhere.' order by hubungan_investor.posisi asc')->result_array();  
          
          //$data_count = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor` where 1=1 '.$sqlwhere.' order by posisi asc')->result();
          $data_rec = $this->db->query('SELECT hubungan_investor_report.id,hubungan_investor_report.title,hubungan_investor_report.sister FROM `hubungan_investor_report` where hubungan_investor_report.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND hubungan_investor_report.parent=0 AND hubungan_investor_report.id_hubungan_investor='.$this->segs[3].' order by hubungan_investor_report.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor_report` where idlanguage = '.$deflang.' AND '.$sqlwhere.' AND hubungan_investor_report.parent=0 AND hubungan_investor_report.id_hubungan_investor='.$this->segs[3].' order by posisi asc')->result();
          if ($data['statuspage'] == 'publish') {
            if(count($data_rec) != 0){
              $urutanchild = 0;
              foreach ($data_rec as $parent) {
                $datachild[$urutanchild] = $this->db->query('SELECT id,title,sister FROM `hubungan_investor_report` where idlanguage = '.$deflang.' AND parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
                $urutanchild++;
              }
              $data['child'] = $datachild;
            }
          }  
          
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          
          $count_publish = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor_report` where idlanguage = '.$deflang.' AND hapus = 0 AND hubungan_investor_report.id_hubungan_investor='.$this->segs[3].' AND draft = 0')->result();
          $count_publishnya = $count_publish[0]->jumlah;
          $data['count_publish']    = $count_publishnya;
          
          $count_draft = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor_report` where idlanguage = '.$deflang.' AND hapus = 0 and draft = 1 AND hubungan_investor_report.id_hubungan_investor='.$this->segs[3].'')->result();
          $count_draftnya = $count_draft[0]->jumlah;
          $data['count_draft']      = $count_draftnya;
          
          $count_trash = $this->db->query('SELECT count(*) as jumlah FROM `hubungan_investor_report` where idlanguage = '.$deflang.' AND hubungan_investor_report.id_hubungan_investor='.$this->segs[3].' AND hapus = 1')->result();
          $count_trashnya = $count_trash[0]->jumlah;
          $data['count_trash']      = $count_trashnya;
        }
          $data['submenu'] = FALSE;
          $data['active']  = 'hubungan_investor_report';
          $data['active2'] = '';
          $data['page']    = 'hubungan_investor_report';
          
        if (isset($this->segs[3])){
            $data['id_hubungan_investor']        = $this->segs[3];
            $data_hubungan_invostor_report_rec = $this->db->query('SELECT hubungan_investor.id,hubungan_investor.title,hubungan_investor.sister,hubungan_investor.thumb,hubungan_investor.pic FROM `hubungan_investor` where hubungan_investor.idlanguage = '.$deflang.' AND id='.$this->segs[3].' order by hubungan_investor.posisi asc')->result_array();        
            //print_r($data_hubungan_invostor_report_rec);
            $data['hubungan_investor']        = $data_hubungan_invostor_report_rec[0]["title"];
        } 
        else{
            redirect('/webadmin/hubungan_investor', 'refresh');
        }
        $this->load->view('cms/main.php',$data); 
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
}
?>