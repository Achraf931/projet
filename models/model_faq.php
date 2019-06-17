<?php
function getFaq(){
    $db = dbConnect();

    $queryFaq = $db->query('SELECT * FROM faq');
    return $queryFaq->fetchAll();
}

function getCat(){
    $db = dbConnect();

    $queryFaq = $db->query('SELECT DISTINCT c.id, c.name as catName FROM categories c 
    JOIN faq f 
    ON c.id = f.category_id');
    return $queryFaq->fetchAll();
}