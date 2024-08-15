<?php
require_once('include/initialize.php');  

if(isset($_POST['query'])) {
    $query = $_POST['query'];
    
    $sql = "SELECT PROD_NAME FROM tblproduct WHERE PROD_NAME LIKE :query LIMIT 5";
    $stmt = $mydb->prepare($sql);
    $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($result) {
        foreach($result as $row) {
            echo '<div class="search-result-item">' . htmlspecialchars($row['PROD_NAME']) . '</div>';
        }
    } else {
        echo '<div>No results found</div>';
    }
}
?>