<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Field details</title>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.2.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/userFieldsScript.js'; ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>"">
    </head>
    <body>
        <h2>Field details</h2>

        <?php
        
        $dataName = [
            'id' => 'name'
        ];

        $dataStatusActive = [
            'value' => 1
        ];

        $dataStatusInactive = [
            'value' => 0
        ];

        $dataType = [
            'String' => 'String',
            'Numeric' => 'Numeric',
            'Date' => 'Date'
        ];

        $dataMandatory = [
            'value' => 1
        ];

        $dataNotMandatory = [
            'value' => 0
        ];

        echo form_open('field/edit', ['class' => 'fields_form']);
        foreach ($userFields as $field) {

            echo form_label('Field Name: ');
            $dataName['value'] = $field->description;
            $dataName['name'] = 'description_' . $field->field_id;
            echo form_input($dataName);

            echo form_label('Field Status: ');
            $dataStatusActive['name'] = 'status_' . $field->field_id;
            $dataStatusInactive['name'] = 'status_' . $field->field_id;
            if ($field->status === '1') {
                $dataStatusActive['checked'] = TRUE;
                $dataStatusInactive['checked'] = FALSE;
            } else {
                $dataStatusInactive['checked'] = TRUE;
                $dataStatusActive['checked'] = FALSE;
            }
            echo form_label('Active');
            echo form_radio($dataStatusActive);
            echo form_label('Inactive');
            echo form_radio($dataStatusInactive);

            echo form_label('Field Type: ');
            echo form_dropdown('type_' . $field->field_id, $dataType, $field->field_type);

            echo form_label('Field Mandatory: ');
            $dataMandatory['name'] = 'mandatory_' . $field->field_id;
            $dataNotMandatory['name'] = 'mandatory_' . $field->field_id;
            if ($field->mandatory === '1') {
                $dataMandatory['checked'] = TRUE;
                $dataNotMandatory['checked'] = FALSE;
            } else {
                $dataNotMandatory['checked'] = TRUE;
                $dataMandatory['checked'] = FALSE;
            }
            echo form_label('Required');
            echo form_radio($dataMandatory);
            echo form_label('Not Required');
            echo form_radio($dataNotMandatory);

            $deleteButtonData = [
                'name' => 'button',
                'class' => 'delete_button',
                'value' => $field->field_id,
                'content' => 'Delete field'
            ];
            echo form_button($deleteButtonData);

            echo '</br>';
            echo '</br>';
        }
        
        echo form_submit('save', 'Save edited fields');

        echo form_close();
        
        echo '</br>';
        echo '</br>';
                
        $addButtonData = [
            'name' => 'button',
            'id' => 'add_button',
            'content' => 'Add new field'
        ];
        echo form_button($addButtonData);
        ?>
        
        <div class="addField hidden" >
            <?php

            $dataName = [
                'id' => 'name',
                'value' => '',
                'name' => 'description'
            ];

            $dataStatusActive = [
                'value' => 1,
                'checked' => TRUE,
                'name' => 'status'
            ];

            $dataStatusInactive = [
                'value' => 0,
                'name' => 'status'
            ];

            $dataType = [
                'String' => 'String',
                'Numeric' => 'Numeric',
                'Date' => 'Date'
            ];

            $dataMandatory = [
                'value' => 1,
                'checked' => TRUE,
                'name' => 'mandatory'
            ];

            $dataNotMandatory = [
                'value' => 0,
                'name' => 'mandatory'
            ];
            
            // open form
            echo form_open('field/add', ['class' => 'add_fields_form']);
            
            // field name
            echo form_label('Field Name: ');
            echo form_input($dataName);
            
            // field status
            echo form_label('Field Status: ');
            echo form_label('Active');
            echo form_radio($dataStatusActive);
            echo form_label('Inactive');
            echo form_radio($dataStatusInactive);
            
            // field type
            echo form_label('Field Type: ');
            echo form_dropdown('field_type', $dataType, 'String');
            
            // field mandatory
            echo form_label('Field Mandatory: ');
            echo form_label('Required');
            echo form_radio($dataMandatory);
            echo form_label('Not Required');
            echo form_radio($dataNotMandatory);
            
            // save button for new field
            $saveButtonData = [
                'name' => 'button',
                'class' => 'save_button',
                'content' => 'Save field data'
            ];
            echo form_button($saveButtonData);
            echo form_close();
            echo '</br>';
            ?>
        </div>
        </br>
        </br>
        <a href="users">Go to Users Page </a>
    </body>
</html>
