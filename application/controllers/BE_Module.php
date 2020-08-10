<?php
date_default_timezone_set("Asia/Jakarta");

class BE_Module extends Webadmin_Controller {
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
        $query = $this->db->query("SELECT id,module,parent,title FROM menu WHERE link = '$link'")->result();
        $this->module($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function module($id,$parent,$title){       
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
            $status = $this->_save_module();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_module();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,title,controller,controller_be,type FROM module WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/'.$this->admin.'/module', 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/module', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('module',$this->segs[5]);
            if ($deleted){
              redirect('/'.$this->admin.'/module', 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/module', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
            $this->_ispermit($permit->isdelete);
            if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('module',$this->segs[5]);
                if ($restore){
                    redirect('/'.$this->admin.'/module', 'refresh');
                }
            }else{
                redirect('/'.$this->admin.'/module', 'refresh');
            }
        }elseif ($this->segs[4] == 'trash'){
            $this->_ispermit($permit->isdelete);
            $hide = array(            
                'hapus'  => 1
            );
            $this->db->where('id', $this->segs[5]);
            $hide = $this->db->update('module', $hide);
            if ($hide){
                redirect('/'.$this->admin.'/module', 'refresh');
            }
        }else{
          redirect('/'.$this->admin.'/module', 'refresh');
        }
      }else{
        redirect('/'.$this->admin.'/module', 'refresh');
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
      $data_rec = $this->db->query('SELECT id,title,controller,type FROM module where 1=1 '.$sqlwhere.' order by cretime asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM module where 1=1 '.$sqlwhere)->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('module');
      $data['count_trash'] = $this->countTrash('module');
    }
    $data['active'] = $parent;
    $data['active2'] = $title;
    $data['page'] = 'module';
    $data['tipe'] = '';
    $data['submenu'] = TRUE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_module(){
    $title      = $this->input->post('title');
    $controller = $this->input->post('controller');
    $type       = $this->input->post('type');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($controller) AND $controller != ''){
    }else{
      $success = false;
      $notice .= "<li>Controller File : Must be filled</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'      => $title,
        'controller' => $controller, 
        'type'       => $type, 
        'cretime'    => date('Y-m-d H:i:s'),
        'creby'      => $this->session->userdata('user_id')
      );     
      $saved = $this->db->insert('module', $inputdata);
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
        'title'      => $title,
        'controller' => $controller
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_module(){
    $title      = $this->input->post('title');
    $controller = $this->input->post('controller');
    $type       = $this->input->post('type');
    $controller_be = $this->input->post('controller_be');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($controller) AND $controller != ''){
    }else{
      $success = false;
      $notice .= "<li>Controller File : Must be filled</li>";
    }
    if($success == true){
      $editdata = array(            
        'title'      => $title,
        'controller' => $controller, 
        'controller_be' => $controller_be, 
        'type'       => $type, 
        'modtime'    => date('Y-m-d H:i:s')
      );     
//       print_r($editdata);
//       die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('module', $editdata); 
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
        'title'      => $title,
        'controller' => $controller
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