<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserFieldsController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_fields_model');
    }

    /**
     * show all form fields
     * 
     * @return array fields
     */
    public function index() {
        $data['userFields'] = $this->user_fields_model->getUserFields();
        $data['fieldAttributes'] = $this->getFieldAttributes($data['userFields']);
        $this->load->view('UserFields', $data);
    }

    /**
     * add form fields
     * 
     * @return int $insertResponse
     */
    public function addField() {

        $data = [
            'description' => $this->input->post('description'),
            'status' => $this->input->post('status'),
            'field_type' => $this->input->post('field_type'),
            'mandatory' => $this->input->post('mandatory')
        ];

        $insertResponse = $this->user_fields_model->insertUserField($data);

        echo $insertResponse;
    }

    /**
     * get all form fields
     * 
     * @return array fields
     */
    public function editField() {
        $postData = $this->input->post();
        foreach ($postData as $key => $data) {

            $fieldId = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            $dataToUpdate = [
                'description' => $postData['description_' . $fieldId],
                'status' => $postData['status_' . $fieldId],
                'field_type' => $postData['type_' . $fieldId],
                'mandatory' => $postData['mandatory_' . $fieldId]
            ];

            $updateResponse = $this->user_fields_model->updateUserField($fieldId, $dataToUpdate);
        }

        echo $updateResponse;
    }

    /**
     * get all form fields
     * 
     * @return array fields
     */
    public function deleteField() {

        $deleteResult = 0;
        if ($this->input->post('id') !== "") {
            $fieldId = $this->input->post('id');
            $deleteResult = $this->user_fields_model->deleteUserField($fieldId);
        }

        echo $deleteResult;
    }

    /**
     * get all form fields
     * 
     * @return array fields
     */
    public function getFieldAttributes($userFields) {
        
        $fieldAttributes = [];
        
        $dataName = [
            'id' => 'name'
        ];
        
        $dataStatus['active'] = [
            'value' => 1
        ];
        
        $dataStatus['inactive'] = [
            'value' => 0
        ];
        
        $dataType = [
            'String' => 'String',
            'Numeric' => 'Numeric',
            'Date' => 'Date'
        ];
        
        $dataMandatory['required'] = [
            'value' => 1
        ];
        
        $dataMandatory['optional'] = [
            'value' => 0
        ];
        
        foreach ($userFields as $field) {
            $dataName['value'] = $field->description;
            $dataName['name'] = 'description_' . $field->field_id;
            
            $dataStatus['active']['name'] = 'status_' . $field->field_id;
            $dataStatus['inactive']['name'] = 'status_' . $field->field_id;
            if ($field->status === '1') {
                $dataStatus['active']['checked'] = TRUE;
                $dataStatus['inactive']['checked'] = FALSE;
            } else {
                $dataStatus['inactive']['checked'] = TRUE;
                $dataStatus['active']['checked'] = FALSE;
            }
            
            $dataMandatory['required']['name'] = 'mandatory_' . $field->field_id;
            $dataMandatory['optional']['name'] = 'mandatory_' . $field->field_id;
            if ($field->mandatory === '1') {
                $dataMandatory['required']['checked'] = TRUE;
                $dataMandatory['optional']['checked'] = FALSE;
            } else {
                $dataMandatory['required']['checked'] = FALSE;
                $dataMandatory['optional']['checked'] = TRUE;
            }
        }
        
        $fieldAttributes['status'] = $dataStatus;
        $fieldAttributes['description'] = $dataName;
        $fieldAttributes['type'] = $dataType;
        $fieldAttributes['mandatory'] = $dataMandatory;
        
        return $fieldAttributes;
    }

}
