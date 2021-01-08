<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        if ($id === null) {
            return $this->db->get('produks')->result_array();
        } else {
            return $this->db->get_where('produks', ['id' => $id])->result_array();
        }
    }

    public function addProduk($data)
    {
        try {
            $this->db->insert('produks', $data);
            $error = $this->db->error();
            if (!empty($error['code'])) {
                throw new Exception('Terjadi Kesalahan :' . $error['message']);
                return false;
            } else {
                return ['status' => true, 'data' => $this->db->affected_rows()];
            }
        } catch (Exception $ex) {
            return ['status' => false, 'message' => $ex->getMessage()];
        }
    }

    public function updateProduk($id, $data)
    {
        try {
            $this->db->update('produks', $data, ['id' => $id]);
            $error = $this->db->error();
            if (!empty($error['code'])) {
                throw new Exception('Terjadi Kesalahan : ' . $error['message']);
                return false;
            } else {
                return ['status' => true, 'data' => $this->db->affected_rows()];
            }
        } catch (Exception $ex) {
            return ['status' => false, 'message' => $ex->getMessage()];
        }
    }

    public function deleteProduk($id)
    {
        try {
            $this->db->delete('produks', ['id' => $id]);
            $error = $this->db->error();
            if (!empty($error['code'])) {
                throw new Exception('Terjadi Kesalahan : ' . $error['message']);
                return false;
            } else {
                return ['status' => true, 'data' => $this->db->affected_rows()];
            }
        } catch (Exception $ex) {
            return ['status' => false, 'message' => $ex->getMessage()];
        }
    }
}
