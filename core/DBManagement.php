<?php



require_once './../public/vendor/autoload.php';

class DBManagement
{
    private $connection;

    public function __construct()
    {
        $this->connection=DBConnection::obtine_conexiune();
    }

    public  function insert_users($doc){
        $collection = $this->connection->selectCollection('Users');
        $collection->insertOne($doc);

    }

    public   function insert_products($doc){
        $collection = $this->connection->selectCollection('Products');
        $collection->insertOne( $doc );
    }

    public  function verify_session($session){
        $collection = $this->connection->selectCollection('Users');
        $record = $collection->find( )->toArray();
        foreach ($record as $item){
            if (md5($item['session'])==$session)
                return true;
        }
        return false;
    }

}