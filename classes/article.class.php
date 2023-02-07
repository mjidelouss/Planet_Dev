<?php
require_once('./includes/autoloader.php');

class Article {
    public $id;
    public $title;
    public $author;
    public $content;
    public $category;
    public $date;
    public $db;
    public $admin;

    public function __construct() {
        $this->db = new DbConnection;
        $this->admin = new Admin;
    }

    public function display_articles() {
        $sql="SELECT article.id, article.title, article.author, article.content, category.category, article.published_date FROM  article, category WHERE category.id = article.category_id";
        $stmt = $this->db->connect()->query($sql);
        return $stmt;
    }

    public function display_articles_category($category) {
        if ($category) {
            $sql="SELECT article.id, article.title, article.author, article.content, category.category, article.published_date FROM  article, category WHERE category.id = article.category_id AND article.category_id = '$category'";
        } else {
            $sql="SELECT article.id, article.title, article.author, article.content, category.category, article.published_date FROM  article, category WHERE category.id = article.category_id";
        }
        $stmt = $this->db->connect()->query($sql);
        return $stmt;
    }
    public function article_status()
    {
        $sql = "SELECT COUNT(*) AS total FROM article";
        $stmt = $this->db->connect()->query($sql);
        $row = $stmt->fetch();
        $totalArticles = $row['total'];
        return $totalArticles;
    }

    public function users_status()
    {
        $sql = "SELECT COUNT(*) AS total FROM adminusers WHERE role = 'user'";
        $stmt = $this->db->connect()->query($sql);
        $row = $stmt->fetch();
        $totalUsers = $row['total'];
        return $totalUsers;
    }

    public function authors_status()
    {
        $sql = "SELECT COUNT(DISTINCT author) AS total FROM article";
        $stmt = $this->db->connect()->query($sql);
        $row = $stmt->fetch();
        $totalAuthors = $row['total'];
        return $totalAuthors;
    }

    public function display_categories() {
        $sql="SELECT * FROM category";
        $stmt = $this->db->connect()->query($sql);
        return $stmt;
    }
}