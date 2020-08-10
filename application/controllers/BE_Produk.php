<?php
date_default_timezone_set("Asia/Jakarta");

class BE_Produk extends Webadmin_Controller {
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
        $this->produk($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  function produk($id,$parent,$title,$link){
        
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
                $status = $this->_save_produk($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 34 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_produk($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `produk` WHERE sister = '.$this->segs[5])->result_array(); 
                
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 34 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
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
                $data_row = $this->db->query('SELECT * FROM `produk` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('produk',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
                
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('produk',$this->segs[5]);
              
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('produk',$this->segs[5]);
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
          $table = "produk";
            $sqlwhere = "and $table.deleted = 0";
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
            
            
            
            $data_rec = $this->db->query('SELECT produk.id,produk.title,produk.hidden,produk.deleted,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister  where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND produk.idmenu='.$id.' order by produk.posisi DESC LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT produk.id,produk.title,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND produk.idmenu='.$id.' order by produk.posisi DESC')->result_array();
            
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT produk.id,produk.title,produk.hidden,produk.deleted,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister  where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND produk.idmenu='.$id.' AND produk.title LIKE "%'.$_GET["keyword"].'%" order by produk.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT produk.id,produk.title,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND produk.idmenu='.$id.' AND produk.title LIKE "%'.$_GET["keyword"].'%"  order by produk.posisi desc')->result_array();
            
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
          $data['current_menu']    = $link;
          $data['count_publish']    = $this->countPublishNewBase('produk',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('produk',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('produk',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'produk';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_produk($id,$parent){
         
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            $otherpages = implode(',', $_POST['pages']);
        }
        
        
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $short_description   = $this->input->post('short_description');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $pic2     = $this->input->post('pic2');
        $icon     = $this->input->post('icon');
        $product_detail = $this->input->post('product_detail');
        $shipping_return = $this->input->post('shipping_return');
        $price = $this->input->post('price');
        $weight = $this->input->post('weight');
        $linkyoutube = $this->input->post('linkyoutube');
        //echo "<pre>";
        //print_r($_POST);
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('produk');
        $posisi = $this->_nextPosisi('produk',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Main Pages : Must be filled</li>";
        }
        
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'uploads/produk/'; //Declaring Path for uploaded images
        
        $new_file_name = "";
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `produk` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                $newlink = $link[$lang];
                }
          }
          
          $picname   = "";
          $thumbname = "";
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
       
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'produk_'.$random_digit."_".$newlink;
                $folder       = 'produk';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 289;
                $height       = 400;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                
                $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
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
          
          $picname2   = "";
          $thumbname2 = "";
          if ($step1 == TRUE AND isset($_FILES['picyoutube'.$lang]['name']) AND $_FILES['picyoutube'.$lang]['name'] != '') {
       
                $filenameold2   = strtolower($_FILES['picyoutube'.$lang]['name']);
                $file_edit2     = str_replace(" ","_",$filenameold2);
                $random_digit2  = rand(000,999);
                $new_file_name2 = 'popup_'.$random_digit2."_".$newlink;
                $folder       = 'produk';
                $filename2     = $new_file_name2;
                $fieldname    = 'picyoutube'.$lang;
                $resizable    = TRUE;
                $width        = 484;
                $height       = 337;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                
                $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname2   = $hasilupload['filename'];
                  $thumbname2 = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname2 = "";
                }
          
          }
          $picname3   = "";
          $thumbname3 = "";
          if ($step1 == TRUE AND isset($_FILES['icon'.$lang]['name']) AND $_FILES['icon'.$lang]['name'] != '') {
       
                $filenameold3   = strtolower($_FILES['icon'.$lang]['name']);
                $file_edit2     = str_replace(" ","_",$filenameold3);
                $random_digit3  = rand(000,999);
                $new_file_name3 = 'icon_'.$random_digit3."_".$newlink;
                $folder       = 'produk';
                $filename2     = $new_file_name3;
                $fieldname    = 'icon'.$lang;
                $resizable    = TRUE;
                $width        = 401;
                $height       = 400;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 401, 
                    'height' => 400
                ); 
                
                $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname3   = $hasilupload['filename'];
                  $thumbname3 = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname3 = "";
                }
          
          }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'sisterpages' => $idpages,
              'otherpages'  => $otherpages, 
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'link_ori'    => $this->slugify($title[$lang]), 
              'link'        => $newlink,  
              'description' => $content[$lang],    
              'short_description' => $short_description[$lang],
              'product_detail' => $product_detail[$lang],
              'shipping_return' => $shipping_return[$lang],
              'linkyoutube' => $linkyoutube[$lang],
              'pic'         => $picname, 
              'price' => $price,
              'weight' => $weight,
              'pic2'         => $picname2, 
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('produk', $inputdata);
          }
          $filename = "";
          
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
    function _edit_produk(){
         //echo '<pre>';
         //print_r($_POST);
         //print_r($_FILES);
         //die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            $otherpages = implode(',', $_POST['pages']);
        }
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic1');
        $pic2     = $this->input->post('pic21');
        $icon     = $this->input->post('icon');
        $linkkalbe = $this->input->post('linkkalbe');
        $draft   = $this->input->post('draft');
        $short_description   = $this->input->post('short_description');
        $content   = $this->input->post('content');
        $product_detail = $this->input->post('product_detail');
        $shipping_return = $this->input->post('shipping_return');
        $linkyoutube = $this->input->post('linkyoutube');
        $price = $this->input->post('price');
        $weight = $this->input->post('weight');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('produk');
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
          if ($link[$lang] != ""){
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `produk` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$id[$lang])->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang]."-".$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
          }
          $picname   = $this->input->post('oldpic'.$lang);
          $picname2   = $this->input->post('oldpic2'.$lang);
          $icon   = $this->input->post('icon'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
            //echo strtolower($_FILES['pic2'.$lang]['name']);
            $filenameold2   = strtolower($_FILES['pic2'.$lang]['name']);
            $file_edit2     = str_replace(" ","_",$filenameold2);
            $new_file_name2 = 'produk_detail_'.$newlink;
            $folder       = 'produk';
            $filename2     = $new_file_name2;
            $fieldname    = 'pic2'.$lang;
            $resizable    = TRUE;
            $width        = 693;
            $height       = 382;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname2   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname2 = "";
            }
          }
          
          
         
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'produk_'.$newlink;
            $folder       = 'produk';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 289;
            $height       = 400;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
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
          
          if ($step1 == TRUE AND isset($_FILES['icon'.$lang]['name']) AND $_FILES['icon'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['icon'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'icon_produk_'.$newlink;
            $folder       = 'produk';
            $filename     = $new_file_name;
            $fieldname    = 'icon'.$lang;
            $resizable    = TRUE;
            $width        = 401;
            $height       = 400;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 401, 
                'height' => 401
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $icon   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $icon = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'sisterpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link_ori'    => $this->slugify($title[$lang]), 
              'link'        => $newlink,
              'product_detail' => $product_detail[$lang],
              'shipping_return' => $shipping_return[$lang],
              'linkyoutube' => $linkyoutube[$lang],
              'pic'        => $picname,
              'pic2'        => $picname2,
              'icon'        => $icon,
              'short_description' => $short_description[$lang],
              'description' => $content[$lang],
              'price' => $price,
              'weight' => $weight,
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($editdata);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('produk', $editdata); 
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