<?php

namespace App\Modul;
use PDO;
class DB
{
    protected $pdo;
    protected $host = 'localhost';
    protected $dbname = 'oop';
    protected $usernamesql = 'root';
    protected $password = '';
    protected $table;


    public function __construct()
    {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usernamesql, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create(array $data)
    {
        //  برای اینه پارامترها که همون کلیدهای ارایه دیتا هستند را پاس بدیم

        $fields=join(",", array_keys($data));
//   برای اینه که value ها راپاس بدیم
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));

        $stamt = $this->pdo->prepare("insert into {$this->table}({$fields}) values ({$params}) ");
        return $stamt->execute($data);

    }



 public function login(array $data){

     $params1=array_filter($data,function($item){return $item=='email';},ARRAY_FILTER_USE_KEY);

     $params = join(",", array_map(fn($item) => ":$item", array_keys($params1)));

     $stamt=$this->pdo->prepare("select * from {$this->table} where email=({$params}) ");
       $stamt->execute($params1);
       $result= $stamt->fetch(PDO::FETCH_OBJ);
     $_SESSION['login']=$result->name;
     return $result;
 }

 public function update(array $data){
     $fields=join(",", array_keys($data));
     $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));

     $params1=array_filter($data,function($item){return $item=='email';},ARRAY_FILTER_USE_KEY);
     $params2 = join(",", array_map(fn($item) => ":$item", array_keys($params1)));

     $stmt=$this->pdo->prepare("update {$this->table} set ({$fields})=({$params}) where email= {({$params2})} ");
        return $stmt->execute($data);

    }
    public function delete(array $data){
        $params1=array_filter($data,function($item){return $item=='email';},ARRAY_FILTER_USE_KEY);
        $params2 = join(",", array_map(fn($item) => ":$item", array_keys($params1)));
        $stmt=$this->pdo->prepare("delete from {$this->table} where email=({ $params2})");
        return $stmt->execute($data);
    }

}