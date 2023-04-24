<?php

class Category
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

function getCategories()
{
    require_once 'sql/connexion.php';
    $categories = array();
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT categories_id, categories_name FROM categories');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $category = new Category($row['categories_id'], $row['categories_name']);
        $categories[] = $category;
    }
    // foreach ($result as $row) {
    //     $category = new Category();
    //     $category->setId($row['categories_id']);
    //     $category->setName($row['categories_name']);
    //     $categories[] = $category;
    // }
    return json_encode($categories);
}

function updateRow($category_id, $new_value){

    require_once 'sql/connexion.php';
    
    $pdo = connect();

    // Prepare the SQL query to update the category with the given ID
    $stmt = $pdo->prepare('UPDATE categories SET categories_name = :name WHERE categories_id = :id');
    $stmt->bindParam(':id', $category_id);
    $stmt->bindParam(':name', $new_value);
    

    // Execute the query
    $result = $stmt->execute();

    if ($result) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if the update failed
    }
}

