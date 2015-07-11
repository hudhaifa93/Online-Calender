<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/11/15
 * Time: 12:21 PM
 */

class Database {

    const host="localhost";
    const username="root";
    const password="";
    const dbname="codehunterscalendar";

    protected  $connection;
    protected $stmt;
    public $last_query_PDO;

    function __construct() {
        try{
            $this->connection = new PDO("mysql:host=".self::host.";dbname=".self::dbname, self::username, self::password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
                echo 'DataBase Connection Failed : ' . $e->getMessage();
        }
    }

    public function prepare($sql){$this->last_query_PDO = $sql;}

    public function execute($parameter='*'){
        try{
            if($parameter == "*"){
                $this->stmt = $this->connection->query($this->last_query_PDO);
            }else{
                $this->stmt = $this->connection->prepare($this->last_query_PDO, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $this->stmt->execute($parameter);
            }
            return $this->stmt;

        }catch(PDOException $ex) {
           echo "An Error occured! : $this->last_query_PDO <br/>".$ex->getMessage();
        }
    }

    public function query($sql,$parameter='*'){

        $this->last_query_PDO = $sql;

        try{

            if($parameter != '*')foreach($parameter as $value){ $this->last_query_PDO .=" -$value- "; }

            if($parameter == "*"){

                return $this->stmt = $this->connection->query($sql);

            }else{
                $this->stmt = $this->connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

                return $this->stmt->execute($parameter);
            }


        }catch(PDOException $ex) {

           return false;

        }

    }

    public function fetchObject($result="*"){
        if($result == "*")
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        else
            return $result->fetch(PDO::FETCH_OBJ);
    }

    public function last_id(){return $this->connection->lastInsertId();    }

    public function close_connection(){$this->stmt = null ;}

    public function fetchAll(){return $this->stmt->fetchAll(); }

    function __destruct(){
        $this->close_connection();
    }

} 