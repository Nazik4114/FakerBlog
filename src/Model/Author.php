<?php
namespace Nazik\FakerBlog\Model;
use Nazik\FakerBlog\interfases\GeneratorInterface;

class Author implements GeneratorInterface{

    private $faker;
    private $dbh;

     public function __construct($faker)
    {

        $this->faker=$faker;
    }

    public function setDriver($dbh)
    {
        $this->dbh = $dbh;
    }
    public function generator(){
        return [
            'name'=>$this->faker->name(),
            'user_name'=>$this->faker->userName(),
            'email'=>$this->faker->email(),
            'street'=>$this->faker->streetName(),
            'city'=>$this->faker->city(),
            'zipcode'=>$this->faker->postcode(),
            'phone'=>$this->faker->phoneNumber(),
            'web_site'=>$this->faker->url(),
            'company'=>$this->faker->company(),
            'created_at'=>$this->faker->date('Y_m_d'),
        ];
    }
   
    public function save($author,$id)
    {
        $sql = "
        INSERT INTO `author` 
            (`name`, `user_name`, `email`, `street`, `city`, `zipcode`, `phone`, `web_site`, `company`, `created_at`) 
        VALUES 
            (:name, :user_name, :email, :street, :city, :zipcode, :phone, :web_site, :company, :created_at)";

            $author1=$author['name'];
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':name',$author1, \PDO::PARAM_STR);
        $sth->bindParam(':user_name', $author['user_name'], \PDO::PARAM_STR);
        $sth->bindParam(':email', $author['email'], \PDO::PARAM_STR);
        $sth->bindParam(':street', $author['street'], \PDO::PARAM_STR);
        $sth->bindParam(':city', $author['city'], \PDO::PARAM_STR);
        $sth->bindParam(':zipcode', $author['zipcode'], \PDO::PARAM_STR);
        $sth->bindParam(':phone', $author['phone'], \PDO::PARAM_STR);
        $sth->bindParam(':web_site', $author['web_site'], \PDO::PARAM_STR);
        $sth->bindParam(':company', $author['company'], \PDO::PARAM_STR);
        $sth->bindParam(':created_at', $author['created_at'], \PDO::PARAM_STR);
        $sth->execute();
        
    }
    public function getLastId(){
        $sql= "
        SELECT MAX(`id`) as `id` FROM `author`";
        $sth=$this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
