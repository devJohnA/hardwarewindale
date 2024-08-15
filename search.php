<?php
require_once("include/initialize.php");

if(isset($_GET['term'])) {
    $search_term = $_GET['term'];
    
    // Use the escape_value method for sanitization
    $search_term = $mydb->escape_value('%' . $search_term . '%');
    
    $query = "SELECT * FROM tblproduct WHERE PRONAME LIKE '{$search_term}' OR PRODESC LIKE '{$search_term}' LIMIT 5";
    $mydb->setQuery($query);
    $cur = $mydb->loadResultList();
    
    if(!empty($cur)) {
        echo "<ul>";
        foreach($cur as $result) {
            echo "<li><a href='index.php?q=product&id={$result->PROID}'>{$result->PRONAME}</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No results found.</p>";
    }
}