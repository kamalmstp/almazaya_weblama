<?php
date_default_timezone_set("Asia/Jakarta");
class Be_testimonial extends Webadmin_Controller {
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
            $status = $this->_save_testimonial($id);
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_testimonial($id);
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT * FROM `testimonial` WHERE  id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/testimonial', 'refresh');
            }
          } else {
            redirect('/webadmin/testimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('testimonial',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/testimonial', 'refresh');
            }
          } else {
            redirect('/webadmin/testimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('testimonial',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/testimonial', 'refresh');
            }
          } else {
            redirect('/webadmin/testimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE testimonial SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/testimonial', 'refresh');
          }
        }else{
          redirect('/webadmin/testimonial', 'refresh');
        }
      }else{
        redirect('/webadmin/testimonial', 'refresh');
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
      $data_rec = $this->db->query('SELECT * FROM `testimonial` where 1=1 '.$sqlwhere.' AND idmenu='.$id.' order by cretime desc')->result_array();  
      $data_count = $this->db->query('SELECT count(id) as jumlah FROM `testimonial` where 1=1 '.$sqlwhere.' AND idmenu='.$id.' order by cretime desc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('testimonial');
      $data['count_trash'] = $this->countTrash('testimonial');
    }
    
    $data['page'] = 'testimonial';
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
  function _save_testimonial($id){
    $title  = $this->input->post('name');
    $sebagai  = $this->input->post('sebagai');
    $description = $this->input->post('description');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Name : Must be filled</li>";
    }
   
    if($success == true){
      $data = array();
      $inputdata = array(            
        'name'    => $title,
        'sebagai'    => $sebagai,
        'testimonial'   => $description, 
        'idmenu'   => $id, 
        'cretime' => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('testimonial', $inputdata);
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
        'title'  => $title,
        'description' => $description
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_testimonial($id){
    $title  = $this->input->post('name');
    $sebagai  = $this->input->post('sebagai');
    $description = $this->input->post('description');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Name : Must be filled</li>";
    }
   
    if($success == true){
      $editdata = array(            
        'name'    => $title,
        'sebagai'    => $sebagai,
        'testimonial'   => $description, 
        'idmenu'   => $id, 
        'modtime'   => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('testimonial', $editdata); 
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
        'name' => $title,
        'email'  => $sebagai
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