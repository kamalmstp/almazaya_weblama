<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Siswa extends Webadmin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
    $this->segs = $this->uri->segment_array();
    $this->admin = "webadmin";
    $this->data['webadmin'] = $this->admin;
    $this->data['controller'] = $this;
    $this->load->library('excel');
  }
    public function index(){   
        if (isset($_POST["importn"])){
            if (isset($_FILES['importnya']['name']) AND $_FILES['importnya']['name'] != '') {
                $filename   = strtolower($_FILES['importnya']['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['importnya']['tmp_name'], FCPATH.'/uploads/siswa_excel/'.$new_file_name);
            }
            
            $objPHPExcel = new PHPExcel(); 
            
    		$url = base_url('/uploads/siswa_excel/'.$new_file_name);
    		$filecontent = file_get_contents($url);
    		$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
    		file_put_contents($tmpfname,$filecontent);
    		
    		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    		$excelObj = $excelReader->load($tmpfname);
    		$worksheet = $excelObj->getSheet(0);
    		$lastRow = $worksheet->getHighestRow();
    		
    	
    		for ($row = 2; $row <= $lastRow; $row++) {
    			 $inputdata = array(            
                    'nis'    => $worksheet->getCell('A'.$row)->getValue(),
                    'userid'   => $worksheet->getCell('B'.$row)->getValue(),
                    'nama_lengkap' => $worksheet->getCell('C'.$row)->getValue(),
                    'jenis_kelamin' => $worksheet->getCell('d'.$row)->getValue(),
                    'kelas' => $worksheet->getCell('E'.$row)->getValue(),
                    'no_hp' => $worksheet->getCell('F'.$row)->getValue(),
                    'nisn' => $worksheet->getCell('G'.$row)->getValue(),
                    'tempat_lahir' => $worksheet->getCell('H'.$row)->getValue(),
                    'nama_wali' => $worksheet->getCell('I'.$row)->getValue(),
                    'email' => $worksheet->getCell('J'.$row)->getValue(),
                    'rfid' => $worksheet->getCell('K'.$row)->getValue(),
                    'alamat' => $worksheet->getCell('L'.$row)->getValue(),
                    'fingerprint' => $worksheet->getCell('M'.$row)->getValue(),
                  );     
                  $saved = $this->db->insert('siswa', $inputdata);
    			
    		}
            die();	
        }
        // Create your database query
        if(isset($_GET["export"])){
            $data_rec = $this->db->query('SELECT * FROM `registration` where 1=1 order by  uid desc')->result_array();
            // Execute the database query
            // Instantiate a new PHPExcel object
            $objPHPExcel = new PHPExcel(); 
            // Set the active Excel worksheet to sheet 0
            $objPHPExcel->setActiveSheetIndex(0); 
            // Initialise the Excel row number
            $rowCount = 2; 
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', "Tanggal"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', "Tempat Tanggal Lahir");
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', "Alamat");
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', "Kelurahan");
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', "Kecamatan");
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', "Kota");
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', "Jenis Kelamin");
            $objPHPExcel->getActiveSheet()->SetCellValue('I1', "Asal Sekolah");
            $objPHPExcel->getActiveSheet()->SetCellValue('J1', "Tahun Kelulusan");
            $objPHPExcel->getActiveSheet()->SetCellValue('K1', "Telepon");
            $objPHPExcel->getActiveSheet()->SetCellValue('L1', "Nama Bapak");
            $objPHPExcel->getActiveSheet()->SetCellValue('M1', "Pekerjaan Bapak");
            $objPHPExcel->getActiveSheet()->SetCellValue('N1', "Nama Ibu");
            $objPHPExcel->getActiveSheet()->SetCellValue('O1', "Pekerjaan Ibu");
            $styleArray = array(
        'font' => array(
            'bold' => true,
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    );
            $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);
            foreach ($data_rec as $row){
                // Set cell An to the "name" column from the database (assuming you have a column called name)
                //    where n is the Excel row number (ie cell A1 in the first row)
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['crdate']); 
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['nama']); 
                // Set cell Bn to the "age" column from the database (assuming you have a column called age)
                //    where n is the Excel row number (ie cell A1 in the first row)
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['tempatlahir'].", ". $row['tanggallahir']); 
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['alamat']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['kelurahan']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['kecamatan']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['kota']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['jeniskelamin']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['asalsekolah']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $row['tahunkelulusan']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $row['telp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row['nama_bapak']);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row['pekerjaan_bapak']);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $row['nama_ibu']);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $row['pekerjaan_ibu']);
                // Increment the Excel row counter
                $rowCount++; 
            } 
            // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Limesurvey_Results.xls"'); 
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
            $objWriter->save('php://output');
        }
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
            $status = $this->_save_contactmail();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_contactmail();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,name,email FROM `contactmail` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('contactmail',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('contactmail',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE contactmail SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/contactmail', 'refresh');
          }
        }else{
          redirect('/webadmin/contactmail', 'refresh');
        }
      }else{
        redirect('/webadmin/contactmail', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $sqlwhere = "";
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        //$sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        //$sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT * FROM `siswa` where 1=1 '.$sqlwhere.' order by  uid desc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `siswa` where 1=1 '.$sqlwhere.' order by uid desc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      //echo "<pre>";
      //print_r($data_rec);
    }
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['parent'] = $parent;
    $data['current_menu']    = $link;
    $data['submenu'] = FALSE;
    $url_module = $this->segs[2];
    $data['url_module'] = $url_module;
    $data['title'] = $title;
    $data['page'] = 'siswa';
    $data['tipe'] = '';
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