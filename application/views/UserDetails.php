<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Field details</title>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.2.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/userDetailsScript.js'; ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>">
    </head>
    <body>
        <h2>User details</h2>
        <a href="fields">Go to Fields Page </a>
        </br>
        </br>
        <?php
        foreach ($users as $userId => $userDetails) {
            echo form_open('user/edit', ['class' => 'users_form_' . $userId]);
            echo "<div id='errors_$userId'></div>";
            echo '<table class="users-table">';
            echo form_hidden('user_id', $userId);
            foreach ($userDetails as $fieldId => $value) {
                echo '<tr>';
                echo '<td>';
                echo form_label($fields[$fieldId] . ': ');
                echo '</td>';
                $dataInput = array(
                    'name' => $fieldId,
                    'value' => $value
                );
                echo '<td>';
                echo form_input($dataInput);
                echo '</td>';
                echo '</tr>';
            }
            $delete_button_data = array(
                'name' => 'button',
                'class' => 'delete_button',
                'value' => $userId,
                'content' => 'Delete user'
            );
            
            $save_edited_button_data = array(
                'name' => 'button',
                'class' => 'save_edited_button hidden',
                'value' => $userId,
                'content' => 'Save edited user details'
            );
            echo '<tr>';
            echo '<td>';
            echo form_button($delete_button_data);
            echo '</td>';
            echo '<td>';
            echo form_button($save_edited_button_data);
            echo '</td>';
            echo '<tr>';
            echo form_close();
            echo '</br>';
            echo '</br>';
        }
        echo '</table>';
        $add_button_data = array(
            'name' => 'button',
            'id' => 'add_button',
            'content' => 'Add new user'
        );
        echo '</br>';
        echo '</br>';
        echo form_button($add_button_data);
        echo form_close();
        ?>
        <div class="addUser hidden" >
            <?php
            echo form_open('user/add', ['class' => 'add_users_form']);
            echo '<table>';
            echo "<div id='errors_add'></div>";
            foreach ($fields as $fieldId => $value) {
                echo '<tr>';
                echo '<td>';
                echo form_label($fields[$fieldId] . ': ');
                echo '</td>';
                $dataInput = array(
                    'name' => $fieldId,
                    'value' => ''
                );
                echo '<td>';
                echo form_input($dataInput);
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</br>';
            echo '</br>';
            $save_button_data = array(
                'name' => 'button',
                'class' => 'save_button',
                'content' => 'Save new user data'
            );
            echo form_button($save_button_data);
            echo form_close();
            ?>
        </div>
    </body>
</html>
