<?php

class mokejimas{
    private $mokejimas_table = '';
    private $klientas_table = ''; 
    private $saskaita_table = '';
    //private $skundu_table = '';
    
    public function __construct() {
  $this->mokejimas_table = config::DB_PREFIX . 'mokejimas';
  $this->klientas_table = config::DB_PREFIX . 'klientas';
  $this->saskaita_table = config::DB_PREFIX . 'saskaita';
  //$this->skundu_table = config::DB_PREFIX . 'skundai';

    }

    public function getMokejimas($id) {
    $query = "  SELECT *
          FROM {$this->mokejimas_table}
          WHERE `Mokejimo_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0];
    }
    
    public function getMokejimasListCount() {
  $query = "  SELECT COUNT(`{$this->mokejimas_table}`.`Mokejimo_id`) as `kiekis`
     FROM `{$this->mokejimas_table}`";
  $data = mysql::select($query);
  return $data[0]['kiekis'];
    }


    public function getKlientas(){
        $query = "Select * FROM `{$this->klientas_table}`";
        $data = mysql::select($query);
  return $data;

    }

    public function getSaskaita(){
        $query = "Select * FROM `{$this->saskaita_table}`";
        $data = mysql::select($query);
  return $data;
    }

    
    
    public function getMokejimasList($limit = null, $offset = null) {
  $limitOffsetString = "";
  if(isset($limit)) {
   $limitOffsetString .= " LIMIT {$limit}";
   
   if(isset($offset)) {
    $limitOffsetString .= " OFFSET {$offset}";
   } 
  }
  $query = "  SELECT  `{$this->mokejimas_table}`.`Data`,
                                    `{$this->mokejimas_table}`.`Suma`,
                                    `{$this->mokejimas_table}`.`Mokejimo_id`,
                                    `{$this->klientas_table}`.`Vardas`,
                                    `{$this->saskaita_table}`.`Data`,
                                    `{$this->mokejimas_table}`.`fk_SaskaitaSaskaitos_id`
     
     FROM `{$this->mokejimas_table}` ,
                                  `{$this->klientas_table}`,
                                  `{$this->saskaita_table}`
    WHERE `{$this->mokejimas_table}`.`fk_KlientasAsm_kodas`=`{$this->klientas_table}`.`Asm_kodas` AND 
    `{$this->mokejimas_table}`.`fk_SaskaitaNr`=`{$this->saskaita_table}`.`Nr`{$limitOffsetString}";
                                                
    $data = mysql::select($query);
    return $data;
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

 public function insertMokejimas($data) {
    $query = "  INSERT INTO {$this->mokejimas_table}
                (
                  `Data`,
                  `Suma`,
                  `fk_KlientasAsm_kodas`,
                  `fk_SaskaitaNr`
                )
                VALUES
                (
                  '{$data['Data']}',
                  '{$data['Suma']}',
                  '{$data['fk_KlientasAsm_kodas']}',
                  '{$data['fk_SaskaitaNr']}'
                )";
                echo $query;
    mysql::query($query);
  }
  // pasibaigti!!!!

  public function updateMokejimas($data) {
    echo "data ".implode("|",$data);
    $query = "  UPDATE {$this->mokejimas_table}
          SET    `Data`='{$data['Data']}',
                 `Suma`='{$data['Suma']}',
                 `fk_KlientasAsm_kodas`='{$data['fk_KlientasAsm_kodas']}',
                 `fk_SaskaitaNr`='{$data['fk_SaskaitaNr']}'
          WHERE `Mokejimo_id`='{$data['Mokejimo_id']}'";
    mysql::query($query);
  }

  public function deleteMokejimas($id) {
    $query = "  DELETE FROM {$this->mokejimas_table}
          WHERE `Mokejimo_id`='{$id}'";
    mysql::query($query);
  }

 /* public function getMokejimasCountOfKlientas($id) {
    $query = "  SELECT COUNT({$this->mokejimas_table}.`Mokejimo_id`) AS `kiekis`
          FROM {$this->mokejimas_table}
            INNER JOIN {$this->klientas_table}
              ON {$this->mokejimas_table}.`fk_KlientasAsm_kodas`={$this->klientas_table}.`Asm_kodas`
          WHERE {$this->mokejimas_table}.`Mokejimo_id`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }*/
    
}