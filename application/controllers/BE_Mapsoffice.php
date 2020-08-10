<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Mapsoffice extends Webadmin_Controller {
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
        $this->mapsoffice($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  function mapsoffice($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        $idlang  = $this->input->post('idlang');
        $address  = $this->input->post('address');
        if (isset($_POST["latitude"])){
            $data_rec = $this->db->query('SELECT * FROM `maps_office`')->result_array();
            //print_r($data_rec);
            if (count($data_rec) == 0){
                foreach ($idlang as $lang) {
                    $inputdata = array(  
                        'idlanguage'      => $lang, 
                        'latitude'      => $_POST["latitude"], 
                        'longitude'      => $_POST["longitude"],
                        'address'      => $_POST["address".$lang]
                    );     
                    $saved = $this->db->insert('maps_office', $inputdata);
                }
            }else{
                foreach ($idlang as $lang) {
                    $editdata = array(  
                      'latitude'      => $_POST["latitude"], 
                      'longitude'      => $_POST["longitude"],
                      'address'      => $_POST["address".$lang]
                    );     
                    $this->db->where('idlanguage', $lang);
                    $edit = $this->db->update('maps_office', $editdata); 
                }
            }
            $data["status"]["success"] = TRUE;
        }
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT * FROM `maps_office`')->result_array();  
          //print_r($data_rec);
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu']    = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'maps_office';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
}
?>