<?php
class Invoice extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    public function view()
    {
        $code    = end($this->uri->segments);
        $query   = $this->db->get_where('Account', array(
            'code' => $code
        ));
        $account = $query->row_array();
        
        if ($account) {
            if (!($this->session->userdata('loggedin'))) {
                $this->db->where('id', $account['id']);
                $this->db->update('Account', array(
                    'invoice_seen' => date("Y-m-d H:i:s", strtotime("now"))
                ));
            }
            $data['accounts'] = array();
            array_push($data['accounts'], $account['id']);
            $html = (string) $this->load->view('finance/invoice', $data, true);
            $this->load->model('pdf_model');
            $this->pdf_model->load($html, "Invoice.pdf", "portrait");
        }
    }
}
?>