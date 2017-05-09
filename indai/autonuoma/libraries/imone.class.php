<?php

class imone{
    private $imones_table = '';
    private $miestas_table = ''; 
    private $darbuotojas_table = '';
    
    public function __construct() {
  $this->imones_table = config::DB_PREFIX . 'imone';
  $this->miestas_table = config::DB_PREFIX . 'miestas';
  $this->darbuotojas_table = config::DB_PREFIX . 'darbuotojas';
    }

    public function getImone($id) {
    $query = "  SELECT *
          FROM {$this->imones_table}
          WHERE `Imones_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
  }

  public function getMiestasList($limit = null, $offset = null) {
  
  $query = "  SELECT  `{$this->miestas_table}`.`Pavadinimas`,
                                    `{$this->miestas_table}`.`Rajonas`,
                                    `{$this->miestas_table}`.`Miesto_id`
     
     FROM `{$this->miestas_table}`";
      /*,
                                             `{$this->imones_table}`
      WHERE `{$this->miestas_table}`.`Miesto_id`=`{$this->imones_table}`.`fk_MiestasMiesto_id`{$limitOffsetString}*/
                                                
  $data = mysql::select($query);
  echo $query;
  return $data;
 }

  public function getMiestas($id) {
    $query = "  SELECT *
          FROM {$this->miestas_table}
          WHERE `Miesto_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
  }
    
    public function getImoneListCount() {
  $query = "  SELECT COUNT(`{$this->imones_table}`.`Imones_id`) as `kiekis`
     FROM `{$this->imones_table}`";
  $data = mysql::select($query);
  return $data[0]['kiekis'];
    }
    
    
    public function getImoneList($limit = null, $offset = null) {
  $limitOffsetString = "";
  if(isset($limit)) {
   $limitOffsetString .= " LIMIT {$limit}";
   
   if(isset($offset)) {
    $limitOffsetString .= " OFFSET {$offset}";
   } 
  }
  $query = "  SELECT  `{$this->imones_table}`.`Pavadinimas`,
                                    `{$this->imones_table}`.`Adresas`,
                                    `{$this->imones_table}`.`El_pastas`,
                                    `{$this->imones_table}`.`Telefono_nr`,
                                    `{$this->imones_table}`.`Faksas`,
                                    `{$this->imones_table}`.`Valstybe`,
                                    `{$this->imones_table}`.`Imones_id`,
                                    `{$this->miestas_table}`.`Pavadinimas`
     
     FROM `{$this->imones_table}` ,
                                  `{$this->miestas_table}`
    WHERE `{$this->imones_table}`.`fk_MiestasMiesto_id`=`{$this->miestas_table}`.`Miesto_id`{$limitOffsetString}";
                                                
    $data = mysql::select($query);
    return $data;
  }


 public function insertImone($data) {
    $query = "  INSERT INTO {$this->imones_table}
                (
                  `Pavadinimas`,
                  `Adresas`,
                  `El_pastas`,
                  `Telefono_nr`,
                  `Faksas`,
                  `Valstybe`,
                  `fk_MiestasMiesto_id`
                )
                VALUES
                (
                  '{$data['Pavadinimas']}',
                  '{$data['Adresas']}',
                  '{$data['El_pastas']}',
                  '{$data['Telefono_nr']}',
                  '{$data['Faksas']}',
                  '{$data['Valstybe']}',
                  '{$data['fk_MiestasMiesto_id']}'
                )";
                echo $query;
    mysql::query($query);
  }


  public function updateImone($data) {
    echo "data ".implode("|",$data);
    $query = "  UPDATE {$this->imones_table}
          SET    `Pavadinimas`='{$data['Pavadinimas']}',
                 `Adresas`='{$data['Adresas']}',
                 `El_pastas`='{$data['El_pastas']}',
                 `Telefono_nr`='{$data['Telefono_nr']}',
                 `Faksas`='{$data['Faksas']}',
                 `Valstybe`='{$data['Valstybe']}',
                 `fk_MiestasMiesto_id`='{$data['fk_MiestasMiesto_id']}'
          WHERE `Imones_id`='{$data['Imones_id']}'";
    mysql::query($query);
  }

  public function deleteImone($id) {
    $query = "  DELETE FROM {$this->imones_table}
          WHERE `Imones_id`='{$id}'";
    mysql::query($query);
  }

  public function getDarbuotojasCountOfImone($id) {
    $query = "  SELECT COUNT({$this->darbuotojas_table}.`Tab_nr`) AS `kiekis`
          FROM {$this->darbuotojas_table}
            INNER JOIN {$this->imones_table}
              ON {$this->darbuotojas_table}.`fk_ImoneImones_id`={$this->imones_table}.`Imones_id`
          WHERE {$this->imones_table}.`Imones_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }
    
}