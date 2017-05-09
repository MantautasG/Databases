<?php
class indas{
    
    private $indo_table = '';
    private $tarpininko_table = '';
    public function __construct() {
		$this->indo_table = config::DB_PREFIX . 'indas';
                $this->tarpininko_table = config::DB_PREFIX . 'tarpininkas';
    }
    
    public function getIndasList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		$query = "  SELECT  `{$this->indo_table}`.`BAR_kodas`,
                                    `{$this->indo_table}`.`Spalva`,
                                    `{$this->indo_table}`.`Pagaminimo_data`,
                                    `{$this->indo_table}`.`Pagaminimo_salis`,
                                    `{$this->indo_table}`.`Ornamentai`,
                                    `{$this->indo_table}`.`Verte`,
                                    `{$this->indo_table}`.`Indo_diametras`,
                                    `{$this->indo_table}`.`Tipas`,
                                    `{$this->indo_table}`.`Medziaga`,
                                    `{$this->indo_table}`.`Busena`,
                                    `{$this->indo_table}`.`Paskirtis`
					FROM `{$this->indo_table}`
                                        {$limitOffsetString}";
		$data = mysql::select($query);
             //   echo "data".$query;
		return $data;
	}
    
}