<?php
class Mail extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mail_model');
        $this->load->model('finance_model');
    }
    
    public function index()
    {
        
        $post = $this->input->post();
        
        if (isset($post['sent'])) {
            switch ($post['recipients']) {
                case 0:
                    $sql      = "SELECT DISTINCT account_id AS id FROM view_register";
                    $accounts = $this->db->query($sql);
                    break;
                case 1:
                    $this->db->select('id')->from('Account');
                    $accounts = $this->db->get();
                    break;
                case 2:
                    $this->db->select('id')->from('Account');
                    $accounts = $this->db->get();
                    break;
                case 3:
                    $sql      = "SELECT DISTINCT account_id AS id FROM view_register WHERE class_id=?";
                    $accounts = $this->db->query($sql, $post['subgroup']);
                    break;
                case 4:
                    $sql      = "SELECT DISTINCT account_id AS id FROM view_register WHERE venue_id=?";
                    $accounts = $this->db->query($sql, $post['subgroup']);
                    break;
                    
            }
            $data['acclist'] = array();
            $data['accid']   = array();
            
            if (isset($accounts)) {
                $countAcc = 0;
                $errors   = 0;
                foreach ($accounts->result() as $account) {
                    $query = $this->db->get_where('Account', array(
                        'id' => $account->id
                    ));
                    $ret   = $query->result();
                    
                    if ($ret[0]->email != "") {
                        $sendIt     = true;
                        $accBalance = 0;
                        
                        if ($post['recipients'] == 2) {
                            $accBalance = $this->finance_model->accountbalance($ret[0]->id);
                            if ($accBalance <= 0) {
                                $sendIt = false;
                            }
                        }
                        
                        if ($sendIt) {
                            // print ($ret[0]->email)." (".$ret[0]->first_name." ".$ret[0]->surname.")<br>" ;
                            $body    = $post['body'];
                            $subject = $post['subject'];
                            
                            
                            if (isset($post['confirmed'])) {
                                
                                $confirmed = $post['confirmed'];
                                if (in_array($ret[0]->id, $confirmed)) {
                                    
                                    $body    = str_replace("#firstname", $ret[0]->first_name, $body);
                                    $subject = str_replace("#firstname", $ret[0]->first_name, $subject);
                                    $body    = str_replace("#balance", $accBalance, $body);
                                    $subject = str_replace("#balance", $accBalance, $subject);
                                    $body    = str_replace("#invoice", "https://forthdanceacademy.com/admin/index.php/invoice/view/" . $ret[0]->code, $body);
                                    
                                    //print $account->id." ".$ret[0]->email." - $subject - $body<br><br>";
                                    if ($this->mail_model->sendEmail($ret[0]->email, $subject, $body)) {
                                    //if ($this->mail_model->sendEmail("jkempson@gmail.com", $subject, $body)) {
                                        $countAcc++;
                                    } else {
                                        $errors++;
                                    }
                                }
                            } else {
                                
                                array_push($data['acclist'], $ret[0]->first_name . " " . $ret[0]->surname . " (" . $ret[0]->email . ")" . (($post['recipients'] == 2) ? " - Due: &pound;" . $accBalance : ""));
                                array_push($data['accid'], $ret[0]->id);
                                
                            }
                        }
                    }
                }
            }
            
            if (isset($post['confirmed'])) {
                $this->session->set_flashdata('message', "$countAcc emails sent<br>$errors errors");
                redirect("/home");
            } else {
                $data['title']      = 'Confirm mailing list';
                $data['action']     = 'mail';
                $data['recipients'] = $post['recipients'];
                if (isset($post['subgroup'])) {
                    $data['subgroup'] = $post['subgroup'];
                }
                $data['body']    = $body;
                $data['subject'] = $subject;
                
                $this->load->view('templates/header', $data);
                $this->load->view('mail/confirm', $data);
                $this->load->view('templates/footer');
            }
            
        } elseif ((isset($post['recipients'])) && ($post['recipients'] > 2) && (!isset($post['subgroup']))) {
            // Choose subgroup (if recipient is 1 or 2 then we don't require a subgroup so we can skip this step)
            $data['title'] = "Choose subgroup";
            $this->load->view('templates/header', $data);
            $data['recipients'] = $post['recipients'];
            $data['action']     = 'mail';
            
            switch ($post['recipients']) {
                case 3:
                    $this->load->view('mail/class', $data);
                    break;
                case 4;
                    $this->load->view('mail/venue', $data);
                    break;
            }
            $this->load->view('templates/footer');
        } elseif ((isset($post['compose'])) || (isset($post['recipients']) && ($post['recipients'] <= 2)) || (isset($post['subgroup']))) {
            // Compose email
            
            $data['presubject'] = "";
            $data['premessage'] = "";
            switch ($post['recipients']) {
                case 2:
                    $data['presubject'] = "Forth Dance Academy Invoice";
                    $data['premessage'] = "Hi #firstname,\n\nPayment for &pound;#balance is due on your account.\n\nPlease click the link below to see your invoice:\n\n#invoice\n\nYou can either send a cheque in the post, pay by BACS transfer or bring some cash to the next class.\n\nHeather McKendry\nFlat 3\n1 Newhaven Road\nEdinburgh\nEH6 5PA\n\nOR\n\nAccount number 10332698\nSort Code 835100\n\nN.B If transferring funds please ensure you include your child's name as the reference to enable tracking payment\n\nMany thanks\nHeather McKendry\nForth Dance Academy\n\nTelephone: 07784 925 919\nWebsite: forthdanceacademy.com";
                    break;
            }
            $data['title']  = 'Compose Email';
            $data['action'] = 'mail';
            
            // Add hidden values for recipient type and subgroup (if required)
            $data['recipients'] = $post['recipients'];
            if (isset($post['subgroup'])) {
                $data['subgroup'] = $post['subgroup'];
            }
            
            $this->load->view('templates/header', $data);
            $this->load->view('mail/compose', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title']  = 'Choose recipients';
            $data['action'] = 'mail';
            $this->load->view('templates/header', $data);
            $this->load->view('mail/group', $data);
            $this->load->view('templates/footer');
        }
        
    }
}
?>
