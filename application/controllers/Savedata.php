<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savedata extends CI_Controller {
  public function __construct(){
      
    parent::__construct();

    $this->segs = $this->uri->segment_array();

  }
  public function save_contact(){

    $name  = $this->input->post('name');
    $email = $this->input->post('email');
    $pesan = $this->input->post('message');
    $rec = $this->db->query('SELECT email FROM contactreceiver WHERE draft = 0 and hapus = 0')->result_array();


    foreach ($rec as $row) {
      $receiver[] = $row['email'];
    }

    // print_r($receiver);
    // die();

    $this->load->library('email');
    $this->email->from($email, $name);
    $this->email->to($receiver);
    $this->email->cc('');
    $this->email->bcc('');
    $this->email->subject('Contact Us from '.$name);
    $this->email->message('
      Name : '.$name.'
      Email : '.$email.'
      Message : '.$pesan);

    $send = $this->email->send();
    echo $this->email->print_debugger();
    // $emailTo = 'ryanakbar.armial@gmail.com';
    // $subject = 'You have message from '.$name;
    // //$sendCopy = trim($_POST['sendCopy']);
    // $body = "Name : $name \nEmail : $email \nMessage : $pesan";
    // $headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

    // mail($emailTo, $subject, $body, $headers);
        
    //     // set our boolean completion value to TRUE
    // $emailSent = true;
    if($send){
      $inputdata = array(            
      
        'name'    => $name,
        'email'   => $email, 
        'pesan'   => $pesan, 
        'cretime' => date('Y-m-d H:i:s')

      
      );     

      $saved = $this->db->insert('contact', $inputdata);
    }

  }

}
