<?php
date_default_timezone_set("Asia/Jakarta");
class Contact_receiver extends Webadmin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
    $this->segs = $this->uri->segment_array();
    $this->admin = "webadmin";
    $this->data['webadmin'] = $this->admin;
    $this->data['controller'] = $this;
  }
    public function index(){      
        $link = $this->segs[2];
        $query = $this->db->query("SELECT id,module,parent,title,link FROM menu WHERE link = '$link'")->result();
        $this->banner($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function banner($id,$parent,$title,$link){
    $login = $this->_isLogin();
    $idpermit = $id;
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
            $status = $this->_save_contactreceiver();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_contactreceiver();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,name,email FROM `contactreceiver` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('contactreceiver',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('contactreceiver',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE contactreceiver SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }else{
          redirect('/webadmin/contactreceiver', 'refresh');
        }
      }else{
        redirect('/webadmin/contactreceiver', 'refresh');
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
      $data_rec = $this->db->query('SELECT id,name,email FROM `contactreceiver` where 1=1 '.$sqlwhere.' order by name asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `contactreceiver` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('contactreceiver');
      $data['count_trash'] = $this->countTrash('contactreceiver');
    }
    
    $data['page'] = 'contactreceiver';
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['tipe'] = '';
    $data['parent'] = $parent;
    $data['submenu'] = TRUE;
    $url_module = $this->segs[2];
    $data['url_module'] = $url_module;
    $data['title'] = $title;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_contactreceiver(){
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
      $saved = $this->db->insert('contactreceiver', $inputdata);
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
  function _edit_contactreceiver(){
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
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('contactreceiver', $editdata); 
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