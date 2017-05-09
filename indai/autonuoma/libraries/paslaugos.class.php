<?php

class paslaugos{
    private $paslaugos_table = '';
    private $uzsakyta_paslauga_table = ''; 
    
    public function __construct() {
  $this->paslaugos_table = config::DB_PREFIX . 'paslauga';
  $this->uzsakyta_paslauga_table = config::DB_PREFIX . 'uzsakyta_paslauga';
    }
    
    public function getPaslaugosListCount() {
  $query = "  SELECT COUNT(`{$this->paslaugos_table}`.`Pasaugos_id`) as `kiekis`
     FROM `{$this->paslaugos_table}`";
  $data = mysql::select($query);
  return $data[0]['kiekis'];
    }

    public function getPaslaugos($id) {
    $query = "  SELECT *
          FROM {$this->paslaugos_table}
          WHERE `Pasaugos_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
  }

  public function insertPaslaugos($data) {
    $query = "  INSERT INTO {$this->paslaugos_table}
                (
                  `Pavadinimas`,
                  `Aprasymas`
                )
                VALUES
                (
                  '{$data['Pavadinimas']}',
                  '{$data['Aprasymas']}'
                )";
                echo $query;
    mysql::query($query);
  }


  public function updatePaslaugos($data) {
    echo "data ".implode("|",$data);
    $query = "  UPDATE {$this->paslaugos_table}
          SET    `Pavadinimas`='{$data['Pavadinimas']}',
                `Aprasymas`='{$data['Aprasymas']}'
          WHERE `Pasaugos_id`='{$data['Pasaugos_id']}'";
    mysql::query($query);
  }

  public function deletePaslaugos($id) {
    $query = "  DELETE FROM {$this->paslaugos_table}
          WHERE `Pasaugos_id`='{$id}'";
    mysql::query($query);
  }


  public function getPaslaugosCountOfUzsakytos($id) {
    $query = "  SELECT COUNT({$this->paslaugos_table}.`Pasaugos_id`) AS `kiekis`
          FROM {$this->paslaugos_table}
            INNER JOIN {$this->uzsakyta_paslauga_table}
              ON {$this->paslaugos_table}.`Pasaugos_id`={$this->uzsakyta_paslauga_table}.`fk_PaslaugaPasaugos_id`
          WHERE {$this->paslaugos_table}.`Pasaugos_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }
    
    
    public function getPaslaugosList($limit = null, $offset = null) {
  $limitOffsetString = "";
  if(isset($limit)) {
   $limitOffsetString .= " LIMIT {$limit}";
   
   if(isset($offset)) {
    $limitOffsetString .= " OFFSET {$offset}";
   } 
  }
  $query = "  SELECT  `{$this->paslaugos_table}`.`Pavadinimas`,
                                    `{$this->paslaugos_table}`.`Aprasymas`,
                                    `{$this->paslaugos_table}`.`Pasaugos_id`
     
     FROM `{$this->paslaugos_table}`/*,
                                             
                                            `{$this->uzsakyta_paslauga_table}`
      WHERE `{$this->paslaugos_table}`.`Pasaugos_id`=`{$this->uzsakyta_paslauga_table}`.`fk_PaslaugaPasaugos_id`*/{$limitOffsetString}";
                                                
  $data = mysql::select($query);
  return $data;
 }
    
}