<?php
class sutartis{
    private $sutartis_table = '';
    private $indo_table = '';
    private $tarpininko_table = '';
    private $darbuotojas_table = '';
    private $klientas_table = '';
    private $uzsakytu_lentele = '';
    public function __construct() {
		$this->sutartis_table = config::DB_PREFIX . 'sutartis';
                $this->indo_table = config::DB_PREFIX . 'indas';
                $this->tarpininko_table = config::DB_PREFIX . 'tarpininkas';
                $this->darbuotojas_table= config::DB_PREFIX . 'darbuotojas';
                $this->klientas_table= config::DB_PREFIX . 'klientas';
                $this->uzsakytu_lentele= config::DB_PREFIX . 'uzsakyta_paslauga';
    }
    public function getSutartisListCount() {
		$query = "  SELECT COUNT(`{$this->sutartis_table}`.`Nr`) as `kiekis`
					FROM `{$this->sutartis_table}`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
    }

    public function getKlientas(){
        $query = "Select * FROM `{$this->klientas_table}`";
        $data = mysql::select($query);
	return $data;

    }

    public function getDarbuotojas(){
        $query = "Select * FROM `{$this->darbuotojas_table}`";
        $data = mysql::select($query);
	return $data;
    }
    
    public function insertSutartis($data){
        
        $query = "  INSERT INTO `{$this->sutartis_table}`
		(
                    `Isnuomavimo_data`,`Planuojamas_grazinimas`,`Kaina`,
                    `Faktine_grazinimo_data`,`Busena`,`Pradine_bukle`,`Galutine_bukle`,
                    `fk_DarbuotojasTab_nr`, `fk_KlientasAsm_kodas`
                )
            VALUES
		(
                    '{$data['Isnuomavimo_data']}','{$data['Planuojamas_grazinimas']}','{$data['Kaina']}',
                    '{$data['Faktine_grazinimo_data']}','{$data['Busena']}', '{$data['Pradine_bukle']}',
                    '{$data['Galutine_bukle']}','{$data['fk_DarbuotojasTab_nr']}', '{$data['fk_KlientasAsm_kodas']}'
		)";
        echo "data ".$query;
		mysql::query($query);
    }


