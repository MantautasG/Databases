<?php

class miestas{
    private $miestas_table = '';
    private $imones_table = ''; 
    
    public function __construct() {
  $this->miestas_table = config::DB_PREFIX . 'miestas';
  $this->imones_table = config::DB_PREFIX . 'imone';
    }

    public function getMiestas($id) {
    $query = "  SELECT *
          FROM {$this->miestas_table}
          WHERE `Miesto_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
  }
    
    public function getMiestasListCount() {
  $query = "  SELECT COUNT(`{$this->miestas_table}`.`Miesto_id`) as `kiekis`
     FROM `{$this->miestas_table}`";
  $data = mysql::select($query);
  return $data[0]['kiekis'];
    }
    
    
    public function getMiestasList($limit = null, $offset = null) {
  $limitOffsetString = "";
  if(isset($limit)) {
   $limitOffsetString .= " LIMIT {$limit}";
   
   if(isset($offset)) {
    $limitOffsetString .= " OFFSET {$offset}";
   } 
  }
  $query = "  SELECT  `{$this->miestas_table}`.`Pavadinimas`,
                                    `{$this->miestas_table}`.`Rajonas`,
                                    `{$this->miestas_table}`.`Miesto_id`
     
     FROM `{$this->miestas_table}` {$limitOffsetString} ";
     /*,
                                             `{$this->imones_table}`
      WHERE `{$this->miestas_table}`.`Miesto_id`=`{$this->imones_table}`.`fk_MiestasMiesto_id`{$limitOffsetString}*/
                                                
  $data = mysql::select($query);
  return $data;
 }

 public function insertMiestas($data) {
    $query = "  INSERT INTO {$this->miestas_table}
                (
                  `Pavadinimas`,
                  `Rajonas`
                )
                VALUES
                (
                  '{$data['Pavadinimas']}',
                  '{$data['Rajonas']}'
                )";
                echo $query;
    mysql::query($query);
  }


  public function updateMiestas($data) {
    echo "data ".implode("|",$data);
    $query = "  UPDATE {$this->miestas_table}
          SET    `Pavadinimas`='{$data['Pavadinimas']}',
                  `Rajonas`='{$data['Rajonas']}'
          WHERE `Miesto_id`='{$data['Miesto_id']}'";
    mysql::query($query);
  }

  public function deleteMiestas($id) {
    $query = "  DELETE FROM {$this->miestas_table}
          WHERE `Miesto_id`='{$id}'";
    mysql::query($query);
  }

  public function getmiestaiCountOfImone($id) {
    $query = "  SELECT COUNT({$this->miestas_table}.`Miesto_id`) AS `kiekis`
          FROM {$this->miestas_table}
            INNER JOIN {$this->imones_table}
              ON {$this->miestas_table}.`Miesto_id`={$this->imones_table}.`fk_MiestasMiesto_id`
          WHERE {$this->miestas_table}.`Miesto_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }
    
}