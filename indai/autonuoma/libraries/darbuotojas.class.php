<?php

class darbuotojas{
    private $darbuotojas_table = '';
    private $imones_table = ''; 
    private $sutartis_table = '';
    private $skundu_table = '';
    
    public function __construct() {
  $this->darbuotojas_table = config::DB_PREFIX . 'darbuotojas';
  $this->imones_table = config::DB_PREFIX . 'imone';
  $this->sutartis_table = config::DB_PREFIX . 'sutartis';
  $this->skundu_table = config::DB_PREFIX . 'skundai';

    }

    public function getDarbuotojas($id) {
    $query = "  SELECT *
          FROM {$this->darbuotojas_table}
          WHERE `Tab_nr`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
    }
    
    public function getDarbuotojasListCount() {
  $query = "  SELECT COUNT(`{$this->darbuotojas_table}`.`Tab_nr`) as `kiekis`
     FROM `{$this->darbuotojas_table}`";
  $data = mysql::select($query);
  return $data[0]['kiekis'];
    }


    public function getImoneList($limit = null, $offset = null) {
  
  $query = "  SELECT  `{$this->imones_table}`.`Pavadinimas`,
                                    `{$this->imones_table}`.`Adresas`,
                                    `{$this->imones_table}`.`El_pastas`,
                                    `{$this->imones_table}`.`Telefono_nr`,
                                    `{$this->imones_table}`.`Faksas`,
                                    `{$this->imones_table}`.`Valstybe`,
                                    `{$this->imones_table}`.`Imones_id`
     
     FROM `{$this->imones_table}`";
     /*,
                                             `{$this->imones_table}`
      WHERE `{$this->miestas_table}`.`Miesto_id`=`{$this->imones_table}`.`fk_MiestasMiesto_id`{$limitOffsetString}*/
                                                
  $data = mysql::select($query);
  //echo $query;
  return $data;
 }


 public function insertSkundai($data){
        $last=mysql::getLastInsertedId();
        if(isset($data['skundai']) && sizeof($data['skundai']) > 0) {
                        $i=1;
      foreach($data['skundai'] as $key=>$val) {                                
        $query = "  INSERT INTO `{$this->skundu_table}`
                    (
                      `skundas`,
                      `fk_darbuotojas_id`
                    )
                    VALUES
                    (
                      '{$val}',
                      '{$last}'
                    )";
                                        $i++;
          mysql::query($query);
      }
    }
    }


    public function updateSkundai($data){
        if(isset($data['skundai']) && sizeof($data['skundai']) > 0) {
                        $i=1;
      foreach($data['skundai'] as $key=>$val) {                                
        $query = "  INSERT INTO `{$this->skundu_table}`
                    (
                      `skundas`,
                      `fk_darbuotojas_id`
                    )
                    VALUES
                    (
                      '{$val}',
                      '{$data['Tab_nr']}'
                    )";
                                        $i++;
          mysql::query($query);
      }
    }
    }

    public function getSkundai($id) {
        $query = "  SELECT *
          FROM `{$this->skundu_table}`
          WHERE `fk_darbuotojas_id`='{$id}'";
    $data = mysql::select($query);
    //echo $query;
    return $data;
    }


    public function deleteSkundai($id){
    $query = "  DELETE FROM `{$this->skundu_table}`
          WHERE `fk_darbuotojas_id`='{$id}'";
    mysql::query($query);
    }
    
    
    public function getDarbuotojasList($limit = null, $offset = null) {
  $limitOffsetString = "";
  if(isset($limit)) {
   $limitOffsetString .= " LIMIT {$limit}";
   
   if(isset($offset)) {
    $limitOffsetString .= " OFFSET {$offset}";
   } 
  }
  $query = "  SELECT  `{$this->darbuotojas_table}`.`Tab_nr`,
                                    `{$this->darbuotojas_table}`.`Vardas`,
                                    `{$this->darbuotojas_table}`.`Pavarde`,
                                    `{$this->darbuotojas_table}`.`El_pastas`,
                                    `{$this->darbuotojas_table}`.`Pareigos`,
                                    `{$this->darbuotojas_table}`.`Idarbinimo_data`,
                                    `{$this->darbuotojas_table}`.`fk_ImoneImones_id`
     
     FROM `{$this->darbuotojas_table}` {$limitOffsetString} ";
     /*,
                                             `{$this->imones_table}`
      WHERE `{$this->miestas_table}`.`Miesto_id`=`{$this->imones_table}`.`fk_MiestasMiesto_id`{$limitOffsetString}*/
                                                
  $data = mysql::select($query);
  return $data;
 }

 public function insertDarbuotojas($data) {
    $query = "  INSERT INTO {$this->darbuotojas_table}
                (
                  `Vardas`,
                  `Pavarde`,
                  `El_pastas`,
                  `Pareigos`,
                  `Idarbinimo_data`,
                  `fk_ImoneImones_id`
                )
                VALUES
                (
                  '{$data['Vardas']}',
                  '{$data['Pavarde']}',
                  '{$data['El_pastas']}',
                  '{$data['Pareigos']}',
                  '{$data['Idarbinimo_data']}',
                  '{$data['fk_ImoneImones_id']}'
                )";
                echo $query;
    mysql::query($query);
  }
  // pasibaigti!!!!

  public function updateDarbuotojas($data) {
    echo "data ".implode("|",$data);
    $query = "  UPDATE {$this->darbuotojas_table}
          SET    `Vardas`='{$data['Vardas']}',
                 `Pavarde`='{$data['Pavarde']}',
                 `El_pastas`='{$data['El_pastas']}',
                 `Pareigos`='{$data['Pareigos']}',
                 `Idarbinimo_data`='{$data['Idarbinimo_data']}'
          WHERE `Tab_nr`='{$data['Tab_nr']}'";
    mysql::query($query);
  }

  public function deleteDarbuotojas($id) {
    $query = "  DELETE FROM {$this->darbuotojas_table}
          WHERE `Tab_nr`='{$id}'";
    mysql::query($query);
  }

  public function getSutartisCountOfDarbuotojas($id) {
    $query = "  SELECT COUNT({$this->sutartis_table}.`Nr`) AS `kiekis`
          FROM {$this->sutartis_table}
            INNER JOIN {$this->darbuotojas_table}
              ON {$this->sutartis_table}.`fk_DarbuotojasTab_nr`={$this->darbuotojas_table}.`Tab_nr`
          WHERE {$this->darbuotojas_table}.`Tab_nr`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }
    
}