    public function insertTarpininkas($data){
        
        $last=mysql::getLastInsertedId();
        
        if(isset($data['paslaugos']) && sizeof($data['paslaugos']) > 0) {
                        $i=1;
			foreach($data['paslaugos'] as $key=>$val) {
				$tmp = explode(":", $val);
                                
				$query = "  INSERT INTO `{$this->tarpininko_table}`
										(
											`tarpininko_id`,
											`fk_IndoIndas_id`,
											`fk_SutartisSutarties_id`
										)
										VALUES
										(
											'{$i}',
											'{$val}',
											'{$last}'
										)";
                                        $i++;

					mysql::query($query);
                    echo $query;
			}
		}
    }// dar reikia TAISYTIIII
    public function updateTarpininkas($data) {
        $this->deleteTarpininkas($data['Nr']);
        if(isset($data['paslaugos']) && sizeof($data['paslaugos']) > 0) {
                        $i=1;
			foreach($data['paslaugos'] as $key=>$val) {
				$tmp = explode(":", $val);
                                
				$query = "  INSERT INTO `{$this->tarpininko_table}`
										(
											`tarpininko_id`,
											`fk_IndoIndas_id`,
											`fk_SutartisSutarties_id`
										)
										VALUES
										(
											'{$i}',
											'{$val}',
											'{$data['Nr']}'
										)";
                                        $i++;
					mysql::query($query);
			}
		}
    }
    public function getSutartisList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		$query = "  SELECT  `{$this->sutartis_table}`.`Nr`,
                                    `{$this->sutartis_table}`.`Isnuomavimo_data`,
                                    `{$this->sutartis_table}`.`Planuojamas_grazinimas`,
                                    `{$this->sutartis_table}`.`Faktine_grazinimo_data`,
                                    `{$this->sutartis_table}`.`Busena`,
                                    `{$this->sutartis_table}`.`Pradine_bukle`,
                                    `{$this->sutartis_table}`.`Galutine_bukle`,
                                    `{$this->sutartis_table}`.`Kaina`,
                                    `{$this->sutartis_table}`.`fk_DarbuotojasTab_nr`,
                                    `{$this->sutartis_table}`.`fk_KlientasAsm_kodas`
                            FROM `{$this->sutartis_table}`,`{$this->klientas_table}`,
                            `{$this->darbuotojas_table}`
                            Where `{$this->sutartis_table}`.`fk_DarbuotojasTab_nr`=`{$this->darbuotojas_table}`.`Tab_nr`
                            AND `{$this->sutartis_table}`.`fk_KlientasAsm_kodas`=`{$this->klientas_table}`.`Asm_kodas`{$limitOffsetString}";
		$data = mysql::select($query);
		return $data;
    }
    public function getTarpininkas($id) {
        $query = "  SELECT *
					FROM `{$this->tarpininko_table}`
					WHERE `fk_SutartisSutarties_id`='{$id}'";
		$data = mysql::select($query);
		
		return $data;
    }
    // pasidaryti id normalųĄĄĄĄĄĄĄĄĄĄĄĄĄĄĄ
    public function updateSutartis($data) {
        echo "data ".implode("|",$data);
        $query = "  UPDATE {$this->sutartis_table}
					SET    `Isnuomavimo_data`='{$data['Isnuomavimo_data']}',
                                               `Planuojamas_grazinimas`='{$data['Planuojamas_grazinimas']}',
                                               `Faktine_grazinimo_data`='{$data['Faktine_grazinimo_data']}',
                                               `Busena`='{$data['Busena']}',
                                               `Pradine_bukle`='{$data['Pradine_bukle']}',
                                               `Galutine_bukle`='{$data['Galutine_bukle']}',
                                               `Kaina`='{$data['Kaina']}',
                                               `fk_DarbuotojasTab_nr`='{$data['fk_DarbuotojasTab_nr']}',
                                               `fk_KlientasAsm_kodas`='{$data['fk_KlientasAsm_kodas']}'
					WHERE `Nr`='{$data['Nr']}'";
		mysql::query($query);
        return $query;
    }
    public function getSutartis($id) {
		$query = "  SELECT * FROM `{$this->sutartis_table}`
					WHERE `{$this->sutartis_table}`.`Nr`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
    public function deleteSutartis($id) {
        $this->deleteTarpininkas($id);
		$query = "  DELETE FROM `{$this->sutartis_table}`
					WHERE `Nr`='{$id}'";
		mysql::query($query);
    }
    public function deleteTarpininkas($id) {
		$query = "  DELETE FROM `{$this->tarpininko_table}`
					WHERE `fk_SutartisSutarties_id`='{$id}'";
		mysql::query($query);
	}

    public function getPaslaugosCountOfSutartis($id) {
    $query = "  SELECT COUNT({$this->uzsakytu_lentele}.`Uzsakymo_id`) AS `kiekis`
          FROM {$this->uzsakytu_lentele}
            INNER JOIN {$this->sutartis_table}
              ON {$this->sutartis_table}.`Nr_`={$this->uzsakytu_lentele}.`fk_SutartisNr`
          WHERE {$this->sutartis_table}.`Nr`='{$id}'";
    $data = mysql::select($query);
    
    return $data[0]['kiekis'];
  }
 /*   public function getBillsCount($id){
    
        $query = "  SELECT COUNT(`{$this->bill_table}`.`fk_Purchase_orderPurchase_id`) as `kiekis`
					FROM `{$this->bill_table}`
                                        Where `{$this->bill_table}`.`fk_Purchase_orderPurchase_id`='{$id}'";
		$data = mysql::select($query);
		return $data[0]['kiekis'];
    }*/
}

