<?php defined('BASEPATH') or exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . 'libraries/Format.php';
require 'vendor/autoload.php';

use chriskacerguis\RestServer\RestController;

//cukup satu link untuk keperluan CRUD : http://localhost/megatim1webapp/index.php/induksiswa
class Management extends RestController
{

    //-------------------------------------------------------------------
    // Konfigurasi REST API
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //-------------------------------------------------------------------
    // Fitur Tampil Data REST API
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $data = $this->db->get('task_categories')->result();
        } else {
            $this->db->where('id', $id);
            $data = $this->db->get('task_categories')->result();
        }
        $this->response($data, 200);
    }

    //-------------------------------------------------------------------
    // Fitur Tambah Data REST API
    function index_post()
    {
        $data = array(
            'id'   => $this->post('id'),
            'name' => $this->post('name')
            //'id_induksiswa' => $this->post('id_induksiswa'),
            //'idth'          => $this->post('idth'),
            //'namasiswa'     => $this->post('namasiswa'),
            //'email'         => $this->post('email'),
            //'hp'            => $this->post('hp'),
            //'idlokasi'      => $this->post('idlokasi'),
            //'idkelas'       => $this->post('idkelas'),
            //'sekolah'       => $this->post('sekolah')
        );
        $insert = $this->db->insert('task_categories', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //-------------------------------------------------------------------
    // Fitur Update Data REST API
    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id'   => $this->put('id'),
            'name' => $this->put('name')
            //'id_induksiswa' => $this->put('id_induksiswa'),
            //'idth'          => $this->put('idth'),
            //'namasiswa'     => $this->put('namasiswa'),
            //'email'         => $this->put('email'),
            //'hp'            => $this->put('hp'),
            //'idlokasi'      => $this->put('idlokasi'),
            //'idkelas'       => $this->put('idkelas'),
            //'sekolah'       => $this->put('sekolah')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('task_categories', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //-------------------------------------------------------------------
    //Fitur Hapus Data REST API
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('task_categories');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
