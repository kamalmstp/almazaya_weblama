<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Postcategory extends Webadmin_Controller {
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
        $this->postcategory($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  function postcategory($id,$parent,$title){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
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
                $status = $this->_save_kategoriartikel($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_kategoriartikel($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `kategori_artikel` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('kategori_artikel',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('kategori_artikel',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData('kategori_artikel',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData('kategori_artikel',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('kategori_artikel',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and kategori_artikel.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and kategori_artikel.hapus = 0 and kategori_artikel.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and kategori_artikel.hapus = 0 and kategori_artikel.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT kategori_artikel.id,kategori_artikel.title,kategori_artikel.sister,kategori_artikel.thumb,kategori_artikel.pic, pages.title as pages FROM `kategori_artikel` LEFT JOIN pages ON kategori_artikel.sisterpages=pages.sister where kategori_artikel.idlanguage = '.$deflang.' AND  pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_artikel.idmenu='.$id.' order by kategori_artikel.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(kategori_artikel.id) as jumlah,kategori_artikel.id,kategori_artikel.title,kategori_artikel.sister,kategori_artikel.thumb,kategori_artikel.pic, pages.title as pages FROM `kategori_artikel` LEFT JOIN pages ON kategori_artikel.sisterpages=pages.sister where kategori_artikel.idlanguage = '.$deflang.' AND  pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_artikel.idmenu='.$id.' order by kategori_artikel.posisi asc')->result();        
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNewBase('kategori_artikel',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('kategori_artikel',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('kategori_artikel',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $title;
          $data['page']    = 'kategoriartikel';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _save_kategoriartikel($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            if (count($_POST['pages']) > 0){
                $otherpages = implode(',', $_POST['pages']);
            }
        }
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('kategori_artikel');
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/kategori_artikel/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `kategori_artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
          if($ceklink[0]->jumlah != 0){
            $newlink = $link[$lang].$ceklink[0]->jumlah;
          }else{
            $newlink = $link[$lang];
          }
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'kategori_artikel_'.$random_digit."_".$file_edit;
            $folder       = 'kategori_artikel';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 900;
            $height       = 510;
            $create_thumb = array(            
                'status' => TRUE,
                'width'  => 298, 
                'height' => 169
            ); 
            if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/kategori_artikel/'.$new_file_name)) {//if file moved to uploads folder
                $this->resize(FCPATH.'/uploads/kategori_artikel/'.$new_file_name, FCPATH.'/uploads/kategori_artikel/thumb_'.$new_file_name, 298, 169);
                $this->resize(FCPATH.'/uploads/kategori_artikel/'.$new_file_name, FCPATH.'/uploads/kategori_artikel/'.$new_file_name, 402, 273);
            }
            $thumb_filenya = 'thumb_'.$new_file_name;
        }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'sisterpages' => $idpages,
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link_ori'    => $link[$lang], 
              'link'       => $newlink,  
              'description'    => $content[$lang],    
              'pic'        => $new_file_name,
              'thumb'      => $thumb_filenya,  
              'idmenu'      => $id,  
              'parent_menu'      => $parent,  
              'sister'     => $sister,
              'cretime'    => date('Y-m-d H:i:s'),
              'creby'      => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('kategori_artikel', $inputdata);
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
    function _edit_kategoriartikel(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Pages : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          $picname   = $this->input->post('oldpic'.$lang);
          $thumbname = $this->input->post('oldthumb'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'banner_'.$random_digit."_".$file_edit;
            $folder       = 'banner';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 944;
            $height       = 340;
            $create_thumb = array(            
              'status' => TRUE,
              'width'  => 105, 
              'height' => 70
            ); 
            $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
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
            $editdata = array(            
              'idpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link'       => $link[$lang],  
              'pic'        => $picname,
              'thumb'      => $thumbname, 
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($id[$lang]);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('kategori_artikel', $editdata); 
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