<?php

include('../config.php');
include(APP_PATH . '/inc/customer.php');
include(APP_PATH . '/inc/mnemonique.php');
include(APP_PATH . '/inc/write_file.php');

$db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASS);

// liste des mnemoniques à transmettre
$mnemoniques = [
	// "fac_volume" 	=> "SSTAP#FACT_FQ100__M_F_",
	// "fac_energie" 	=> "SSTAP#FACT_JQ131__M_F_",
	"ech_1_aller" 	=> "SSTAP#ECH01TT131__M___",
	"ech_2_aller" 	=> "SSTAP#ECH02TT131__M___",
	"ech_3_aller" 	=> "SSTAP#ECH03TT131__M___",
	"ech_4_aller" 	=> "SSTAP#ECH04TT131__M___",
	"ech_1_retour" 	=> "SSTAP#ECH01TT132__M___",
	"ech_2_retour" 	=> "SSTAP#ECH02TT132__M___",
	"ech_3_retour" 	=> "SSTAP#ECH03TT132__M___",
	"ech_4_retour" 	=> "SSTAP#ECH04TT132__M___",
	"debit" 		=> "SSTAP#JQT01FT120__M___",
	"energie" 		=> "SSTAP#JQT01JQ131__M___",
	"volume" 		=> "SSTAP#JQT01FQ100__M___",
	"delta_t" 		=> "SSTAP#JQT01TDT100_M___",
	"puissance" 	=> "SSTAP#JQT01JT100__M___",
	"t_aller" 		=> "SSTAP#JQT01TT110__M___",
	"t_retour" 		=> "SSTAP#JQT01TT120__M___",
];


foreach( $db->query('select id from customers where active=1') as $row ) {
	$c = new Customer();
	$c->get($row['id']);
	
	echo "<h1>$c->code</h1>";
	
	$m = new Mnemonique();
	$r = array();
	// Exception les halles
	$halles = $c->code == "DEEPKI-URW";
	
	foreach($c->postes() as $poste){
		$p = sprintf("%-05s", str_replace(["A","B","C","D","E","F"], ["1","2","3","4","5","6"],$poste->poste));
		foreach($mnemoniques as $k=>$mnemonique){
			$mnemo = str_replace("#", $p, $mnemonique);
			// Exception les halles
			if($halles){
				$mnemo = str_replace("SSTA", "CGTH", $mnemo);
			}
			$r[$poste->poste][$k] = $m->getMnemonique($mnemo);
		}
	}

	$write = new WriteFile();
	$write->set("output_path",APP_PATH . "/tmp/");
	$write->set("output_name","installation_schema_".$c->code);
	if($c->format == "xml"){
		$write->asXML($r);
	}else{
		$write->asCSV($r);
	}

} 



