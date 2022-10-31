<?php defined('BASEPATH') or exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . 'libraries/Format.php';
require 'vendor/autoload.php';

use chriskacerguis\RestServer\RestController;

//cukup satu link untuk keperluan CRUD : http://localhost/megatim1webapp/index.php/induksiswa
class Tasks extends RestController
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
            $data = $this->db->get('tasks')->result();
        } else {
            $this->db->where('id', $id);
            $data = $this->db->get('tasks')->result();
        }
        $this->response($data, 200);
    }

    //-------------------------------------------------------------------
    // Fitur Tambah Data REST API
    function index_post()
    {
        $data = array(
            'id'             => $this->post('id'),
            'category_id'    => $this->post('category_id'),
            'title'          => $this->post('title'),
            'description'    => $this->post('description'),
            'start_date'     => $this->post('start_date'),
            'finish_date'    => $this->post('finish_date'),
            'status'         => $this->post('status'),
            'doc_url'        => $this->post('doc_url'),
        
        );
        $insert = $this->db->insert('tasks', $data);
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
            'id'             => $this->put('id'),
            'category_id'    => $this->put('category_id'),
            'title'          => $this->put('title'),
            'description'    => $this->put('description'),
            'start_date'     => $this->put('start_date'),
            'finish_date'    => $this->put('finish_date'),
            'status'         => $this->put('status'),
            'doc_url'        => $this->put('doc_url'),
        );
        $this->db->where('id', $id);
        $update = $this->db->update('tasks', $data);
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
        $delete = $this->db->delete('tasks');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
