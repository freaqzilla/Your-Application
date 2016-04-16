<?php

/**
 * User_details_model extends codeigniters base CI_Model
 * @author Snayu Arora
 * @package codeigniter.application.models
 */
class User_details_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserDetails() {

        $this->db->select('fields.field_id, fields.description, fields.field_type, fields.mandatory, details.user_id, details.value');
        $this->db->from('standard_user_fields fields');
        $this->db->join('user_details details', 'fields.field_id = details.field_id', 'LEFT');
        $this->db->where('fields.status', '1');

        $query = $this->db->get();
        $userDetails = $query->result();

        return $userDetails;
    }

    public function deleteUserDetails($userId) {
        return $this->db->delete('user_details', array('user_id' => $userId));
    }

    public function insertUserDetails($userId = 0, $dataToInsert) {

        if (!$userId) {
            if ($this->db->insert('user_details', $dataToInsert)) {
                $this->db->select_max('user_id');
                $result = $this->db->get('user_details');
                return $result->row()->user_id;
            }
        } else {
            $dataToInsert['user_id'] = $userId;
            if ($this->db->insert('user_details', $dataToInsert)) {
                return $userId;
            }
        }
    }

    public function updateUserDetails($userId, $fieldId, $dataToUpdate) {

        $updateResponse = 0;

        $this->db->where('user_id', $userId);
        $this->db->where('field_id', $fieldId);

        if ($this->db->update('user_details', $dataToUpdate)) {
            $updateResponse = 1;
            return $updateResponse;
        } else {
            unset($dataToUpdate['field_id']);
            $dataToInsert['user_id'] = $userId;
            $dataToInsert['field_id'] = $fieldId;
            if ($this->db->insert('user_details', $dataToUpdate)) {
                $updateResponse = 1;
            }
        }
        return $updateResponse;
    }

}
