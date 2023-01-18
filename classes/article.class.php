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

    public function __construct() {
        $this->db = new DbConnection;
    }

    public function display_articles() {
        $sql="SELECT article.id, article.title, article.author, article.content, category.category, article.published_date FROM  article, category WHERE category.id = article.category_id";
        $stmt = $this->db->connect()->query($sql);
        while ($row = $stmt->fetch()) 
        {
            $this->id = "".$row["id"] ."";
            $this->title = "".$row["title"]."";
            $this->author = "".$row["author"]."";
            $this->content = "".$row["content"]."";
            $this->category = "".$row["category"]."";
            $this->date = "".$row["published_date"]."";
            echo '
                <tr>
                <th scope="row">'.$this->id.'</th>
                <td>'.$this->title.'</td>
                <td>'.$this->author.'</td>
                <td>'.$this->content.'</td>
                <td>'.$this->category.'</td>
                <td>'.$this->date.'</td>
                <td><button data-info="'.$this->title.','.$this->author.','.$this->content.','.$this->category.','.$this->date.'" class="rounded" data-bs-toggle="modal" data-bs-target="#modal-updateArt" id="'.$this->id.'" onclick="initArt('.$this->id.')"><i class="bi bi-pencil-square" style="color: green;"></i></button></td>
                <form action="" method="POST">
                <input type="text" id="delid" name="delid" value="'.$this->id.'" style="display: none">
                <td><button type="submit" class="rounded"><a href=""><i class="bi bi-trash-fill" style="color: red;"></i></a></button></td>
                </form>
                </tr>
            ';
        }
    }
}