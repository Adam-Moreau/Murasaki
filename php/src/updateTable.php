<?php 

if (isset($_POST['function_name']) && !empty($_POST['function_name'])) {
    $function_name = $_POST['function_name'];
    if ($function_name == 'getCategories') {
        require_once 'sql/get.php' ;
       
        $result = getCategories();
        echo $result ;
        return $result ;
    }
}