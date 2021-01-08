<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id=null){
        if($id===null){
            return $this->db->get('users')->result_array();
        } else{
            return $this->db->get_where('users', ['id'=>$id])->result_array();
        }
    }

    public function add($data)
    {
        try {
            $this->db->insert('users', $data);
            $error = $this->db->error();
                if (!empty($error['code'])) {
                   throw new Exception('Terjadi Kesalahan :'. $error['message']);
                   return false;
                } else {
                    return ['status'=> true, 'data' => $this->db->affected_rows()];
                }
            } catch (Exception $ex) {
                return ['status' => false, 'message'=> $ex->getMessage()];
        }
    }
}