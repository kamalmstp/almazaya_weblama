<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->key = 'eternaleaf-olshp';
        $this->load->library('encrypt');
        $this->data["key"] = $this->key;
    }
    public function index(){
    }
    function get_karir_desc(){
        $pagenya = $this->db->query('SELECT description FROM joblist a WHERE id='.$_POST["id"])->result_array();
        echo $pagenya[0]["description"];
        die();
    }
    function captcha(){
        $captcha = new SimpleCaptcha();
        $session_register = $this->session->userdata('register');
        $session_register['captcha_text'] = $this->GetRandomCaptchaText(5);
        $captcha->CreateImage($session_register['captcha_text']);
        //echo $this->GetRandomCaptchaText(5);
    }
    function add_confirmation(){
        
        $data_session = $this->session->all_userdata();
        $cart = $this->db->query('SELECT uid,reference_order FROM cart a WHERE uid_user='.$data_session["login_user"]["eternaleaf_user_login"])->result_array();
        $this->data["cart"] = $cart;
        $this->load->view('popup_confirmation',$this->data);
    }
    function cekconfirmationpayment(){
        
        $data_session = $this->session->all_userdata();
        $cart = $this->db->query('SELECT a.*,b.reference_order FROM confirmation_payment a LEFT JOIN cart b ON a.uid_cart=b.uid WHERE a.uid_cart='.$_GET["uid"])->result_array();
        //echo "<pre>";
        //print_r($cart);
        $this->data["cart"] = $cart;
        $this->load->view('cekconfirmationpayment',$this->data);
    }
    function saveconfirmation(){
        
        $data_session = $this->session->all_userdata();
        $title = $_POST["title"];
        $message = $_POST["message"];
        
        $new_file_name = "";
        if ($_FILES['file']['name'] != ""){
            $filenameold   = strtolower($_FILES['file']['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = date("YmdHis");
            $new_file_name = 'confirmation_'.$random_digit."_".$file_edit;
            move_uploaded_file($_FILES['file']['tmp_name'], FCPATH.'/uploads/confirmation_payment/'.$new_file_name);
        }
        
        $inputdata = array(    
            'crdate' => date('Y-m-d H:i:s'),
            'uid_cart' => $_POST["cart"],
            'uid_account'   => $data_session["login_user"]["eternaleaf_user_login"],
            'title'   => $title,
            'message'   => $message,
            'file'   => $new_file_name
        );     
        $saved = $this->db->insert("confirmation_payment", $inputdata);
        $insert_id = $this->db->insert_id();
        if ($insert_id > 0){
            $cart = $this->db->query('SELECT a.*,b.reference_order FROM confirmation_payment a LEFT JOIN cart b ON a.uid_cart=b.uid WHERE a.uid='.$insert_id)->result_array();
            $reference_order = $cart[0]["reference_order"];
            $config = Array(       
                'protocol' => 'sendmail',
                'smtp_timeout' => '4',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $data = array(
                'cart' => $cart
            );
            $this->email->from('customer@eternaleaf.com', 'Eternaleaf');
            $this->email->to("support@eternaleaf.com");  // replace it with receiver mail id
            $this->email->cc('Adi@trinitypratama.com,sisca@trinitypratama.com,Sonya@trinitypratama.com,vissia@trinitypratama.com');
            $this->email->bcc("basuki@brightstars.co.id"); 
            $this->email->subject("Payment Confirmation [$reference_order]");
            $body = $this->load->view('paymentconfirmation-mail.php',$data,TRUE);
            $this->email->message($body);  
            $this->email->send();
        }
        
        echo $insert_id;
    }
    function captcha_contact(){
        $captcha = new SimpleCaptcha();
        
        $session_contact = $this->session->userdata('contact');
        $captchanya = $this->GetRandomCaptchaText(5);
        $this->session->userdata['captcha_text_contact'] = $captchanya;
        $captcha->CreateImage($captchanya);
        //echo $this->GetRandomCaptchaText(5);
    }
    function captcha_forgot(){
        $captcha = new SimpleCaptcha();
        
        $captchanya = $this->GetRandomCaptchaText(5);
        $this->session->userdata['captcha_text_forgot'] = $captchanya;
        $captcha->CreateImage($captchanya);
        //echo $this->GetRandomCaptchaText(5);
    }
    function saveaddress(){
        $province = $this->xss_filter($_POST["province"]);
        $city = $this->xss_filter($_POST["city"]);
        $subdistrict = $this->xss_filter($_POST["subdistrict"]);
        $address = $this->xss_filter($_POST["address"]);
        $postal_code = $this->xss_filter($_POST["postal_code"]);
        $data_session = $this->session->all_userdata();
        if ($_POST["uid"] != ""){
            $uid = $this->encrypt->decodeUrl($_POST["uid"],$this->key);
            $editdata = array(    
                'uid_province'   => $province,
                'uid_city'   => $city,
                'uid_subdistrict'   => $subdistrict,
                'address_value'   => $address,
                'postal_code'   => $postal_code
            );     
                           
                  
            $this->db->where('uid', $uid);
            $edit = $this->db->update("address", $editdata); 
            echo 1;  
        }else{
            $inputdata = array(    
                'crdate' => date('Y-m-d H:i:s'),
                'uid_province'   => $province,
                'uid_city'   => $city,
                'uid_subdistrict'   => $subdistrict,
                'address_value'   => $address,
                'postal_code'   => $postal_code,
                'default' => 1,
                'uid_account' => $data_session["login_user"]["eternaleaf_user_login"]
            );     
            $saved = $this->db->insert("address", $inputdata);
            echo $saved;
        }
        
    }
    function save_add_address(){
        $label_address = $this->xss_filter($_POST["label_address"]);
        $province = $this->xss_filter($_POST["province"]);
        $city = $this->xss_filter($_POST["city"]);
        $subdistrict = $this->xss_filter($_POST["subdistrict"]);
        $address = $this->xss_filter($_POST["address"]);
        $postal_code = $this->xss_filter($_POST["postal_code"]);
        $telepon = $this->xss_filter($_POST["telepon"]);
        $data_session = $this->session->all_userdata();
        $query_address = 'SELECT uid FROM address where uid_account = '.$data_session["login_user"]["eternaleaf_user_login"];
        $count_query_address = $this->db->query($query_address)->result_array();
        $default = 0;
        if (count($count_query_address) == 0){
            $default = 1;
        }
        if ($_POST["uid"] != ""){
            $uid = $this->encrypt->decodeUrl($_POST["uid"],$this->key);
            $editdata = array(    
                'uid_province'   => $province,
                'label_address'   => $label_address,
                'uid_city'   => $city,
                'uid_subdistrict'   => $subdistrict,
                'address_value'   => $address,
                'telepon' => $telepon,
                'postal_code'   => $postal_code,
                'default'   => $default
            );     
                           
                  
            $this->db->where('uid', $uid);
            $edit = $this->db->update("address", $editdata); 
            echo 1;  
        }else{
            $inputdata = array(    
                'crdate' => date('Y-m-d H:i:s'),
                'label_address'   => $label_address,
                'uid_province'   => $province,
                'uid_city'   => $city,
                'uid_subdistrict'   => $subdistrict,
                'address_value'   => $address,
                'postal_code'   => $postal_code,
                'telepon' => $telepon,
                'uid_account' => $data_session["login_user"]["eternaleaf_user_login"],
                'default'   => $default
            );     
            $saved = $this->db->insert("address", $inputdata);
            echo $saved;
        }
    }
    function update_current_address_submit(){
        $label_address = $this->xss_filter($_POST["address"]);
        $province = $this->xss_filter($_POST["province"]);
        $city = $this->xss_filter($_POST["city"]);
        $subdistrict = $this->xss_filter($_POST["subdistrict"]);
        $address = $this->xss_filter($_POST["address"]);
        $postal_code = $this->xss_filter($_POST["postal_code"]);
        $telepon = $this->xss_filter($_POST["telepon"]);
        $data_session = $this->session->all_userdata();
        
        if ($_POST["uid"] != ""){
            $uid = $this->encrypt->decodeUrl($_POST["uid"],$this->key);
            $editdata = array(    
                'uid_province'   => $province,
                'label_address'   => $label_address,
                'uid_city'   => $city,
                'uid_subdistrict'   => $subdistrict,
                'address_value'   => $address,
                'telepon' => $telepon,
                'postal_code'   => $postal_code
            );     
                           
                  
            $this->db->where('uid', $uid);
            $edit = $this->db->update("address", $editdata); 
        }
        echo 1;  
    }
    function saveaccount(){
        $fullname = $this->xss_filter($_POST["fullname"]);
        $day = $this->xss_filter($_POST["day"]);
        $month = $this->xss_filter($_POST["month"]);
        $year = $this->xss_filter($_POST["year"]);
        $email = $this->xss_filter($_POST["email"]);
        $telepon = $this->xss_filter($_POST["telepon"]);
        
        $editdata = array(    
            'fullname'   => $fullname,
            'birthdate'   => $year."-".$month."-".$day,
            'telepon'   => $telepon,
            'email'   => $email
        );     
                       
        $data_session = $this->session->all_userdata();      
        $this->session->userdata['login_user']['eternaleaf_fullname'] = $fullname;
        $this->db->where('uid', $data_session["login_user"]["eternaleaf_user_login"]);
        $edit = $this->db->update("account", $editdata); 
        echo 1;
    }
    function savepassword(){
        $data_session = $this->session->all_userdata();
        $oldpassword = $this->xss_filter($_POST["oldpassword"]);
        $email = $this->xss_filter($data_session["login_user"]["eternaleaf_email"]);
        $newpassword = $this->xss_filter($_POST["password"]);
        $confirmpassword = $this->xss_filter($_POST["confirmpassword"]);
        
        if ($newpassword != $confirmpassword){
            echo "00";
            die();
        }
        
        $sql  = "SELECT * FROM account WHERE email = ? AND password = ? AND active = ?";
        $postnya = array($email, sha1(md5($oldpassword)), 1);
        $query = $this->db->query($sql, $postnya)->result_array();
            
        if (count($query) > 0){
            $editdata = array(    
                'password'   => sha1(md5($newpassword)),
            );     
            $this->db->where('uid', $data_session["login_user"]["eternaleaf_user_login"]);
            $edit = $this->db->update("account", $editdata); 
            echo "1";
        }else{
            echo "0";
        }
    }    
    function GetRandomCaptchaText($length = null) {
        if (empty($length)) {
            $length = rand($this->minWordLength, $this->maxWordLength);
        }

        $words  = "abcdefghijlmnopqrstvwyz";
        $vocals = "aeiou";

        $text  = "";
        $vocal = rand(0, 1);
        for ($i=0; $i<$length; $i++) {
            if ($vocal) {
                $text .= substr($vocals, mt_rand(0, 4), 1);
            } else {
                $text .= substr($words, mt_rand(0, 22), 1);
            }
            $vocal = !$vocal;
        }
        return $text;
    }
    function cek_captcha(){
        
        $captcha = $this->xss_filter($_POST["captcha"]);
        $nama = $this->xss_filter($_POST["nama"]);
        $email = $this->xss_filter($_POST["email"]);
        $pesan = $this->xss_filter($_POST["pesan"]);
        
        if ($captcha == $_SESSION["captcha"] && $nama != "" && $email != "" && $pesan != ""){
            $inputdata = array(            
                'name'   => $nama,
                'cretime' => date('Y-m-d H:i:s'),
                'email'   => $email,
                'pesan'   => $pesan
              );     
              $saved = $this->db->insert("contact", $inputdata);
              unset($_SESSION['captcha']);
              session_destroy();
              if($saved){
                echo $this->db->insert_id();
              }
        }else{
            echo 0;
        }
        die();
    }
    function ongkir(){
        $getorigin = $this->getorigin();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$getorigin&originType=city&destination=2087&destinationType=subdistrict&weight=1000&courier=jne",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 83d0bea707a458d2ca3ed9c23498e9cb"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        echo "<pre>";
        $key = array_search("REG", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        if ($key == ""){
            $key = array_search("CTC", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        }
        //print_r($data["rajaongkir"]["results"][0]["costs"]);
        print_r($data["rajaongkir"]["results"][0]["costs"][$key]["cost"]);
    }
    function update_province(){
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 83d0bea707a458d2ca3ed9c23498e9cb"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        
        $databaru = array();
        $a = 0;
        foreach ($data["rajaongkir"]["results"] as $datanya){
            $databaru[$a]["province_id"] = $datanya["province_id"];
            $databaru[$a]["province"] = $datanya["province"];
            $query_province = 'SELECT province_id FROM province where province_id = '.$datanya["province_id"].' AND province = "'.$datanya["province"].'"';
            $count_query_province = $this->db->query($query_province)->result_array();
            if (count($count_query_province) == 0){
                $inputdata = array(            
                    'province_id'   => $datanya["province_id"],
                    'province' => $datanya["province"]
                );     
                $saved = $this->db->insert("province", $inputdata);
                if($saved){
                    $databaru[$a]["status"] = "Insert Success";
                }
            }else{
                 $editdata = array(            
                    'province_id'   => $datanya["province_id"],
                    'province' => $datanya["province"]
                  );                    
                  $this->db->where('province_id', $datanya["province_id"]);
                  $edit = $this->db->update("province", $editdata);   
            }
            if ($a % 10 == 0){
                sleep(3);
            }
            $a++;
        }
        echo "<pre>";        
        print_r($databaru);
        die();
    }
    function get_province(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 83d0bea707a458d2ca3ed9c23498e9cb",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        
        
        $a = 0;
        
        echo "<pre>";        
        print_r($data);
        die();
    }
    function update_city(){
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 83d0bea707a458d2ca3ed9c23498e9cb"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        
        $databaru = array();
        $a = 0;
        
        foreach ($data["rajaongkir"]["results"] as $datanya){
            $databaru[$a]["city_id"] = $datanya["city_id"];
            $databaru[$a]["province_id"] = $datanya["province_id"];
            $databaru[$a]["province"] = $datanya["province"];
            $databaru[$a]["type"] = $datanya["type"];
            $databaru[$a]["city_name"] = $datanya["city_name"];
            $databaru[$a]["postal_code"] = $datanya["postal_code"];
            
            $query_city = 'SELECT city_id FROM city where city_id = '.$datanya["city_id"].' AND city_name = "'.$datanya["city_name"].'" AND type_city = "'.$datanya["type"].'"';
            $count_query_city = $this->db->query($query_city)->result_array();
            if (count($count_query_city) == 0){
                $inputdata = array(            
                    'city_id'   => $datanya["city_id"],
                    'province_id' => $datanya["province_id"],
                    'type_city' => $datanya["type"],
                    'city_name' => $datanya["city_name"],
                    'postal_code' => $datanya["postal_code"]
                );     
                $saved = $this->db->insert("city", $inputdata);
                if($saved){
                    $databaru[$a]["status"] = "Insert Success";
                }
            }else{
                 $editdata = array(            
                    'city_id'   => $datanya["city_id"],
                    'province_id' => $datanya["province_id"],
                    'type_city' => $datanya["type"],
                    'city_name' => $datanya["city_name"],
                    'postal_code' => $datanya["postal_code"]
                  );                    
                  $this->db->where('city_id', $datanya["city_id"]);
                  $edit = $this->db->update("city", $editdata);   
            }
            if ($a % 100 == 0){
                sleep(3);
            }
            $a++;
        }
        echo "<pre>";        
        print_r($databaru);
        die();
    }
    
    
    function update_district1   (){
        $query_district = 'SELECT subdistrict_id,subdistrict_name FROM subdistrict where city_id = '.$this->xss_filter($_POST["city_id"]);
        $count_artikel = $this->db->query($query_district)->result_array();
        if (count($count_artikel) > 0){
            echo json_encode($count_artikel);
        }else{
            $curl = curl_init();
            
            $city_id = $_POST["city_id"];
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://cdlab.co/rajaongkir/update_district.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "city_id=$city_id",
              
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
            }
            /*
            echo "<pre>";
            print_r($data["rajaongkir"]["results"]);
            
            die();
            */
            $databaru = array();
            $a = 0;
            
            foreach ($data["rajaongkir"]["results"] as $datanya){
                
                    $inputdata = array(            
                        'subdistrict_id'   => $datanya["subdistrict_id"],
                        'province_id' => $datanya["province_id"],
                        'province' => $datanya["province"],
                        'city_id' => $datanya["city_id"],
                        'city' => $datanya["city"],
                        'type' => $datanya["type"],
                        'subdistrict_name' => $datanya["subdistrict_name"]
                    );    
                    $saved = $this->db->insert("subdistrict", $inputdata);
                    if($saved){
                        $databaru[$a]["status"] = "Insert Success";
                    }
            }
            $query_district = 'SELECT subdistrict_id,subdistrict_name FROM subdistrict where city_id = '.$this->xss_filter($_POST["city_id"]);
            $count_artikel = $this->db->query($query_district)->result_array();
            echo json_encode($count_artikel);
        }
        
        
        die();
    }
    
    function update_district(){
        $query_district = 'SELECT subdistrict_id,subdistrict_name FROM subdistrict where city_id = '.$this->xss_filter($_POST["city_id"]);
        $count_artikel = $this->db->query($query_district)->result_array();
        if (count($count_artikel) > 0){
            echo json_encode($count_artikel);
        }else{
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://pro.rajaongkir.com/api/subdistrict?city=".$this->xss_filter($_POST["city_id"]),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "key: 83d0bea707a458d2ca3ed9c23498e9cb"
              ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
            }
            
            $databaru = array();
            $a = 0;
            
            foreach ($data["rajaongkir"]["results"] as $datanya){
                
                    $inputdata = array(            
                        'subdistrict_id'   => $datanya["subdistrict_id"],
                        'province_id' => $datanya["province_id"],
                        'province' => $datanya["province"],
                        'city_id' => $datanya["city_id"],
                        'city' => $datanya["city"],
                        'type' => $datanya["type"],
                        'subdistrict_name' => $datanya["subdistrict_name"]
                    );     
                    $saved = $this->db->insert("subdistrict", $inputdata);
                    if($saved){
                        $databaru[$a]["status"] = "Insert Success";
                    }
            }
            $query_district = 'SELECT subdistrict_id,subdistrict_name FROM subdistrict where city_id = '.$this->xss_filter($_POST["city_id"]);
            $count_artikel = $this->db->query($query_district)->result_array();
            echo json_encode($count_artikel);
        }
        
        
        die();
    }
    
    /*function cekresiCDLAB(){
        $data_session = $this->session->all_userdata();
        if (isset($data_session["login_user"]["eternaleaf_user_login"])){
            $resi = $_GET["resi"];
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://cdlab.co/rajaongkir/cekresi.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "resi=$resi",
              
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
            }
            /*echo "<pre>";        
            print_r($data);
            die();
            $data["resi"] = $data;
            $data["manifest"] = $data["rajaongkir"]["result"]["manifest"];
            $data["summary"] = $data["rajaongkir"]["result"]["summary"];
            $this->load->view('resi',$data);
        }
        
        
    }*/
    function cekresi(){
        $data_session = $this->session->all_userdata();
        if (isset($data_session["login_user"]["eternaleaf_user_login"])){
            $resi = $_GET["resi"];
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://pro.rajaongkir.com/api/waybill",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "waybill=$resi&courier=jne",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 83d0bea707a458d2ca3ed9c23498e9cb"
              ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response, true);
            }
            //echo "<pre>";        
            //print_r($data);
            $data["resi"] = $data;
            $data["manifest"] = $data["rajaongkir"]["result"]["manifest"];
            $data["summary"] = $data["rajaongkir"]["result"]["summary"];
            $this->load->view('resi',$data);
        }
        
        
    }
    function subscribe(){
        if ($_POST["email"]  != ""){
             if (preg_match ("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix ", $_POST [ 'email']))    {
                $query_email = 'SELECT id FROM subscribe where email LIKE "'.$_POST["email"].'"';
                $count_email = $this->db->query($query_email)->result_array();
                if (count($count_email) == 0){
                    $inputdata = array(            
                        'email'   => $_POST["email"],
                        'cretime' => date('Y-m-d H:i:s')
                    );     
                    $saved = $this->db->insert("subscribe", $inputdata);
                    if($saved){
                        echo $this->db->insert_id();
                    }
                }
                else{
                    echo -1;
                }
            }
             else{
                echo 0;
            } 
            
            
            
        }else{
            echo 0;
        }
        die();
    }
    function getartikelbypage()
    {
        $limit = 4;
        $sisterpage = $this->xss_filter($_POST["sisterpage"]);
        $fornext = $this->xss_filter($_POST["awalnya"]) + 4;
        $artikel = $this->db->query('SELECT a.description,a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$_POST["lang"].' AND a.title != "" AND (c.idpages='.$sisterpage.' OR c.otherpages LIKE "'.$sisterpage.'" OR c.otherpages LIKE "%,'.$sisterpage.'" OR c.otherpages LIKE "'.$sisterpage.',%") order by a.posisi DESC limit '.$_POST["awalnya"].','.$limit)->result_array();
        //echo 'SELECT a.title,a.thumb,a.pic,a.cretime,a.link as link_news,c.title as title_cat,d.link as link_detail FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$_POST["lang"].' AND a.title != "" order by a.crdate_set ASC limit '.$_POST["awalnya"].',4';
        $htmlstring = "";
        foreach ($artikel as $dt){
            $htmlstring .= "<li>";
            $htmlstring .= "<div class=\"category\">".$dt["title_cat"]."</div>";
            if ($dt["pic"] != ""){
                $htmlstring .= "<div class=\"image-article\"><img src=\"".base_url('uploads/artikel/'.$dt["pic"])."\" /></div>";
            }else{
                $htmlstring .= "<div class=\"image-article\"><img src=\"".base_url('uploads/artikel/noimage.png')."\" /></div>";
            }
            $htmlstring .= "<div class=\"title-list\">";
            $str = $dt["title"];
            if (strlen($dt["title"]) > 60){
                $str = wordwrap($dt["title"], 60);
                $str = explode("\n", $str);
                $str = $str[0] . '...';
            }
            $htmlstring .= "<h2><a title=\"".$dt["title"]."\" href=\"".base_url($_POST["codebahasa"]."/".$dt["link_detail"].'/'.$dt["link_news"])."\">".$str."</a></h2>";
            $htmlstring .= "</div>";
            $descriptionnya = strip_tags($dt["description"]);
            if (strlen($descriptionnya) > 150){
                $descriptionnya = substr($descriptionnya,0,150)."...";
            }
            $htmlstring .= "<div class=\"description-list\">";
            $htmlstring .= "".$descriptionnya."</div>";
            $htmlstring .= "<div class=\"selengkapnya-list\"><a href=\"".base_url($_POST["codebahasa"]."/".$dt["link_detail"].'/'.$dt["link_news"])."\">Selengkapnya &raquo;</a></div>";
            $htmlstring .= "</li>";
        }
        
        $count_artikel = $this->db->query('SELECT a.title FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$_POST["lang"].' AND a.title != "" AND (c.idpages='.$sisterpage.' OR c.otherpages LIKE "'.$sisterpage.'" OR c.otherpages LIKE "%,'.$sisterpage.'" OR c.otherpages LIKE "'.$sisterpage.',%") order by a.crdate_set ASC limit '.$fornext.',4')->result_array();
        if (count($count_artikel) > 0){
            $d = array('result' => $htmlstring, 'total_count_next' => count($count_artikel), 'query' => 'SELECT a.title FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$_POST["lang"].' AND a.title != "" AND (c.idpages='.$sisterpage.' OR c.otherpages LIKE "'.$sisterpage.'" OR c.otherpages LIKE "%,'.$sisterpage.'" OR c.otherpages LIKE "'.$sisterpage.',%") order by a.crdate_set ASC limit '.$fornext.',4');
        }else{
            $d = array('result' => $htmlstring, 'total_count_next' => 0,'query'=>'SELECT a.title FROM `artikel` a LEFT JOIN kategori_artikel c ON a.cat=c.id LEFT JOIN pages d ON c.idpages=d.id where a.deleted=0 AND a.hidden=0 AND a.idlanguage = '.$_POST["lang"].' AND a.title != "" order by a.crdate_set ASC limit '.$fornext.','.$limit);
        }
        
        echo json_encode($d);
    }
    function update_address()
    {
        $uid = 0;
        if (isset($_GET["xss"])){
            $uid = $this->encrypt->decodeUrl($_GET["xss"],$this->key);
        }
        $query = $this->db->query('SELECT province_id,province FROM province')->result_array();;
        $this->data["rec"] = $query;
        
        if ($uid > 0){
        $query_address = $this->db->query('SELECT * FROM address WHERE uid = '.$uid)->result_array();;
        $this->data["alamat"] = $query_address;
        
        $query_city = $this->db->query('SELECT * FROM city WHERE province_id = '.$query_address[0]["uid_province"])->result_array();;
        $this->data["city"] = $query_city;
        
        $query_district = $this->db->query('SELECT * FROM subdistrict WHERE city_id = '.$query_address[0]["uid_city"])->result_array();;
        $this->data["district"] = $query_district;
        }
        //echo "<pre>";
        //print_r($query_address);
                                        
        $this->load->view('popup_address',$this->data);
    }
    
    function select_address()
    {
        
        $weight = $this->xss_filter($_POST["weight"]);
        $uid = $this->encrypt->decodeUrl($this->xss_filter($_POST["uid"]),$this->key);
        $query_address = $this->db->query('SELECT a.*,b.province,c.city_name,d.subdistrict_name,e.telepon as telepon_utama,e.fullname FROM address a LEFT JOIN province b ON a.uid_province=b.province_id LEFT JOIN city c ON a.uid_city=c.city_id LEFT JOIN subdistrict d ON a.uid_subdistrict=d.subdistrict_id LEFT JOIN account e ON a.uid_account=e.uid WHERE a.uid = '.$uid)->result_array();;
        
        $this->session->userdata['uid_shipping'] = $uid;
        //echo "<pre>";
        //print_r($query_address);
        
        
        $ongkirnya = $this->ongkir_jne($weight,$query_address[0]["uid_subdistrict"]);
        $ongkir = $ongkirnya[0]["value"];
        $etd = $ongkirnya[0]["etd"];
        $this->session->userdata['jne']['ongkir'] = $ongkir;
        $this->session->userdata['jne']['etd'] = $etd;
        $this->session->userdata['jne']['tujuan'] = $query_address[0]["uid_subdistrict"];
                
        $d = array('result' => $query_address,'uid' => $this->encrypt->encodeUrl($query_address[0]["uid"],$this->key), 'ongkir' => "Rp ".$this->rupiah($ongkir), 'etd' => $etd);
        echo json_encode($d);
    }
    /*dipake kalo udh jalan*/
    function ongkir_jne($weight,$uid_subdistrict){
        $getorigin = $this->getorigin();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$getorigin&originType=city&destination=$uid_subdistrict&destinationType=subdistrict&weight=$weight&courier=jne",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 83d0bea707a458d2ca3ed9c23498e9cb"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        //print_r($data["rajaongkir"]);
        $key = array_search("REG", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        if ($key == ""){
            $key = array_search("CTC", array_column($data["rajaongkir"]["results"][0]["costs"], 'service'));
        }
        
        
        
        return $data["rajaongkir"]["results"][0]["costs"][$key]["cost"];
    }
    
    /*function ongkir_jne($weight,$uid_subdistrict){
        
        
        $getorigin = $this->getorigin();
        $uid_subdistrict = $uid_subdistrict;
        $weight = $weight;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://cdlab.co/rajaongkir/cekongkir.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "getorigin=$getorigin&uid_subdistrict=$uid_subdistrict&weight=$weight",
          
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
        }
        
        //echo "<pre>";
        //print_r($data);
        return $data;
        
        
    }*/
    function update_address_new()
    {
        $uid = 0;
        if (isset($_GET["xss"])){
            $uid = $this->encrypt->decodeUrl($_GET["xss"],$this->key);
        }
        $data_session = $this->session->all_userdata();
        $this->data['fullname'] = $data_session["login_user"]["eternaleaf_fullname"];      
        $query = $this->db->query('SELECT province_id,province FROM province')->result_array();;
        $this->data["rec"] = $query;
        
        if ($uid > 0){
        $query_address = $this->db->query('SELECT * FROM address WHERE uid = '.$uid)->result_array();;
        $this->data["alamat"] = $query_address;
        
        $query_city = $this->db->query('SELECT * FROM city WHERE province_id = '.$query_address[0]["uid_province"])->result_array();;
        $this->data["city"] = $query_city;
        
        $query_district = $this->db->query('SELECT * FROM subdistrict WHERE city_id = '.$query_address[0]["uid_city"])->result_array();;
        $this->data["district"] = $query_district;
        
        
        
        $query_district = $this->db->query('SELECT telepon FROM account WHERE uid = '.$data_session["login_user"]["eternaleaf_user_login"])->result_array();;
        $this->data["acountnya"] = $query_district;
        }
        //echo "<pre>";
        //print_r($query_address);
                             
        
             
        $this->load->view('popup_address_new',$this->data);
    }
    function update_current_address()
    {
        $uid = 0;
        if (isset($_GET["xss"])){
            $uid = $this->encrypt->decodeUrl($_GET["xss"],$this->key);
        }
        $data_session = $this->session->all_userdata();
        $this->data['fullname'] = $data_session["login_user"]["eternaleaf_fullname"];      
        $query = $this->db->query('SELECT province_id,province FROM province')->result_array();;
        $this->data["rec"] = $query;
        
        if ($uid > 0){
        $query_address = $this->db->query('SELECT * FROM address WHERE uid = '.$uid)->result_array();;
        $this->data["alamat"] = $query_address;
        
        $query_city = $this->db->query('SELECT * FROM city WHERE province_id = '.$query_address[0]["uid_province"])->result_array();;
        $this->data["city"] = $query_city;
        
        $query_district = $this->db->query('SELECT * FROM subdistrict WHERE city_id = '.$query_address[0]["uid_city"])->result_array();;
        $this->data["district"] = $query_district;
        
        
        
        $query_district = $this->db->query('SELECT telepon FROM account WHERE uid = '.$data_session["login_user"]["eternaleaf_user_login"])->result_array();;
        $this->data["acountnya"] = $query_district;
        }
        //echo "<pre>";
        //print_r($query_address);
                             
        
             
        $this->load->view('popup_update_current_address',$this->data);
    }
    function add_address()
    {
        $uid = 0;
        if (isset($_GET["xss"])){
            $uid = $this->encrypt->decodeUrl($_GET["xss"],$this->key);
        }
        
        $query = $this->db->query('SELECT province_id,province FROM province')->result_array();;
        $this->data["rec"] = $query;
        
        if ($uid > 0){
        $query_address = $this->db->query('SELECT * FROM address WHERE uid = '.$uid)->result_array();;
        $this->data["alamat"] = $query_address;
        
        $query_city = $this->db->query('SELECT * FROM city WHERE province_id = '.$query_address[0]["uid_province"])->result_array();;
        $this->data["city"] = $query_city;
        
        $query_district = $this->db->query('SELECT * FROM subdistrict WHERE city_id = '.$query_address[0]["uid_city"])->result_array();;
        $this->data["district"] = $query_district;
        }
        //echo "<pre>";
        //print_r($query_address);
                                        
        $this->load->view('popup_add_address',$this->data);
    }
    function update_account()
    {
        $data_session = $this->session->all_userdata();
        $query = $this->db->query('SELECT *,DATE_FORMAT(birthdate,"%d") AS tgl_lahir,DATE_FORMAT(birthdate,"%m") AS bulan_lahir,DATE_FORMAT(birthdate,"%Y") AS thn_lahir FROM account WHERE uid = '.$data_session["login_user"]["eternaleaf_user_login"])->result_array();
        $this->data["rec"] = $query;
        $this->load->view('popup_account',$this->data);
    }
    
    function update_password()
    {
        $this->data["rec"] = "";
        $this->load->view('popup_password',$this->data);
    }
    function get_city()
    {
        $query = $this->db->query('SELECT city_id,city_name,type_city FROM city WHERE province_id = '.$this->xss_filter($_POST["province_id"]))->result_array();
        //echo "<pre>";
        //print_r($query);
        echo json_encode($query);
    }
    function addcart()
    {
        if (isset($_GET["delete_session"])){
            $this->session->unset_userdata('cart');
            session_destroy();
            session_unset();
            die();
        }
        if ($this->xss_filter($_POST["id"]) != "" && $this->xss_filter($_POST["qty"]) != "" ){
            
            $session_data = $this->session->userdata('cart');
            
            
            
            if (!isset($session_data['id_cart'])){
                $inputdata_cart = array(    
                    'crdate'  => date('Y-m-d H:i:s')
                );   
                $saved = $this->db->insert('temporary_cart', $inputdata_cart);
                $insert_id = $this->db->insert_id();
                $session_data['id_cart'] = $insert_id;
                $this->session->set_userdata("cart", $session_data);
                if (isset($session_data['id_cart']) AND $insert_id > 0 AND $insert_id == $session_data['id_cart']){
                    $inputcartdetail = array(    
                        'crdate'  => date('Y-m-d H:i:s'),
                        'uid_temporary_cart' => $session_data['id_cart'], 
                        'uid_produk' => $this->xss_filter($_POST["id"]),
                        'qty' => $this->xss_filter($_POST["qty"])
                    );   
                    $saved2= $this->db->insert('temporary_cart_detail', $inputcartdetail);
                }
                
            }else{
                $query = $this->db->query('SELECT uid FROM temporary_cart WHERE uid = '.$session_data['id_cart'])->result_array();;
                if (count($query) == 0){
                    $inputdata_cart = array(    
                        'crdate'  => date('Y-m-d H:i:s')
                    );   
                    $saved = $this->db->insert('temporary_cart', $inputdata_cart);
                    $insert_id = $this->db->insert_id();
                    $session_data['id_cart'] = $insert_id;
                    $this->session->set_userdata("cart", $session_data);
                    
                    if (isset($session_data['id_cart']) AND $insert_id > 0 AND $insert_id == $session_data['id_cart']){
                        $inputcartdetail = array(    
                            'crdate'  => date('Y-m-d H:i:s'),
                            'uid_temporary_cart' => $session_data['id_cart'], 
                            'uid_produk' => $this->xss_filter($_POST["id"]),
                            'qty' => $this->xss_filter($_POST["qty"])
                        );   
                        $saved2= $this->db->insert('temporary_cart_detail', $inputcartdetail);
                    }
                }else{
                    $inputcartdetail = array(    
                        'crdate'  => date('Y-m-d H:i:s'),
                        'uid_temporary_cart' => $session_data['id_cart'], 
                        'uid_produk' => $this->xss_filter($_POST["id"]),
                        'qty' => $this->xss_filter($_POST["qty"])
                    );   
                    $saved2= $this->db->insert('temporary_cart_detail', $inputcartdetail);
                }
                
            }
            $query_total = $this->db->query('SELECT SUM(qty) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'])->result_array();;
            if (count($query_total) > 0){
                $d = array('total_cart' => $query_total[0]['totalnya']);
            }else{
                $d = array('total_cart' => 0);
            }
            echo json_encode($d);
        }
        
    }
    function updatecart()
    {
        
        if ($this->xss_filter($_POST["id"]) != "" && $this->xss_filter($_POST["qty"]) != "" ){
            
            $session_data = $this->session->userdata('cart');
            $query = $this->db->query('SELECT uid FROM temporary_cart WHERE uid = '.$session_data['id_cart'])->result_array();;
            $this->db->delete('temporary_cart_detail', array('uid_temporary_cart' => $session_data['id_cart'], 'uid_produk' => $this->xss_filter($_POST["idproduk"]))); 
            if (count($query) > 0){
                $inputcartdetail = array(    
                    'crdate'  => date('Y-m-d H:i:s'),
                    'uid_temporary_cart' => $session_data['id_cart'], 
                    'uid_produk' => $this->xss_filter($_POST["idproduk"]),
                    'qty' => $this->xss_filter($_POST["qty"])
                );   
                $saved2= $this->db->insert('temporary_cart_detail', $inputcartdetail);
            }
            $query_total = $this->db->query('SELECT SUM(qty) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'])->result_array();;
            $query_total_all = $this->db->query('SELECT a.uid_produk,b.price,a.qty,SUM((b.price*a.qty)) as total FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data['id_cart'].' AND b.idlanguage='.$this->xss_filter($_POST["lang"]))->result_array();;
            
            
            if (count($query_total) > 0){
                $d = array('total_cart' => $query_total[0]['totalnya'],'total_harga' => "Rp ".$this->rupiah($query_total_all[0]["total"]));
            }else{
                $d = array('total_cart' => 0,'total_harga' => 0);
            }
            echo json_encode($d);
        }
    }
    function updatecartpayment()
    {
        
        if ($this->xss_filter($_POST["id"]) != "" && $this->xss_filter($_POST["qty"]) != "" ){
            
            $session_data = $this->session->userdata('cart');
            $query = $this->db->query('SELECT uid FROM temporary_cart WHERE uid = '.$session_data['id_cart'])->result_array();;
            $this->db->delete('temporary_cart_detail', array('uid_temporary_cart' => $session_data['id_cart'], 'uid_produk' => $this->xss_filter($_POST["idproduk"]))); 
            if (count($query) > 0){
                $inputcartdetail = array(    
                    'crdate'  => date('Y-m-d H:i:s'),
                    'uid_temporary_cart' => $session_data['id_cart'], 
                    'uid_produk' => $this->xss_filter($_POST["idproduk"]),
                    'qty' => $this->xss_filter($_POST["qty"])
                );   
                $saved2= $this->db->insert('temporary_cart_detail', $inputcartdetail);
            }
            $query_total = $this->db->query('SELECT SUM(qty) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'])->result_array();;
            $query_total_all = $this->db->query('SELECT a.uid_produk,b.price,a.qty,SUM((b.price*a.qty)) as total,SUM(b.weight*a.qty) as total_berat FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data['id_cart'].' AND b.idlanguage='.$this->xss_filter($_POST["lang"]))->result_array();;
            
            //print_r($data_session);
            $data_session = $this->session->all_userdata();   
            //print_r($data_session["jne"]["tujuan"]);
            //die();
            $ongkirnya = $this->ongkir_jne($query_total_all[0]["total_berat"],$data_session["jne"]["tujuan"]);
            $ongkir = $ongkirnya[0]["value"];
            $etd = $ongkirnya[0]["etd"];
            
            
            $totaltobepaid = (int)$ongkir + (int)$query_total_all[0]["total"];
            if (count($query_total) > 0){
                $d = array('total_cart' => $query_total[0]['totalnya'],'total_harga' => "Rp ".$this->rupiah($query_total_all[0]["total"]), 'ongkir' => "Rp ".$this->rupiah($ongkir), 'totaltobepaid' => "Rp ".$this->rupiah($totaltobepaid));
            }else{
                $d = array('total_cart' => 0,'total_harga' => 0, 'ongkir' => $ongkir);
            }
            $this->session->userdata['jne']['ongkir'] = $ongkir;
            $this->session->userdata['jne']['etd'] = $etd;
            $this->session->userdata['total_harga']["harga_order"] = $query_total_all[0]["total"];
            $this->session->userdata['total_harga']["harga_dibayar"] = $totaltobepaid;
            echo json_encode($d);
        }
    }
    function deletecart()
    {
        
        if ($this->xss_filter($_POST["id"]) != "" && $this->xss_filter($_POST["qty"]) != "" ){
            
            $session_data = $this->session->userdata('cart');
            $query = $this->db->query('SELECT uid FROM temporary_cart WHERE uid = '.$session_data['id_cart'])->result_array();;
            $this->db->delete('temporary_cart_detail', array('uid_temporary_cart' => $session_data['id_cart'], 'uid_produk' => $this->xss_filter($_POST["idproduk"]))); 
            
            $query_total = $this->db->query('SELECT SUM(qty) as totalnya FROM temporary_cart_detail WHERE uid_temporary_cart = '.$session_data['id_cart'])->result_array();;
            $query_total_all = $this->db->query('SELECT a.uid_produk,b.price,a.qty,SUM((b.price*a.qty)) as total FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data['id_cart'].' AND b.idlanguage='.$this->xss_filter($_POST["lang"]))->result_array();;
            
            if (count($query_total) > 0){
                $totalnya=$query_total[0]['totalnya'];
                if ($totalnya == null){
                    $totalnya = 0;
                }
                $d = array('total_cart' => $totalnya,'total_harga' => "Rp ".$this->rupiah($query_total_all[0]["total"]));
            }else{
                $d = array('total_cart' => 0,'total_harga' => 0);
            }
            echo json_encode($d);
        }
    }
    
    function saveregistration(){
        
        $error_message = "";
        if ($this->xss_filter($_POST["fullname"]) == ""){
            $error_message .= "<li>Please insert fullname</li>";
        }
        $daynya = "";
        if ($this->xss_filter($_POST["day"]) == ""){
            $error_message .= "<li>Please select day (birthday)</li>";
        }else{
            $daynya = $this->xss_filter($_POST["day"]);
        }
        $month = "";
        if ($this->xss_filter($_POST["month"]) == ""){
            $error_message .= "<li>Please select month (birthday)</li>";
        }else{
            $month = $this->xss_filter($_POST["month"]);
        }
        $year = "";
        if ($this->xss_filter($_POST["year"]) == ""){
            $error_message .= "<li>Please select year (birthday)</li>";
        }else{
            $year = $this->xss_filter($_POST["year"]);
        }
        if ($this->xss_filter($_POST["telepon"]) == ""){
            $error_message .= "<li>Please insert telepon</li>";
        }
        if ($this->xss_filter($_POST["captcha"]) == ""){
            $error_message .= "<li>Please insert captcha</li>";
        }
        if ($this->xss_filter($_POST["email"]) == ""){
            $error_message .= "<li>Please insert email</li>";
        }
        if (!filter_var($this->xss_filter($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $error_message .= "<li>Email not valid</li>";
        }
        if ($this->xss_filter($_POST["password"]) == ""){
            $error_message .= "<li>Please insert password</li>";
        }
        if ($this->xss_filter($_POST["confirm"]) == ""){
            $error_message .= "<li>Please insert confirm password</li>";
        }
      
        if ($this->xss_filter($_POST["password"]) != $this->xss_filter($_POST["confirm"])){
            if($_POST["bahasa"] == "id/"){
                $error_message .= "<li>Kata sandi dan konfirmasi kata sandi tidak sama</li>";
            }else{
                $error_message .= "<li>Password and confirm password not same</li>";
            }
            
        }
        if (!isset($_POST["agree"])){
            $error_message .= "<li>Please check if agree with the terms and condition</li>";
        }
        $session_register = $this->session->userdata('register');
        $session_data = $this->session->all_userdata();
        if ($session_data["captcha"] != $this->xss_filter($_POST["captcha"])){
            
            if($_POST["bahasa"] == "id/"){
                $error_message .= "<li>Captcha tidak valid</li>";
            }else{
                $error_message .= "<li>Captcha not valid</li>";
            }
        }
        $insert_id = 0;
        if ($error_message == ""){
            $datenya = $year."-".$month."-".$daynya;
            $query_total = $this->db->query('SELECT email FROM account WHERE email = "'.$this->xss_filter($_POST["email"]).'"')->result_array();
            if (count($query_total) > 0){
                if($_POST["bahasa"] == "id/"){
                    $error_message .= "<li>Email Anda sudah terdaftar</li>";
                }else{
                    $error_message .= "<li>Your email account has already been used</li>";
                }
                
            }else{
                $inputcartdetail = array(    
                    'crdate'  => date('Y-m-d H:i:s'),
                    'fullname' => $this->xss_filter($_POST["fullname"]),
                    'birthdate' => $datenya,
                    'telepon' => $this->xss_filter($_POST["telepon"]),
                    'password' => sha1(md5($this->xss_filter($_POST["password"]))),
                    'email' => $this->xss_filter($_POST["email"])
                );   
                $saved2= $this->db->insert('account', $inputcartdetail);
                $insert_id = $this->db->insert_id();
                
                if ($insert_id  > 0){
                    $config = Array(       
                        'protocol' => 'sendmail',
                        'smtp_timeout' => '4',
                        'mailtype'  => 'html',
                        'charset'   => 'iso-8859-1'
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
               
                    $this->email->from('support@eternaleaf.com', 'Eternaleaf');
                    $data = array(
                         'userName'=> $this->xss_filter($_POST["fullname"]),
                         'email' => $this->xss_filter($_POST["email"]),
                         'password' => $this->xss_filter($_POST["password"]),
                         'parameter' => $this->encrypt->encodeUrl($insert_id,$this->key)
                    );
                    $this->email->to($this->xss_filter($_POST["email"]));  // replace it with receiver mail id
                    $this->email->cc("support@eternaleaf.com"); 
                    $this->email->bcc("basuki@brightstars.co.id");
                    $this->email->subject("Activation Account"); // replace it with relevant subject
               
                    $body = $this->load->view('activate-email.php',$data,TRUE);
                    $this->email->message($body);  
                    $this->email->send();
                }
                
            }
        }
        $d = array('error' => $error_message,'insert' => $insert_id);
        echo json_encode($d);
    }
    function savekontak(){
        
        $error_message = "";
        if ($this->xss_filter($_POST["nama"]) == ""){
            $error_message .= "<li>Please insert name</li>";
        }
        if (!filter_var($this->xss_filter($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $error_message .= "<li>Email not valid</li>";
        }
        if ($this->xss_filter($_POST["message"]) == ""){
            $error_message .= "<li>Please insert message</li>";
        }
        if ($this->xss_filter($_POST["captcha"]) == ""){
            $error_message .= "<li>Please insert captcha</li>";
        }
        
        $session_data = $this->session->all_userdata();
        //echo "<pre>";
        //print_r($session_data);
        if ($session_data["captcha_text_contact"] != $this->xss_filter($_POST["captcha"])){
            $error_message .= "<li>Captcha not valid</li>";
        }
        $insert_id = 0;
        if ($error_message == ""){
            $inputcontact = array(    
                'crdate'  => date('Y-m-d H:i:s'),
                'name' => $this->xss_filter($_POST["nama"]),
                'message' => $this->xss_filter($_POST["message"]),
                'email' => $this->xss_filter($_POST["email"])
            );   
            $saved2= $this->db->insert('contact_data', $inputcontact);
            $insert_id = $this->db->insert_id();
            $this->session->unset_userdata('captcha_text_contact');
            if ($insert_id  > 0){
                $config = Array(       
                    'protocol' => 'sendmail',
                    'smtp_timeout' => '4',
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1'
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
           
                $this->email->from('info@almazaya.com', 'AL Mazaya Contact Form');
                $data = array(
                    'name' => $this->xss_filter($_POST["nama"]),
                    'message' => $this->xss_filter($_POST["message"]),
                    'email' => $this->xss_filter($_POST["email"])
                );
				
				$query_email = 'SELECT name,email FROM contactreceiver';
				$rec_email = $this->db->query($query_email)->result_array(); 
				$this->email->to($this->xss_filter($_POST["email"]));  // replace it with receiver mail id
				foreach ($rec_email as $dt_email){
					$this->email->to($this->xss_filter($dt_email["email"]));  // replace it with receiver mail id
				
				}
                $this->email->bcc("basuki@brightstars.co.id");  
                $this->email->subject("Form Kontak");
           
                $body = $this->load->view('mail-contact.php',$data,TRUE);
                $this->email->message($body);  
                $this->email->send();
            }
            
        }
        
        $d = array('error' => $error_message,'insert' => $insert_id);
        echo json_encode($d);
    }
    function savethedata(){
        
        $reference_number = $this->generateRandomString(8);
        $session_data = $this->session->all_userdata();
        //echo "<pre>";
        //print_r($session_data);
        $inputdatacart = array(    
            'crdate' => date('Y-m-d H:i:s'),
            'ongkir'   => $session_data["jne"]["ongkir"],
            'total_order'   => $session_data["total_harga"]["harga_order"],
            'totalbepaid'   => $session_data["total_harga"]["harga_dibayar"],
            'uid_user'   => $session_data["login_user"]["eternaleaf_user_login"],
            'uid_shipping'   => $session_data["uid_shipping"]
        );     
        $saved = $this->db->insert("cart", $inputdatacart);
        $insert_id = $this->db->insert_id();
        //echo $insert_id;
        $reference_number = "$reference_number".str_pad($insert_id, 3, "0", STR_PAD_LEFT);
        $editdata = array(    
            'reference_order'   => $reference_number
        );        
        $this->db->where('uid', $insert_id);
        $edit = $this->db->update("cart", $editdata); 
        
        $this->session->userdata['reference_order'] = $reference_number;
        
        $query_detail = 'SELECT a.*,b.price FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data["cart"]["id_cart"]. ' AND b.idlanguage = 1';
        $detail_cart = $this->db->query($query_detail)->result_array(); 
        
        $query_bank = 'SELECT title,bank_account_number,bank_account_name FROM bank_account WHERE id = '.$this->xss_filter($_POST["bank"]);
        $detail_bank = $this->db->query($query_bank)->result_array(); 
        
        $this->session->userdata['bank']["name"] = $detail_bank[0]["title"];
        $this->session->userdata['bank']["number"] = $detail_bank[0]["bank_account_number"];
        $this->session->userdata['bank']["account_name"] = $detail_bank[0]["bank_account_name"];
        //echo "<pre>";
//        print_r($session_data);
//        die();
        
        
        
        
        foreach ($detail_cart as $dt){
            $inputdatadetail = array(    
                'crdate' => date('Y-m-d H:i:s'),
                'uid_cart'   => $insert_id,
                'uid_produk'   => $dt["uid_produk"],
                'price'   => $dt["price"],
                'qty'   => $dt["qty"],
                'total'   => $dt["price"] * $dt["qty"]
            );     
            $saved = $this->db->insert("cart_detail", $inputdatadetail);
        }
        $inputdatabank = array(    
            'crdate' => date('Y-m-d H:i:s'),
            'uid_cart'   => $insert_id,
            'uid_bank'   => $this->xss_filter($_POST["bank"])
        );     
        $saved = $this->db->insert("cart_bank", $inputdatabank);
        $inputdataongkir = array(    
            'crdate' => date('Y-m-d H:i:s'),
            'uid_cart'   => $insert_id,
            'uid_destination'   => $session_data["jne"]["tujuan"],
            'price'  => $session_data["jne"]["ongkir"],
            'etd'  => $session_data["jne"]["etd"]
        );     
        $saved = $this->db->insert("cart_ongkir", $inputdataongkir);
        
        $this->orderconfirmation();
        $config = Array(       
            'protocol' => 'sendmail',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
   
        $this->email->from('support@eternaleaf.com', 'Eternaleaf');
        $data = array(
             'name'=> $session_data["login_user"]["eternaleaf_fullname"],
             'reference_order' => $reference_number,
             'bank_account_name' => $this->session->userdata['bank']["account_name"],
             'bank_name' => $this->session->userdata['bank']["name"],
             'bank_number' => $this->session->userdata['bank']["number"],
             'total_price' => $this->rupiah($session_data["total_harga"]["harga_dibayar"])
        );
        $this->email->to($this->xss_filter($session_data["login_user"]["eternaleaf_email"]));  // replace it with receiver mail id
        $this->email->cc("support@eternaleaf.com"); 
        $this->email->bcc("basuki@brightstars.co.id"); 
        $this->email->subject("[Eternaleaf] ".$this->lang->line('Awaitingbankwirepayment')); // replace it with relevant subject
   
        $body = $this->load->view('awaiting-bank.php',$data,TRUE);
        $this->email->message($body);  
        $this->email->send();
        
        
        echo 1;
    }
    function orderconfirmation(){
        $session_data = $this->session->all_userdata();
        $config = Array(       
            'protocol' => 'sendmail',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
   
        $this->email->from('support@eternaleaf.com', 'Eternaleaf');
        $session_data_cart = $this->session->userdata('cart');
        
        $query = 'SELECT a.uid as id_detail,IFNULL(sum(a.qty),0) as totalnya,b.title,b.pic,b.price,(b.price * sum(a.qty)) as totalharga FROM temporary_cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_temporary_cart = '.$session_data_cart['id_cart'].' AND b.idlanguage=1 GROUP BY a.uid_produk';
        $top = $this->db->query($query)->result_array(); 
        $no = 0;
        $harga  = 0;
        foreach ($top as $dt){
            $top[$no]["id_detail"] = $dt["id_detail"];
            $top[$no]["totalnya"] = $dt["totalnya"];
            $top[$no]["title"] = $dt["title"];
            $top[$no]["pic"] = $dt["pic"];
            $top[$no]["price"] = $dt["price"];
            $top[$no]["totalharga"] = $dt["totalharga"];
            $harga = (int)$dt["totalharga"] + $harga;
            $top[$no]["totalhargaall"] = $harga;
            $no++;
            
        } 
        $no = $no - 1;
        $this->email->to($this->xss_filter($session_data["login_user"]["eternaleaf_email"]));  // replace it with receiver mail id
        $this->email->cc("support@eternaleaf.com"); 
        $this->email->bcc("basuki@brightstars.co.id"); 
        $this->email->subject("[Eternaleaf] Order confirmation"); // replace it with relevant subject
   
        $this->data["cart"] = $top;
        $this->data["totalhargaall"] = $top[$no]["totalhargaall"];
        $this->data["shipping"] = $session_data["jne"]["ongkir"];
        $this->data["name"] = $session_data["login_user"]["eternaleaf_fullname"];
        $this->data["reference_number"] = $session_data["reference_order"];
        $body1 = $this->load->view('order-confirmation.php',$this->data,TRUE);
        //print_r($body);
        $this->email->message($body1);  
        $this->email->send();
    }
    function generateRandomString($length = 10) {
        $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

class SimpleCaptcha {
    public $width  = 140;
    public $height = 35;
    public $wordsFile = 'words/en.php';
    public $resourcesPath = 'resources';
    public $minWordLength = 7;
    public $maxWordLength = 7;
    public $session_var = 'captcha';
    public $backgroundColor = array(255, 255, 255);
    public $colors = array(
        array(106,0,129),
    );
    public $shadowColor = null; //array(0, 0, 0);
    public $lineWidth = 0;
    public $fonts = array(
        'Antykwa'  => array('spacing' => -1, 'minSize' => 25, 'maxSize' => 25, 'font' => 'TimesNewRomanBold.ttf')
    );
    public $Yperiod    = 10;
    public $Yamplitude = 7;
    public $Xperiod    = 10;
    public $Xamplitude = 1;
    public $maxRotation = 1;
    public $scale = 3;
    public $blur = false;
    public $debug = false;
    public $imageFormat = 'jpeg';
    public $im;
    public function __construct($config = array()) {
    }
    public function CreateImage($text) {
        $ini = microtime(true);

        /** Initialization */
        $this->ImageAllocate();
        
        /** Text insertion */
        $text = $text;
        $fontcfg  = $this->fonts[array_rand($this->fonts)];
        $this->WriteText($text, $fontcfg);
        
        $_SESSION[$this->session_var] = $text;
        
        /** Transformations */
        if (!empty($this->lineWidth)) {
            $this->WriteLine();
        }
        $this->WaveImage();
        if ($this->blur && function_exists('imagefilter')) {
            imagefilter($this->im, IMG_FILTER_GAUSSIAN_BLUR);
        }
        $this->ReduceImage();


        if ($this->debug) {
            imagestring($this->im, 1, 1, $this->height-8,
                "$text {$fontcfg['font']} ".round((microtime(true)-$ini)*1000)."ms",
                $this->GdFgColor
            );
        }


        /** Output */
        $this->WriteImage();
        
        $this->Cleanup();
        
    }
    /**
     * Creates the image resources
     */
    protected function ImageAllocate() {
        // Cleanup
        if (!empty($this->im)) {
            imagedestroy($this->im);
        }

        $this->im = imagecreatetruecolor($this->width*$this->scale, $this->height*$this->scale);

        // Background color
        $this->GdBgColor = imagecolorallocate($this->im,
            $this->backgroundColor[0],
            $this->backgroundColor[1],
            $this->backgroundColor[2]
        );
        imagefilledrectangle($this->im, 0, 0, $this->width*$this->scale, $this->height*$this->scale, $this->GdBgColor);

        // Foreground color
        $color           = $this->colors[mt_rand(0, sizeof($this->colors)-1)];
        $this->GdFgColor = imagecolorallocate($this->im, $color[0], $color[1], $color[2]);

        // Shadow color
        if (!empty($this->shadowColor) && is_array($this->shadowColor) && sizeof($this->shadowColor) >= 3) {
            $this->GdShadowColor = imagecolorallocate($this->im,
                $this->shadowColor[0],
                $this->shadowColor[1],
                $this->shadowColor[2]
            );
        }
    }
    /**
     * Text generation
     *
     * @return string Text
     */
    protected function GetCaptchaText() {
        $text = $this->GetDictionaryCaptchaText();
        if (!$text) {
            $text = $this->GetRandomCaptchaText();
        }
        return $text;
    }
    /**
     * Random text generation
     *
     * @return string Text
     */
    protected function GetRandomCaptchaText($length = null) {
        if (empty($length)) {
            $length = rand($this->minWordLength, $this->maxWordLength);
        }

        $words  = "abcdefghijlmnopqrstvwyz";
        $vocals = "aeiou";

        $text  = "";
        $vocal = rand(0, 1);
        for ($i=0; $i<$length; $i++) {
            if ($vocal) {
                $text .= substr($vocals, mt_rand(0, 4), 1);
            } else {
                $text .= substr($words, mt_rand(0, 22), 1);
            }
            $vocal = !$vocal;
        }
        return $text;
    }

    /**
     * Random dictionary word generation
     *
     * @param boolean $extended Add extended "fake" words
     * @return string Word
     */
    function GetDictionaryCaptchaText($extended = false) {
        if (empty($this->wordsFile)) {
            return false;
        }

        // Full path of words file
        if (substr($this->wordsFile, 0, 1) == '/') {
            $wordsfile = $this->wordsFile;
        } else {
            $wordsfile = $this->resourcesPath.'/'.$this->wordsFile;
        }

        if (!file_exists($wordsfile)) {
            return false;
        }

        $fp     = fopen($wordsfile, "r");
        $length = strlen(fgets($fp));
        if (!$length) {
            return false;
        }
        $line   = rand(1, (filesize($wordsfile)/$length)-2);
        if (fseek($fp, $length*$line) == -1) {
            return false;
        }
        $text = trim(fgets($fp));
        fclose($fp);


        /** Change ramdom volcals */
        if ($extended) {
            $text   = preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);
            $vocals = array('a', 'e', 'i', 'o', 'u');
            foreach ($text as $i => $char) {
                if (mt_rand(0, 1) && in_array($char, $vocals)) {
                    $text[$i] = $vocals[mt_rand(0, 4)];
                }
            }
            $text = implode('', $text);
        }
        
        return $text;
    }
    /**
     * Horizontal line insertion
     */
    protected function WriteLine() {

        $x1 = $this->width*$this->scale*.15;
        $x2 = $this->textFinalX;
        $y1 = rand($this->height*$this->scale*.40, $this->height*$this->scale*.65);
        $y2 = rand($this->height*$this->scale*.40, $this->height*$this->scale*.65);
        $width = $this->lineWidth/2*$this->scale;

        for ($i = $width*-1; $i <= $width; $i++) {
            imageline($this->im, $x1, $y1+$i, $x2, $y2+$i, $this->GdFgColor);
        }
    }




    /**
     * Text insertion
     */
    protected function WriteText($text, $fontcfg = array()) {
        if (empty($fontcfg)) {
            // Select the font configuration
            $fontcfg  = $this->fonts[array_rand($this->fonts)];
        }

        // Full path of font file
        $fontfile = $this->resourcesPath.'/fonts/'.$fontcfg['font'];


        /** Increase font-size for shortest words: 9% for each glyp missing */
        $lettersMissing = $this->maxWordLength-strlen($text);
        $fontSizefactor = 1+($lettersMissing*0.09);

        // Text generation (char by char)
        $x      = 20*$this->scale;
        $y      = round(($this->height*27/40)*$this->scale);
        $length = strlen($text);
        for ($i=0; $i<$length; $i++) {
            $degree   = rand($this->maxRotation*-1, $this->maxRotation);
            $fontsize = rand($fontcfg['minSize'], $fontcfg['maxSize'])*$this->scale*$fontSizefactor;
            $letter   = substr($text, $i, 1);

            if ($this->shadowColor) {
                $coords = imagettftext($this->im, $fontsize, $degree,
                    $x+$this->scale, $y+$this->scale,
                    $this->GdShadowColor, $fontfile, $letter);
            }
            $coords = imagettftext($this->im, $fontsize, $degree,
                $x, $y,
                $this->GdFgColor, $fontfile, $letter);
            $x += ($coords[2]-$x) + ($fontcfg['spacing']*$this->scale);
        }

        $this->textFinalX = $x;
    }



    /**
     * Wave filter
     */
    protected function WaveImage() {
        // X-axis wave generation
        $xp = $this->scale*$this->Xperiod*rand(1,3);
        $k = rand(0, 100);
        for ($i = 0; $i < ($this->width*$this->scale); $i++) {
            imagecopy($this->im, $this->im,
                $i-1, sin($k+$i/$xp) * ($this->scale*$this->Xamplitude),
                $i, 0, 1, $this->height*$this->scale);
        }

        // Y-axis wave generation
        $k = rand(0, 100);
        $yp = $this->scale*$this->Yperiod*rand(1,2);
        for ($i = 0; $i < ($this->height*$this->scale); $i++) {
            imagecopy($this->im, $this->im,
                sin($k+$i/$yp) * ($this->scale*$this->Yamplitude), $i-1,
                0, $i, $this->width*$this->scale, 1);
        }
    }

    /**
     * Reduce the image to the final size
     */
    protected function ReduceImage() {
        // Reduzco el tamaño de la imagen
        $imResampled = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($imResampled, $this->im,
            0, 0, 0, 0,
            $this->width, $this->height,
            $this->width*$this->scale, $this->height*$this->scale
        );
        imagedestroy($this->im);
        $this->im = $imResampled;
    }

    /**
     * File generation
     */
    protected function WriteImage() {
        
        if ($this->imageFormat == 'png' && function_exists('imagepng')) {
            header("Content-type: image/png");
            imagepng($this->im);
        } else {
            header("Content-type: image/jpeg");
            imagejpeg($this->im, null, 80);
            
        }
    }
    /**
     * Cleanup
     */
    protected function Cleanup() {
        imagedestroy($this->im);
    }
}
