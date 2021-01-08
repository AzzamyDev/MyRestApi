<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Users extends RestController {

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('user_model', 'usr');
    }

    public function index_get(){

        $id =$this->get('id');

        if ($id===null) {
                $listUser = $this->usr->get();
                $this->response([
                    'status' => true,
                    'data' => $listUser ],RestController::HTTP_OK);
        } else {

            $data = $this->usr->get($id); 
            if ($data) {
                $this->response([
                    'status' => true,
                    'data' => $data], RestController::HTTP_OK);
                }else {
                $this->response([
                    'status' => false,
                    'message' => 'id ' . $id . ' tidak di temukan'], RestController::HTTP_NOT_FOUND);
                
            }
        }

    }

    public function index_post(){
        $data = [
            //variable di sebelah kiri adalah nama key di database
            //variable di sebelah kanan adalah nama key di parameter
            'nama' =>$this->post('nama'),
            'jenis' =>$this->post('jenis'),
            'umur' =>$this->post('umur')
        ];
        $simpan = $this->usr->add($data);
        if ($simpan['status']) {
            $this->response(['status'=>true, 'message'=>$simpan['data']. ' Data telah di tambahkan'],
            RestController::HTTP_CREATED);
        } else {
            $this ->response(['status'=>false, 'message'=> $simpan['message']],
            RestController::HTTP_INTERNAL_ERROR);
        }
    }

}