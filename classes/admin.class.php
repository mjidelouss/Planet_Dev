<?php
require_once('./includes/autoloader.php');

class Admin  extends User {
    public $db;

    public function __construct() {
        $this->db = new DbConnection;
    }

    public function add_article($title, $author, $category, $content)
    {
        $date = date("Y-m-d");
        $sql = "INSERT INTO article (title, author, content, category_id, published_date) values ('$title', '$author', '$content', '$category', '$date')";
        $stmt = $this->db->connect()->query($sql);
        header('location: dashboard.php');
    }
    public function delete_article($id) 
    {
        $sql = "DELETE FROM article WHERE id = '$id'";
        $stmt = $this->db->connect()->query($sql);
        header('location: dashboard.php');
    }
    public function update_article($id, $title, $author, $content, $category)
    {
        $categoryId = '';
        $date = date("Y-m-d");
        
        if ($category == "FrontEnd") {$categoryId = 1;}
        if ($category == "BackEnd") {$categoryId = 2;}
        if ($category == "Network") {$categoryId = 3;}
        if ($category == "Cloud") {$categoryId = 4;}
        if ($category == "DevOps") {$categoryId = 5;}
        if ($category == "Big Data") {$categoryId = 6;}
        if ($category == "UI & UX") {$categoryId = 7;}
        if ($category == "Web") {$categoryId = 8;}
        if ($category == "Cyber Security") {$categoryId = 9;}
        $sql = "UPDATE article SET id = $id, title = '$title', author = '$author', content = '$content', category_id = '$categoryId', published_date = '$date' WHERE id = $id";
        $stmt = $this->db->connect()->query($sql);
        header('location: dashboard.php');
    }
}