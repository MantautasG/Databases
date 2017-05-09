<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Esami miestai</a></li>
	<li><?php if(!empty($id)) echo "Miesto redagavimas"; else echo "Naujas miestas"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Neįvesti arba neteisingai įvesti šie laukai:
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			<legend>Miesto informacija</legend>
			

			<p>
				<label class="field" for="Pavadinimas">Pavadinimas<?php echo in_array('Pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pavadinimas" name="Pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['Pavadinimas']) ? $data['Pavadinimas'] : ''; ?>" />
				<?php if(key_exists('Pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pavadinimas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Rajonas">Rajonas<?php echo in_array('Rajonas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Rajonas" name="Rajonas" class="textbox textbox-150" value="<?php echo isset($data['Rajonas']) ? $data['Rajonas'] : ''; ?>" />
				<?php if(key_exists('Rajonas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Rajonas']} simb.)</span>"; ?>
			</p>


		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['Miesto_id'])) { ?>
			<input type="hidden" name="Miesto_id" value="<?php echo $data['Miesto_id']; ?>" />
		<?php } ?>
	</form>
</div>