<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Content extends Webadmin_Controller {
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
        $query = $this->db->query("SELECT id,module,parent,title,link,width,height FROM menu WHERE link = '$link'")->result();
        $this->content($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->width,$query[0]->height);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  function content($id,$parent,$title,$width,$height){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        $datenow = date('Y-m-d H:i:s');
        $form = $this->input->post('form');
        $data_rec = $this->db->query('SELECT * FROM `content` WHERE idmenu = '.$id)->result_array(); 
        $data['rec'] = $data_rec;
        $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 1 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
        if ($data_rec) {
            $data['rec'] = $data_rec;
        } else {
        //redirect('/webadmin/'.$url_module, 'refresh');
        }
        if (isset($form) AND $form == 1 ){
            if (count($data_rec) > 0){
                $status = $this->_edit_kategoriartikel($id,$parent,$width,$height);
            }else{
                $status = $this->_save_kategoriartikel($id,$parent,$width,$height);
            }
            $data_rec = $this->db->query('SELECT * FROM `content` WHERE idmenu = '.$id)->result_array(); 
            $data['rec'] = $data_rec;
            $data['status'] = $status;
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
        $data['active']  = $parent;
        $data['active2'] = $title;
        $data['page']    = 'content';
        $data['width']    = $width;
        $data['height']    = $height;
        $data['act']    = 'default';
        $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _edit_kategoriartikel($id,$parent,$widthnya,$heightnya){
        //print_r($_POST);
        //die();
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $content   = $this->input->post('content');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        $link = $this->input->post('link');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('content');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        $s = 1;
        foreach ($idlang as $lang) {
          $picname   = $this->input->post('oldpic'.$lang);
          $thumbname = $this->input->post('oldthumb'.$lang);
          $new_file_name  = $this->input->post('oldpic'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'banner_'.$random_digit."_".$file_edit;
            $folder       = 'banner';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = $widthnya;
            $height       = $heightnya;
            $create_thumb = array(            
              'status' => TRUE,
              'width'  => 105, 
              'height' => 70
            ); 
            if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/content/'.$new_file_name)) {//if file moved to uploads folder
                $this->resize(FCPATH.'/uploads/content/'.$new_file_name, FCPATH.'/uploads/content/thumb_'.$new_file_name, 298, 169);
                $this->resize(FCPATH.'/uploads/content/'.$new_file_name, FCPATH.'/uploads/content/'.$new_file_name, $widthnya, $heightnya);
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'description'  => $content[$lang], 
              'pic'        => $new_file_name,
              'link'        => $link[$lang],
              'thumb'      => $thumbname, 
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );  
            $this->db->where('idmenu', $id);
            $edit = $this->db->update('content', $editdata); 
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
    function _save_kategoriartikel($id,$parent,$widthnya,$heightnya){
        //print_r($_POST);
        //die();
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $link = $this->input->post('link');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('content');
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/content/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'content_'.$random_digit."_".$file_edit;
            $folder       = 'content';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = $widthnya;
            $height       = $heightnya;
            $create_thumb = array(            
                'status' => TRUE,
                'width'  => 298, 
                'height' => 169
            ); 
            if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/content/'.$new_file_name)) {//if file moved to uploads folder
                $this->resize(FCPATH.'/uploads/content/'.$new_file_name, FCPATH.'/uploads/content/thumb_'.$new_file_name, 298, 169);
                $this->resize(FCPATH.'/uploads/content/'.$new_file_name, FCPATH.'/uploads/content/'.$new_file_name, $widthnya, $heightnya);
            }
            $thumb_filenya = 'thumb_'.$new_file_name;
        }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array( 
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'description'    => $content[$lang],    
              'pic'         => $new_file_name,
              'thumb'       => $thumb_filenya,  
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'link'        => $link[$lang],
              'cretime'    => date('Y-m-d H:i:s'),
              'creby'      => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('content', $inputdata);
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
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
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