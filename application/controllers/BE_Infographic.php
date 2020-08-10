<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Infographic extends Webadmin_Controller {
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
                $status = $this->_save_infographic($id,$parent);
                $data['status'] = $status;
              }
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_infographic($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `infographic` WHERE sister = '.$this->segs[5])->result_array(); 
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
                $data_row = $this->db->query('SELECT * FROM `infographic` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('infographic',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('infographic',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('infographic',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('infographic',$this->segs[5]);
              if ($unhide){
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
            $sqlwhere = "and deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT * FROM `infographic`  where idlanguage = '.$deflang.' '.$sqlwhere.' AND idmenu='.$id.' order by posisi desc LIMIT '.$start.','.$limit)->result_array();
            $data_rec_count = $this->db->query('SELECT * FROM `infographic` where idlanguage = '.$deflang.' '.$sqlwhere.' AND idmenu='.$id.' order by posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT foto.id,foto.title,foto.hidden,foto.deleted,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT foto.id,foto.title,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
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
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('infographic',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('infographic',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('infographic',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'infographic';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
          $data['current_menu']    = $link;
        $this->load->view('cms/main.php',$data); 
  }
  function _save_infographic($id,$parent){
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
        $sister = $this->_nextAI('infographic');
        $posisi = $this->_nextPosisi('infographic',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/infographic/'; //Declaring Path for uploaded images
        //print_r($_POST);
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `infographic` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                    $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                    $newlink = $link[$lang];
                }
            }else{
                $newlink = "";
            }
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/infographic/'.$new_file_name);
                $this->resize_crop_image(272,272,FCPATH.'/uploads/infographic/'.$new_file_name,FCPATH.'/uploads/infographic/resize/'.$new_file_name,80);
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(    
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,     
                    'pic'         => $new_file_name,
                    'idmenu'      => $id,  
                    'parent_menu' => $parent,  
                    'sister'      => $sister,
                    'posisi'      => $posisi,
                    'cretime'     => date('Y-m-d H:i:s'),
                    'creby'       => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('infographic', $inputdata);
                $new_file_name = "";
                $new_file_name2 = "";
                $thumb_filenya = "";
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
    function _edit_infographic(){
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('infographic');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `infographic` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/infographic/'.$new_file_name);
                $this->resize_crop_image(272,272,FCPATH.'/uploads/infographic/'.$new_file_name,FCPATH.'/uploads/infographic/resize/'.$new_file_name,80);
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'pic'         => $new_file_name,
                    'cretime'     => date('Y-m-d H:i:s'),
                    'creby'       => $this->session->userdata('username')
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('infographic', $editdata); 
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
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    	$imgsize = getimagesize($source_file);
    	$width = $imgsize[0];
    	$height = $imgsize[1];
    	$mime = $imgsize['mime'];
    	switch($mime){
    		case 'image/gif':
    			$image_create = "imagecreatefromgif";
    			$image = "imagegif";
    			break;
    		case 'image/png':
    			$image_create = "imagecreatefrompng";
    			$image = "imagepng";
    			$quality = 7;
    			break;
    		case 'image/jpeg':
    			$image_create = "imagecreatefromjpeg";
    			$image = "imagejpeg";
    			$quality = 80;
    			break;
    		default:
    			return false;
    			break;
    	}
    	$dst_img = imagecreatetruecolor($max_width, $max_height);
    	$src_img = $image_create($source_file);
    	$width_new = $height * $max_width / $max_height;
    	$height_new = $width * $max_height / $max_width;
    	//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    	if($width_new > $width){
    		//cut point by height
    		$h_point = (($height - $height_new) / 2);
    		//copy image
    		imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    	}else{
    		//cut point by width
    		$w_point = (($width - $width_new) / 2);
    		imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    	}
    	$image($dst_img, $dst_dir, $quality);
    	if($dst_img)imagedestroy($dst_img);
    	if($src_img)imagedestroy($src_img);
    }
}
?>