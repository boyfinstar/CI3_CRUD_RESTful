<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiEmployeeController extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('EmployeeModel');
    }
    public function index_get(){
        // echo 'i am employee index function';

        $employee = new EmployeeModel;

        $result_emp = $employee->get_employee();

        $this->response($result_emp, 200);
        
    }

    public function addemployee_post(){

        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
        ];

        $addemployee = new EmployeeModel;

        $result_emp = $addemployee->add_employee($data);

        if ($result_emp > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'NEW EMPLOYEE CREATED'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'FAILED T0 CREATE NEW EMPLOYEE'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function seeemployee_get($id){

        $seeemployee = new EmployeeModel;

        $result_emp = $seeemployee->see_employee($id);
        $this->response($result_emp, 200);
    }

    public function updateemployee_put($id){

        $data = [
            'first_name' => $this->put('first_name'),
            'last_name' => $this->put('last_name'),
            'phone' => $this->put('phone'),
            'email' => $this->put('email'),
        ];

        $updateemployee = new EmployeeModel;

        $result_emp = $updateemployee->update_employee($id, $data);
        
        if ($result_emp > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'EMPLOYEE UPDATE'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'FAILED T0 UPDATE EMPLOYEE'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteemployee_delete($id){

        $deleteemployee = new EmployeeModel;

        $result_emp = $deleteemployee->delete_employee($id);
        
        if ($result_emp > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'EMPLOYEE DELETED'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'FAILED T0 DELETE EMPLOYEE'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}