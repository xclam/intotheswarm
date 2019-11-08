<h1>Clients</h1>

<a href="?m=customer&v=object" class="btn btn-primary mb-3">Nouveau</a>

<?php
		
$l = $this->obj->all();
// print_r($this->obj);
if(sizeof($l) < 1 ){
	echo '<div class="">Il n\'existe aucun fournisseur. Creer le premier maintenant.</div>';
} else {
	echo '<table class="table data-table" id="customer-table-list">';
	echo '  <thead><tr><th></th><th>Code</th><th>Nom</th><th>Répertoire</th><th>Actif</th></tr></thead>';
	echo '	<tbody>';
	foreach($l as $f){
		echo '<tr class="clickable" data-url="'.APP_URL.'/?m=customer&v=object&id='.$f->id.'">';
		echo '<td></td><td>'.$f->code.'</td><td>'.$f->name.'</td><td>'.$f->directory.'</td><td>'.$f->active.'</td></tr>'; 
	}
	echo '	</tbody>';
	echo '</table>';
}