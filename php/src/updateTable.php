<?php

require_once 'sql/get.php';
require_once 'sql/edit.php';

if (isset($_POST['function_name']) && !empty($_POST['function_name'])) {
    $function_name = $_POST['function_name'];
    if ($function_name == 'getCategories') {
        $result = getCategories();
        echo $result; // Echo the result instead of using 'return'
    }
    if ($function_name == 'getKanjis') {
        $result = getKanjis();
        echo $result; // Echo the result instead of using 'return'
    }
    if ($function_name == 'updateCategory') {
        $category_id = $_POST['category_id'];
        $new_value = $_POST['new_value'];
        $result = updateCategory($category_id, $new_value);
        if ($result) {
            echo true; // Echo true if the update was successful
        } else {
            echo false; // Echo false if the update failed
        }
    }
    if ($function_name == 'updateKanji') {
        $kanji_id = $_POST['kanji_id'];
        $new_values = array();

        // Collect all the new values from the $_POST array dynamically
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'new_value') !== false) {
                $new_values[] = $value;
            }
        }

        $result = updateKanji($kanji_id, $new_values);
        if ($result) {
            echo true; // Echo true if the update was successful
        } else {
            echo false; // Echo false if the update failed
        }
    }

    if ($function_name == 'deleteCategory') {
        $category_id = $_POST['category_id'];
        $result = deleteCategory($category_id);
        if ($result) {
            echo true; // Echo true if the update was successful
        } else {
            echo false; // Echo false if the update failed
        }
    }

    if ($function_name == 'deleteKanji') {
        $kanji_id = $_POST['kanji_id'];
        $result = deleteKanji($kanji_id);
        if ($result) {
            echo true; // Echo true if the update was successful
        } else {
            echo false; // Echo false if the update failed
        }
    }
}
