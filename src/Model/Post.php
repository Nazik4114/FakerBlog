<?php
namespace Nazik\FakerBlog\Model;
use Nazik\FakerBlog\interfases\GeneratorInterface;
 class Post implements GeneratorInterface{

    private $faker;
    private $dbh;

    public function setDriver($dbh)
    {
        $this->dbh = $dbh;
    }

   
     public function __construct($faker)
    {

        $this->faker=$faker;
    }

    public function generator(){
        return [
            'title'=>$this->faker->sentence(rand(3,8)),
            'body'=>$this->faker->paragraphs(rand(1,8),true),
            'image_url'=>$this->faker->imageUrl(640, 480, 'animals', true),
            'created_at'=>$this->faker->date(),
            'update_at'=>$this->faker->date(),
            
        ];
    }
    public function save($author, $user_id)
    {
        $sql = "
        INSERT INTO `posts` 
            (`user_id`, `title`, `body`, `image_url`, `created_at`, `update_at`) 
        VALUES 
            (:user_id, :title, :body, :image_url, :created_at, :update_at)";

        $sth = $this->dbh->prepare($sql);

        $sth->bindParam(':user_id',$user_id, \PDO::PARAM_INT);
        $sth->bindParam(':title', $author['title'], \PDO::PARAM_STR);
        $sth->bindParam(':body', $author['body'], \PDO::PARAM_STR);
        $sth->bindParam(':image_url', $author['image_url'], \PDO::PARAM_STR);
        $sth->bindParam(':created_at', $author['created_at'], \PDO::PARAM_STR);
        $sth->bindParam(':update_at', $author['update_at'], \PDO::PARAM_STR);
        $sth->execute();
    }
    public function getLastId(){
        $sql= "
        SELECT MAX(`id`) as `id` FROM `posts`";
        $sth=$this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
 }