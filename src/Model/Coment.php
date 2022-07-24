<?php
namespace Nazik\FakerBlog\Model;
use Nazik\FakerBlog\interfases\GeneratorInterface;

class Coment implements GeneratorInterface{

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
            'name'=>$this->faker->name(),
            'email'=>$this->faker->email(),
            'body'=>$this->faker->paragraphs(rand(1,8),true),
            'created_at'=>$this->faker->date('Y_m_d'),
        ];
    }
    public function save($post, $post_id)
    {
        $sql = "
        INSERT INTO `coments` 
            (`post_id`, `email`, `name`, `body`, `created_at`) 
        VALUES 
            (:post_id, :email, :name, :body, :created_at)";

        $sth = $this->dbh->prepare($sql);

        $sth->bindParam(':post_id',$post_id, \PDO::PARAM_INT);
        $sth->bindParam(':email', $post['email'], \PDO::PARAM_STR);
        $sth->bindParam(':name', $post['name'], \PDO::PARAM_STR);
        $sth->bindParam(':body', $post['body'], \PDO::PARAM_STR);
        $sth->bindParam(':created_at', $post['created_at'], \PDO::PARAM_STR);
        $sth->execute();
    }
}
