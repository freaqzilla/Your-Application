<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserDetailsController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_details_model');
        $this->load->model('user_fields_model');
    }

    public function index() {
        $users = [];

        // get all fields to be shown in the form
        $fields = $this->user_fields_model->getUserFields('active');

        $data['userDetails'] = $this->user_details_model->getUserDetails();

        foreach ($fields as $field) {
            foreach ($data['userDetails'] as $detail) {
                if (isset($detail->user_id)) {
                    if (($detail->field_id == $field->field_id)) {
                        $users[$detail->user_id][$field->field_id] = $detail->value;
                    } else if (!isset($users[$detail->user_id][$field->field_id])) {
                        $users[$detail->user_id][$field->field_id] = '';
                    }
                }
            }
            $fieldNames[$field->field_id] = $field->description;
        }

        $userDetails['users'] = $users;
        $userDetails['fields'] = $fieldNames;
        $this->load->view('UserDetails', $userDetails);
    }

    public function addDetails() {

        $this->setValidationRules();

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $data = $this->input->post();
            $insertedUserId = 0;

            foreach ($data as $fieldId => $value) {
                $dataToInsert = [
                    'field_id' => $fieldId,
                    'value' => $value
                ];

                $insertedUserId = $this->user_details_model->insertUserDetails($insertedUserId, $dataToInsert);
            }

            echo $insertedUserId;
        }
    }

    public function editDetails() {

        $this->setValidationRules();

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $postData = $this->input->post();
            $userId = $postData['user_id'];

            foreach ($postData as $fieldId => $value) {

                if (is_numeric($fieldId)) {
                    $dataToUpdate = [
                        'value' => $value
                    ];

                    $updatedResponse = $this->user_details_model->updateUserDetails($userId, $fieldId, $dataToUpdate);
                }
            }
            echo $updatedResponse;
        }
    }

    public function deleteDetails() {

        $deleteResult = 0;
        if ($this->input->post('id') !== "") {
            $userId = $this->input->post('id');
            $deleteResult = $this->user_details_model->deleteUserDetails($userId);
        }

        echo $deleteResult;
    }

    public function getFieldAttributes() {
        $fieldAttributes = [];

        $fieldStatus[] = array(
            'name' => 'fieldStatus',
            'value' => 'Active',
            'checked' => TRUE,
        );

        $fieldStatus[] = array(
            'name' => 'fieldStatus',
            'value' => 'Inactive',
            'checked' => FALSE
        );

        $fieldAttributes['status'] = $fieldStatus;
        $fieldAttributes['description'] = $fieldStatus;
        $fieldAttributes['type'] = ['text', 'numeric', 'date'];
        $fieldAttributes['required'] = ['Yes', 'No'];
    }
    
    public function setValidationRules() {

        // get all fields to be shown in the form
        $fields = $this->user_fields_model->getUserFields('active');

        if (count($fields) > 0) {
            foreach ($fields as $field) {
                if ($field->mandatory === '1') {
                    $this->form_validation->set_rules($field->field_id, $field->description, 'trim|required');
                    $this->form_validation->set_message('required', 'Please provide a value for: %s');
                } else {
                    $this->form_validation->set_rules($field->field_id, $field->description, 'trim');
                }
            }
        }
    }
}
