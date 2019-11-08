<?php 
require_once(APP_PATH."/inc/swarmtype.php");
?>

<div class="container customer object">

	<?php if( sizeof($this->obj->swarms()) > 0 ): ?>

		<h1>Mes essaims</h1>
		<?php print_r($this->obj->swarms()); ?>

	<?php else: ?>

		<h1>Creer un nouvel essaim</h1>
		
		<form method="post">
			<input type="hidden" name="action" value="create">
			<button type="submit" class="btn btn-primary">Creer</button>
			
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="name">Nom de l'essaim</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'essaim">
				</div>
				
				<?php 
					$st = new SwarmType();
					print_r($st->all()); 
				?>
				
				<div class="form-group col-md-12">
				<table class="table">
					<?php foreach($st->all() as $type): ?>
						<div class="form-check">
							<input type="radio" class="form-check-input" id="type-<?=$type->id?>" name="type" value="<?=$type->id?>"/>
							<label for="type-<?=$type->id?>" class="form-check-label">
								<?=$type->name?>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</form>

	<?php endif; ?>
	
</div>