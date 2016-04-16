<?php

/**
 * UserFields extends codeigniters base CI_Model
 * @author Snayu Arora
 * @package codeigniter.application.models
 */
class User_fields_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * get all form fields
     * 
     * @return array fields
     */
    public function getUserFields($status = 'all') {
        if ($status == 'all') {
            $fields = $this->db->get('standard_user_fields');
        } elseif ($status == 'active') {
            $fields = $this->db->get_where('standard_user_fields',['status' => '1']);
        }
        
        return $fields->result();
    }
    
    /**
     * delete form fields
     * 
     * @param int $fieldId
     * @return int 
     */
    public function deleteUserField($fieldId) {
        return $this->db->delete('standard_user_fields', array('field_id' => $fieldId));
    }
    
    /**
     * insert form fields
     * 
     * @param array $dataToInsert
     * @return int 
     */
    public function insertUserField($dataToInsert) {
        return $this->db->insert('standard_user_fields', $dataToInsert);
    }
    
    /**
     * update form fields
     * 
     * @param int $fieldId
     * @param array $dataToUpdate
     * @return int 
     */
    public function updateUserField($fieldId, $dataToUpdate) {
        $this->db->where('field_id', $fieldId);
        return $this->db->update('standard_user_fields', $dataToUpdate);
    }

}
