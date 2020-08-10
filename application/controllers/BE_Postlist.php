<?php
date_default_timezone_set("Asia/Jakarta");

class BE_Postlist extends Webadmin_Controller {
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
        $this->postlist($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  function postlist($id,$parent,$title){
        
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
                $status = $this->_save_postlist($id,$parent);
                $data['status'] = $status;
              }
              
              $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array(); 
              
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_postlist($id,$parent);
                  $data['status'] = $status;
                }
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `artikel` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'adsbanner'){
                
                if ( $_POST){
                    if(isset($_POST["sidebar_ads_global"])){
                        $status = $this->_adsbanner_edit();
                        $data['status'] = $status;
                    }
                    if(isset($_POST["sidebar_ads_global_top"])){
                        $status = $this->_adsbanner_top_edit();
                        $data['status'] = $status;
                    }
                    if(isset($_POST["sidebar_ads_global_bottom"])){
                        $status = $this->_adsbanner_bottom_edit();
                        $data['status'] = $status;
                    }
                }
                
                if (isset($_GET["removeside"])){
                    $editdata = array(  
                        'link_ads_banner'      => '', 
                        'ads_side_banner'      => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                if (isset($_GET["removetop"])){
                    $editdata = array(  
                        'link_ads_banner_top'      => '', 
                        'ads_banner_top'      => '',
                        'ads_banner_top_m' => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                if (isset($_GET["removebottom"])){
                    $editdata = array(  
                        'link_ads_banner_bottom'      => '', 
                        'ads_banner_bottom'      => '',
                        'ads_banner_bottom_m' => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `artikel` WHERE sister = '.$this->segs[5])->result_array();
                
                 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
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
                $deleted = $this->deleteData('artikel',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('artikel',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('artikel',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
                
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('artikel',$this->segs[5]);
              
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('artikel',$this->segs[5]);
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
            
            $sqlwhere = "and artikel.deleted = 0 and artikel.hapus=0";
            $data['statuspage'] = 'publish';
            
            
            
            
            
            $limit = 10;
            
            if(isset($_GET["show"])){
                $limit = 1000000;
            }
            
            if (isset($_GET["page"])){
                
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            
            $data_rec = $this->db->query('SELECT artikel.id,artikel.title,artikel.hidden,artikel.deleted,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' order by artikel.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT artikel.id,artikel.title,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' order by artikel.posisi desc')->result_array();
            
            
            if (isset($_GET['cari']))
            {
                $data_rec = $this->db->query('SELECT artikel.id,artikel.title,artikel.hidden,artikel.deleted,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.title LIKE "%'.$_GET["keyword"].'%" AND artikel.idmenu='.$id.' order by artikel.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT artikel.id,artikel.title,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' AND artikel.title LIKE "%'.$_GET["keyword"].'%" order by artikel.posisi desc')->result_array();
            
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
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }        
            if (count($query_string) > 0)
            {
                $config['suffix'] = '&' . http_build_query($query_string, '', "&");
                $config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
            } 
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
            
            $data['count_publish']    = $this->countPublishNewBase('artikel',$deflang,$id);
            $data['count_draft']      = $this->countDraftNewBase('artikel',$deflang,$id);
            $data['count_trash']      = $this->countTrashNewBase('artikel',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          
        $data['active']  = $parent;
        $data['active2'] = $title;
        $data['page']    = 'postlist';
        $data['url_module']    = $this->segs[2];
        $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_postlist($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $metatitle    = $this->input->post('metatitle');
        $show     = $this->input->post('show');
        $metadescription    = $this->input->post('metadescription');
        $cat     = $this->input->post('idmodule');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('artikel');
        $posisi = $this->_nextPosisi('artikel',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        
        
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/artikel/'; //Declaring Path for uploaded images
        
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
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
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/thumb_'.$new_file_name, 78, 77);
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/'.$new_file_name, 345, 386);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name2);
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                
                'idlanguage'  => $lang, 
                'title'       => $title[$lang], 
                'link_ori'    => $link[$lang], 
                'link'        => $newlink,  
                'description' => $content[$lang],    
                'pic'         => $new_file_name,
                'pic2'        => $new_file_name2,
                'thumb'       => $thumb_filenya,  
                'idmenu'      => $id,  
                'parent_menu' => $parent,  
                'show'        => $show[$lang],
                'sister'      => $sister,
                'posisi'      => $posisi,
                'cretime'     => date('Y-m-d H:i:s'),
                'crdate_set'  => $tgl_modif,
                'meta_title'  => $metatitle[$lang],
                'meta_description' => $metadescription[$lang],
                'creby'       => $this->session->userdata('username'),
                'cat'       => $cat
                );     
                $saved = $this->db->insert('artikel', $inputdata);
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
      
      
    function _edit_postlist(){
        
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $show     = $this->input->post('show');
        $cat     = $this->input->post('idmodule');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        $metatitle    = $this->input->post('metatitle');
        $metadescription    = $this->input->post('metadescription');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $new_file_name2   = $this->input->post('oldpic2'.$lang);
            $thumb_filenya = $this->input->post('oldthumb'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
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
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/thumb_'.$new_file_name, 78, 77);
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/'.$new_file_name, 345, 386);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if (isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name2);
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'description' => $content[$lang],    
                    'pic'         => $new_file_name,
                    'pic2'        => $new_file_name2,
                    'show'        => $show[$lang],
                    'thumb'       => $thumb_filenya, 
                    'meta_title'  => $metatitle[$lang],
                    'meta_description' => $metadescription[$lang],
                    'cretime'     => date('Y-m-d H:i:s'),
                    'crdate_set'  => $tgl_modif,
                    'creby'       => $this->session->userdata('username'),
                    'cat'         => $cat
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('artikel', $editdata); 
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
    
}
?>