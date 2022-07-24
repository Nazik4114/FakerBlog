<?php 
use Nazik\FakerBlog\Model\Author;
use Nazik\FakerBlog\Model\Post;
use Nazik\FakerBlog\Model\Coment;

require_once __DIR__.'\..\..\vendor\autoload.php';


class SaveController
{
    private $modelA;
    private $modelP;
    private $modelC;
    private $faker;
    public function __construct()
    {
        try {
            $db = new Db();
            $dbh=$db->getMySQL(
                MYSQL_DSN, MYSQL_USER, MYSQL_PASS
            );
        } catch (\PDOException $e) {
            $error = 'Could not connect to database: '.$e->getMessage();
            require_once VIEWS_DIR . '/error.php';
            exit;  
        }
        $this->faker=Faker\Factory::create();

        $this->modelA = new Author($this->faker);
        $this->modelP = new Post($this->faker);
        $this->modelC = new Coment($this->faker);

        $this->modelA->setDriver($dbh);
        $this->modelP->setDriver($dbh);
        $this->modelC->setDriver($dbh);      
    }

    public function save()
    {
       
        for ($i=0; $i <QUANTITY_AUTHORS ; $i++) { 
            $this->modelA->save($this->modelA->generator(),0);
            $id=$this->modelA->getLastId();
            for ($j=0; $j <QUANTITY_POSTS ; $j++) {  
                $this->modelP->save($this->modelP->generator(),$id[0]['id']);
                $id_P=$this->modelP->getLastId();
                for ($k=0; $k < QUANTITY_COMENTS; $k++) { 
                    $this->modelC->save($this->modelC->generator(),$id_P[0]['id']);
                }
            }
        
        }
        

        require_once VIEWS_DIR . '/saved.php';
    }
}