<?php 

include 'config.php';

class crud{

   private $username = username;
   private $host = host;
   private $pass = pass;
   private $dbname = dbname;
   private $db;


   public function __construct()
   {
    try{
        $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->pass);   
         
        

    }catch(PDOException $e){
         echo "Error = ". $e->getMessage();   
          
    }
 

    
   }

   public function read($table, $values, $column){
    try{
        if(!empty($column)){

            $row = $this->db->prepare("SELECT * FROM {$table} WHERE {$column} = ?");
            $row->execute([$values]);

        }else{

            $row = $this->db->prepare("SELECT * FROM {$table}");  
            $row->execute([$values]);

        }
       
        return $row;
        
       
    
    
    }catch(PDOException $e){  
        return ["error" => $e->getMessage()];
   

    }
     

   }



   
   public function optionalread($data, $options = []){
     
    try{
         
       if(isset($options["column_name"]) && empty($options["limit"])){
            $row = $this->db->prepare("SELECT * FROM {$data} ORDER BY {$options['column_name']} {$options['column_sort']}");
                 
       }else if(isset($options["column_name"]) && $options["limit"]){
          $row = $this->db->prepare("SELECT * FROM {$data} ORDER BY {$options['column_name']} {$options['column_sort']} LIMIT {$options['limit']}");      

       }
     $row->execute();  
     return $row->fetchAll(PDO::FETCH_ASSOC);   
             
    }catch(PDOException $e){
        return ["error" => $e->getMessage()];
    }
     
   }


   public function  addinsert($email, $username, $passwords){

    try{
           
      $insert = $this->db->prepare("INSERT INTO users SET email=?, username=?, password=?, registerdate=?");
    
      $insert->execute([$email, $username, $passwords, date("Y-m-d")]);

      return ["status" => true];

    }catch(Exception $e){
        
      return ["status" => false, "error" => $e->getMessage()];
         
    }
    


   }


/*
   public function addvalue($argse){

    $values = implode(',',array_map(function($item){

    return $item. "=?";
    },array_keys($argse)));

    return $values;

     
    
  }
  */

  public function ssql($sql){
   
  try{
   $row = $this->db->prepare($sql);
   return $row;

  }catch(PDOException $e){
    
    return["status" => false, "error" => $e->getMessage()];
  }
 


  }


}
  




?>