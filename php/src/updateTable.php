<?php
require_once 'Category.php';

if (isset($_POST['function_name']) && !empty($_POST['function_name'])) {
    $function_name = $_POST['function_name'];
    if ($function_name == 'getCategories') {
        $result = getCategories();
        echo $result;
        return $result;
    }
    if ($function_name == 'updateRow') {
        $category_id = $_POST['category_id'];
        $new_value = $_POST['new_value'];
        $result = updateRow($category_id, $new_value);
        if ($result) {
            return true; // Return true if the update was successful
        } else {
            return false; // Return false if the update failed
        }
    }
}
