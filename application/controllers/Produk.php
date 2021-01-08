<?php

use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model', 'prd');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $listProduk = $this->prd->get();

            $this->response(
                [
                    'status' => true,
                    'data' => $listProduk
                ],
                RestController::HTTP_OK
            );
        } else {
            $data = $this->prd->get($id);
            if ($data) {
                $this->response(
                    [
                        'status' => true,
                        'data' => $data
                    ],
                    RestController::HTTP_OK
                );
            } else {
                $this->response(
                    [
                        'status' => true,
                        'message' => 'data dengan ID ' . $id . ' tidak di temukan'
                    ],
                    RestController::HTTP_NOT_FOUND
                );
            }
        }
    }

    public function index_post()
    {
        $data = [

            'nama' => $this->post('nama'),
            'harga' => $this->post('harga'),
            'satuan' => $this->post('satuan')
        ];

        $simpan = $this->prd->addProduk($data);
        if ($simpan['status']) {
            $this->response(
                [
                    'status' => true,
                    'message' => $simpan['data'] . ' Data telah di tambahkan'
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'message' => $simpan['message']
                ],
                RestController::HTTP_INTERNAL_ERROR
            );
        }
    }

    public function index_put()
    {
        $data = [

            'id' => $this->put('id'),
            'nama' => $this->put('nama'),
            'harga' => $this->put('harga'),
            'satuan' => $this->put('satuan')
        ];
        $id = $this->put('id');
        if ($id === null) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Masukan Id yang akan di rubah'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        } else {
            $simpan = $this->prd->updateProduk($id, $data);
            if ($simpan['status']) {

                $status = (int)$simpan['data']; //merubah $simpan menjadi integer

                if ($status > 0) {
                    $this->response(
                        [
                            'status' => true,
                            'message' => $simpan['data'] . ' Data telah di ubah'
                        ],
                        RestController::HTTP_OK
                    );
                } else {
                    $this->response(
                        [
                            'status' => false,
                            'message' => 'Tidak ada data yang di ubah'
                        ],
                        RestController::HTTP_BAD_REQUEST
                    );
                }
            } else {
                $this->response(
                    [
                        'status' => false,
                        'message' => $simpan['message']
                    ],
                    RestController::HTTP_INTERNAL_ERROR
                );
            }
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Masukan Id yang akan di hapus'
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
        $delete = $this->prd->deleteProduk($id);
        if ($delete['status']) {

            $status = (int)$delete['data']; //merubah $simpan menjadi integer

            if ($status > 0) {
                $this->response(
                    [
                        'status' => true,
                        'message' => 'data dengan ID ' . $id . ' telah di hapus'
                    ],
                    RestController::HTTP_OK
                );
            } else {
                $this->response(
                    [
                        'status' => false,
                        'message' => 'Tidak ada data yang di hapus'
                    ],
                    RestController::HTTP_BAD_REQUEST
                );
            }
        } else {
            $this->response(
                [
                    'status' => false,
                    'message' => $delete['message']
                ],
                RestController::HTTP_INTERNAL_ERROR
            );
        }
    }
}
