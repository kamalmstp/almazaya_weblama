<?php
date_default_timezone_set("Asia/Jakarta");

class BE_Divisi extends Webadmin_Controller {
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
        $this->divisi($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function divisi($id,$parentnya,$title){       
    $login = $this->_isLogin();
    $id_menu = $id;
    $permit = $this->_cekPermit($id_menu);
    $this->data['permit'] = $permit;
    $this->data['menulist'] = $this->_cekAkses();
    $url_module = $this->segs[2];
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $this->data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_divisi();
            $this->data['status'] = $status;
          }
          $data_rec = $this->db->query('SELECT id,title,posisi,akses FROM menu where parent = 0 and hapus = 0 and draft = 0 order by posisi asc')->result_array();
          $urutanchild = 0;
          foreach ($data_rec as $parent) {
            $datachild[$urutanchild] = $this->db->query('SELECT id,title,posisi,akses FROM menu where parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
            $urutanchild++;
          }
          
          $this->data['rec'] = $data_rec;
          $this->data['child'] = $datachild;
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_divisi();
              $this->data['status'] = $status;
            }
            $data_divisi = $this->db->query('SELECT id,title,idmenu FROM divisi where id = '.$this->segs[5].' order by cretime asc')->result_array();
            $listmenu = str_replace(';',',',$data_divisi[0]['idmenu']);
            $data_akses = $this->db->query('SELECT id,iddivisi,idmenu,isadd,isupdate,isdelete,ishide FROM detail_divisi where idmenu IN ('.$listmenu.') and iddivisi = '.$this->segs[5].' ORDER BY cretime asc')->result_array();
            $addid = '';
            $updateid = '';
            $deleteid = '';
            $hideid = '';
            foreach ($data_akses as $row) {
              if($row['isadd'] == 1){
                $addid = $addid.$row['idmenu'].";";
              }
              if($row['isupdate'] == 1){
                $updateid = $updateid.$row['idmenu'].";";
              }
              if($row['isdelete'] == 1){
                $deleteid = $deleteid.$row['idmenu'].";";
              }
              if($row['ishide'] == 1){
                $hideid = $hideid.$row['idmenu'].";";
              }
            }
            $this->data['addid']    = substr($addid, 0, -1);
            $this->data['updateid'] = substr($updateid, 0, -1);
            $this->data['deleteid'] = substr($deleteid, 0, -1);
            $this->data['hideid'] = substr($hideid, 0, -1);
            if ($data_divisi) {
              $this->data['data_divisi'] = $data_divisi[0];
            } else {
              redirect('/'.$this->admin.'/'.$url_module, 'refresh');
            }
            $data_rec = $this->db->query('SELECT id,title,posisi,akses FROM menu where parent = 0 and hapus = 0 and draft = 0 order by posisi asc')->result_array();
            $urutanchild = 0;
            foreach ($data_rec as $parent) {
              $datachild[$urutanchild] = $this->db->query('SELECT id,title,posisi,akses FROM menu where parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
              $urutanchild++;
            }
            //echo "<pre>";
            //print_r($data_rec);
            $this->data['rec'] = $data_rec;
            $this->data['child'] = $datachild;
          } else {
            redirect('/'.$this->admin.'/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('divisi',$this->segs[5]);
            if ($deleted){
              redirect('/'.$this->admin.'/'.$url_module, 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('divisi',$this->segs[5]);
            if ($restore){
              redirect('/'.$this->admin.'/'.$url_module, 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE divisi SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/'.$this->admin.'/'.$url_module, 'refresh');
          }
        }else{
          redirect('/'.$this->admin.'/'.$url_module, 'refresh');
        }
      }else{
        redirect('/'.$this->admin.'/'.$url_module, 'refresh');
      }
    }else{
        
        $this->_ispermit($permit->isview);
        $sqlwhere = "";
        $this->data['statuspage'] = 'publish';
        $limit = 5;
        
        if (isset($_GET["per_page"])){
            $start1 = ($_GET["per_page"] * $limit) - $limit;
            $limit1 = $start1 + $limit;
            $no = (($_GET["per_page"] * $limit) - $limit) + 1;
        }else{
            $start1 = 0;
            $limit1 = $start1 + $limit;
            $no = 1;;
        }
        
        
        
        $data_rec = $this->db->query('SELECT id,title FROM divisi where 1=1 '.$sqlwhere.' order by id asc')->result_array();  
        $data_rec_countnya = $this->db->query('SELECT count(*) as jumlah FROM divisi where 1=1 '.$sqlwhere.'')->result();
        $this->data["q"] = "";
        if (isset($_GET["q"])){
            $querynya = "SELECT * FROM( select  ROW_NUMBER() OVER ( ORDER BY id DESC) AS RowNum, * FROM divisi where 1=1 $sqlwhere AND divisi.title  LIKE '%".$_GET["q"]."%') AS RowConstrainedResult where RowNum > $start1 AND RowNum <= $limit1";
            $data_rec_countnya = $this->db->query("SELECT count(*) as jumlah FROM divisi where 1=1  AND divisi.title  LIKE '%".$_GET["q"]."%'")->result();        
            $this->data["q"] = $_GET["q"];
        }
        $data_rec_count = $data_rec_countnya[0]->jumlah;
        
        $query_string = $_GET;
        if (isset($query_string['page']))
        {
        unset($query_string['page']);
        }
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';       
        $config['uri_segment'] = 10;
        $config['base_url'] = base_url($this->admin.'/'.$url_module);
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last'; 
        $config['total_rows'] = $data_rec_count;
        $config['per_page'] = $limit;        
        $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        //$config['suffix'] = '' . http_build_query($query_string, '', "&");
        //$config['first_url'] = $url_module.'/?page=1';
        //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['num_links'] = 5;
        //$config['query_string_segment'] = "page";
        
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();  
        $this->data['limit']       = $limit;
        $this->data['rec']        = $data_rec;
        $this->data['act']        = 'default';
        $this->data['no']        = $no;
        $this->data['jumlahdata'] = $data_rec_count;
        $this->data['act'] = 'default';
    }
    $this->data['page'] = 'divisi';
    $this->data['tipe'] = '';
    $this->data['active'] = $parentnya;
    $this->data['active2'] = $title;
    $this->data['submenu'] = TRUE;
    $this->data['url_module'] = $this->segs[2];
    $this->data['count_publish'] = $this->countPublish('divisi');
    $this->data['count_trash'] = $this->countTrash('divisi');
    //echo "<pre>";
//    print_r($this->data);
    $this->load->view('cms/main.php',$this->data); 
  }
  function _save_divisi(){
    $title = $this->input->post('title');
    $accview = $this->input->post('accview');
    $accadd = $this->input->post('accadd');
    $accupdate = $this->input->post('accupdate');
    $accdelete = $this->input->post('accdelete');
    $acchide = $this->input->post('acchide');
    $viewid = "";
    foreach ($accview as $key => $value) {
      $viewid = $viewid.$key.";";
    }
    $viewid = substr($viewid, 0, -1);
    $addid = "";
    if (isset($accadd) AND $accadd != '') {
      foreach ($accadd as $key => $value) {
        $addid = $addid.$key.";";
      }
      $addid = substr($addid, 0, -1);
    }
    $updateid = "";
    if (isset($accupdate) AND $accupdate != '') {
      foreach ($accupdate as $key => $value) {
        $updateid = $updateid.$key.";";
      }
      $updateid = substr($updateid, 0, -1);
    }
    $deleteid = "";
    if (isset($accdelete) AND $accdelete != '') {
      foreach ($accdelete as $key => $value) {
        $deleteid = $deleteid.$key.";";
      }
      $deleteid = substr($deleteid, 0, -1);
    }
    $hideid = "";
    if (isset($acchide) AND $acchide != '') {
      foreach ($acchide as $key => $value) {
        $hideid = $hideid.$key.";";
      }
      $hideid = substr($hideid, 0, -1);
    }
    $notice = "";
    $success = true;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($accview) AND $accview != ''){
    }else{
      $success = false;
      $notice .= "<li>Access : Must choose 1 access page</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'   => $title,
        'idmenu'   => $viewid,
        'cretime' => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('divisi', $inputdata);
      $iddivisi = $this->db->insert_id();
      $menu = $this->db->query('SELECT id FROM menu order by cretime asc')->result_array();
      foreach ($menu as $idmenu) {
        $key = $idmenu['id'];
        if (isset($accview[$key]) AND $accview[$key] != "") {
          $isview = 1;
        }else{
          $isview = 0;
        }
        if (isset($accadd[$key]) AND $accadd[$key] != "") {
          $isadd = 1;
        }else{
          $isadd = 0;
        }
        if (isset($accupdate[$key]) AND $accupdate[$key] != "") {
          $isupdate = 1;
        }else{
          $isupdate = 0;
        }
        if (isset($accdelete[$key]) AND $accdelete[$key] != "") {
          $isdelete = 1;
        }else{
          $isdelete = 0;
        }
        if (isset($acchide[$key]) AND $acchide[$key] != "") {
          $ishide = 1;
        }else{
          $ishide = 0;
        }
        $inputdata2 = array(            
          'iddivisi' => $iddivisi,
          'idmenu'   => $key,
          'isview'    => $isview,
          'isadd'    => $isadd,
          'isupdate' => $isupdate,
          'isdelete' => $isdelete,
          'ishide' => $ishide,
          'cretime'  => date('Y-m-d H:i:s')
        );     
        $saved = $this->db->insert('detail_divisi', $inputdata2);
      }
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
        'view'   => $viewid,
        'add'    => $addid,
        'update' => $updateid,
        'delete' => $deleteid,
        'hide' => $hideid
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_divisi(){
    $title = $this->input->post('title');
    $accview = $this->input->post('accview');
    $accadd = $this->input->post('accadd');
    $accupdate = $this->input->post('accupdate');
    $accdelete = $this->input->post('accdelete');
    $acchide = $this->input->post('acchide');
    $viewid = "";
    if (isset($accview) AND $accview != '') {
      foreach ($accview as $key => $value) {
        $viewid = $viewid.$key.";";
      }
      $viewid = substr($viewid, 0, -1);
    }
    $addid = "";
    if (isset($accadd) AND $accadd != '') {
      foreach ($accadd as $key => $value) {
        $addid = $addid.$key.";";
      }
      $addid = substr($addid, 0, -1);
    }
    $updateid = "";
    if (isset($accupdate) AND $accupdate != '') {
      foreach ($accupdate as $key => $value) {
        $updateid = $updateid.$key.";";
      }
      $updateid = substr($updateid, 0, -1);
    }
    $deleteid = "";
    if (isset($accdelete) AND $accdelete != '') {
      foreach ($accdelete as $key => $value) {
        $deleteid = $deleteid.$key.";";
      }
      $deleteid = substr($deleteid, 0, -1);
    }
    $hideid = "";
    if (isset($acchide) AND $acchide != '') {
      foreach ($acchide as $key => $value) {
        $hideid = $hideid.$key.";";
      }
      $hideid = substr($hideid, 0, -1);
    }
    
    $notice = "";
    $success = true;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($accview) AND $accview != ''){
    }else{
      $success = false;
      $notice .= "<li>Access : Must choose 1 access page</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'   => $title,
        'idmenu'   => $viewid,
        'modtime' => date('Y-m-d H:i:s')
      );     
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('divisi', $inputdata); 
      $menu = $this->db->query('SELECT id FROM menu order by cretime asc')->result_array();
      foreach ($menu as $idmenu) {
        $key = $idmenu['id'];
        if (isset($accview[$key]) AND $accview[$key] != "") {
          $isview = 1;
        }else{
          $isview = 0;
        }
        if (isset($accadd[$key]) AND $accadd[$key] != "") {
          $isadd = 1;
        }else{
          $isadd = 0;
        }
        if (isset($accupdate[$key]) AND $accupdate[$key] != "") {
          $isupdate = 1;
        }else{
          $isupdate = 0;
        }
        if (isset($accdelete[$key]) AND $accdelete[$key] != "") {
          $isdelete = 1;
        }else{
          $isdelete = 0;
        }
        if (isset($acchide[$key]) AND $acchide[$key] != "") {
          $ishide = 1;
        }else{
          $ishide = 0;
        }
        $cekAksesmenu = $this->db->query('SELECT id FROM detail_divisi where idmenu = '.$key.' and iddivisi = '.$this->segs[5])->result();
        if (!$cekAksesmenu) {
          $inputdata2 = array(            
            'iddivisi' => $this->segs[5],
            'idmenu'   => $key,
            'isadd'    => $isadd,
            'isview'   => $isview,
            'isupdate' => $isupdate,
            'isdelete' => $isdelete,
            'ishide' => $ishide,
            'cretime'  => date('Y-m-d H:i:s')
          );     
          $edit = $this->db->insert('detail_divisi', $inputdata2);
        }else{
          $idakses = $cekAksesmenu[0]->id;
          $inputdata2 = array( 
            'isview'   => $isview,
            'isadd'    => $isadd,
            'isupdate' => $isupdate,
            'isdelete' => $isdelete,
            'ishide' => $ishide,
            'modtime'  => date('Y-m-d H:i:s')
          );     
          $this->db->where('id', $idakses);
          $edit = $this->db->update('detail_divisi', $inputdata2); 
        }
      }
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
        'title'  => $title,
        'view'   => $viewid,
        'add'    => $addid,
        'update' => $updateid,
        'delete' => $deleteid,
        'hide' => $hideid
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