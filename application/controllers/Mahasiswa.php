<?php
require(APPPATH . '/libraries/RestController.php');
require(APPPATH . '/libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
        $this->methods['index_get']['limit'] = 1000;
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->Mahasiswa_model->get();
        } else {
            $mahasiswa = $this->Mahasiswa_model->get($id);
        }
        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Mahasiswa_model->delete($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data=[
            'nama'=>$this->post('nama'),
            'nim'=>$this->post('nim'),
            'jurusan'=>$this->post('jurusan'),
            'email'=>$this->post('email')
        ];

        if ($this->Mahasiswa_model->create($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new mahasiswa has been created.'
            ], RestController::HTTP_CREATED);
        }else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data=[
            'nama'=>$this->post('nama'),
            'nim'=>$this->post('nim'),
            'jurusan'=>$this->post('jurusan'),
            'email'=>$this->post('email')
        ];

        if ($this->Mahasiswa_model->update($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new mahasiswa has been updated.'
            ], RestController::HTTP_NOT_MODIFIED);
        }else {
            $this->response([
                'status' => false,
                'message' => 'failed to update new data!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


}
