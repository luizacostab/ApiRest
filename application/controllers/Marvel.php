<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

use Restserver\libraries\REST_Controller;

class Marvel extends REST_Controller{

    public function __construct(){
        parent:: __construct();
        $this -> load -> database();
    }

    public function index_get($id = 0){
        if(!empty($id)){
            $data = $this -> db->get_where('marvels',['id' =>$id])-> row_array();
        }
        else{
            $data = $this->db->get('marvels') -> result();
        }
        $this -> response($data,REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this ->input->post();
        $this->db->insert('marvels',$input);

        $this -> response('Registro gravado com sucesso!',REST_Controller::HTTP_OK);
    }

    public function index_put($id){
       $input =$this-> put();
       $this->db->update('marvels',$input,array('id'=>$id));
        $this->response(['Registro alterado com sucesso!'],REST_Controller::HTTP_OK);
    }

    public function index_delete($id){
        $this->db->delete('marvels',array('id'=>$id));
        $this->response(['Registro excluido com sucesso!'],REST_Controller::HTTP_OK);
    }


}