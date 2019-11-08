<?php
$new = true;
if($this->obj->id)
	$new = false;
?>
<div class="container customer object">
	
	<?php if(!$new) : ?>
		<div class="d-flex">
			<form method="post" class="ml-auto p-2 bd-highlight">    
				<input type="hidden" name="action" value="delete">
				<input type="hidden" name="id" value="<?=$this->obj->id?>">
				<button type="submit" class="btn btn-danger confirm">Supprimer</button>
			</form>
		</div>
	<?php endif; ?>

	<form method="post">
		<?php if(!$new) : ?>
			<input type="hidden" name="action" value="update">
			<input type="hidden" name="id" value="<?=$this->obj->id?>">
			<button type="submit" class="btn btn-primary">Modifier</button>
		<?php else : ?>
			<input type="hidden" name="action" value="create">
			<button type="submit" class="btn btn-primary">Creer</button>
		<?php endif; ?>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="code">Code</label>
				<input type="text" class="form-control" id="code" name="code" placeholder="Code" value="<?=$this->obj->code?>">
			</div>
			<div class="form-group col-md-3">
				<label for="name">Nom</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?=$this->obj->name?>">
			</div>
			<div class="form-group col-md-2">
				<label for="active">Actif</label>
				<input type="checkbox" class="form-control" id="active" name="active" <?php echo ($this->obj->active) ? " checked" : "" ?>>
			</div>
			<div class="form-group col-md-2">
				<label for="format-xml">xml</label>
				<input type="radio" class="form-control" id="format-xml" name="format" value="xml" <?php echo ($this->obj->format == "xml") ? " checked" : "" ?>>
			</div>
			<div class="form-group col-md-2">
				<label for="format-csv">csv</label>
				<input type="radio" class="form-control" id="format-csv" name="format" value="csv" <?php echo ($this->obj->format == "csv") ? " checked" : "" ?>>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<h4>FTP de destination</h4>
			</div>
			<div class="form-group col-md-4">
				<label for="ftp_host">Host</label>
				<input type="text" class="form-control" id="ftp_host" name="ftp_host" placeholder="Host" value="<?=$this->obj->ftp_host?>">
			</div>
			<div class="form-group col-md-4">
				<label for="ftp_user">Utilisateur</label>
				<input type="text" class="form-control" id="ftp_user" name="ftp_user" placeholder="Utilisateur" value="<?=$this->obj->ftp_user?>">
			</div>
			<div class="form-group col-md-4">
				<label for="ftp_pass">Mot de passe</label>
				<input type="text" class="form-control" id="ftp_pass" name="ftp_pass" placeholder="Mot de passe" value="<?=$this->obj->ftp_pass?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="directory">Repertoire</label>
				<input type="text" class="form-control" id="directory" name="directory" value="<?=$this->obj->directory?>" >
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<table class="table data-table">
					<thead>
						<tr><th>Poste</th><th>Description</th></tr>
					</thead>
					<tbody>
						<?php foreach( $this->obj->postes() as $poste ) : ?>
							<tr>
								<td><input type="text" class="form-control" name="poste-poste[]" value="<?=$poste->poste?>" required></td>
								<td><input type="text" class="form-control" name="poste-description[]" value="<?=$poste->description?>" ></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<button id="addRow">Add new row</button>
			</div>
		</div>
	</form>
</div>
