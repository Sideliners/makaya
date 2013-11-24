<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_cart extends CI_Model{

    private $transaction_history = 'transaction_history';
	private $product = 'product';

    function save_transaction($data){
        $data['transaction_date'] = date('Y-m-d H:i:s');

        $insert = $this->db->insert($this->transaction_history, $data);

        if($insert) return 1;

        return FALSE;
    }

    function get_transactions($payer_id, $token){
        $this->db->select('*');
        $this->db->from($this->transaction_history);
        $this->db->join($this->product, "{$this->product}.product_id = {$this->transaction_history}.product_id");

        $this->db->where("{$this->transaction_history}.payer_id", $payer_id);
        $this->db->where("{$this->transaction_history}.transaction_id", $token);

        $query = $this->db->get();

        return $query->result();
    }
}
