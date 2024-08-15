<?php
require_once("../include/initialize.php");

if(isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $category = new Category();
    $singlecategory = $category->single_category($categoryId);
    
    if($singlecategory) {
        echo json_encode([
            'CATEGID' => $singlecategory->CATEGID,
            'CATEGORIES' => $singlecategory->CATEGORIES
        ]);
    } else {
        echo json_encode(['error' => 'Category not found']);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}