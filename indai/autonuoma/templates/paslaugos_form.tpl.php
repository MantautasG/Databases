<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Esamos paslaugos</a></li>
	<li><?php if(!empty($id)) echo "Paslaugos redagavimas"; else echo "Nauja paslauga"; ?></li>
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
			<legend>Paslaugos informacija</legend>
			

			<p>
				<label class="field" for="Pavadinimas">Pavadinimas<?php echo in_array('Pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pavadinimas" name="Pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['Pavadinimas']) ? $data['Pavadinimas'] : ''; ?>" />
				<?php if(key_exists('Pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pavadinimas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Aprasymas">Aprasymas<?php echo in_array('Aprasymas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Aprasymas" name="Aprasymas" class="textbox textbox-150" value="<?php echo isset($data['Aprasymas']) ? $data['Aprasymas'] : ''; ?>" />
				<?php if(key_exists('Aprasymas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Aprasymas']} simb.)</span>"; ?>
			</p>


		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['Pasaugos_id'])) { ?>
			<input type="hidden" name="Pasaugos_id" value="<?php echo $data['Pasaugos_id']; ?>" />
		<?php } ?>
	</form>
</div>