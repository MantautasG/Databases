<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Esami darbuotojai</a></li>
	<li><?php if(!empty($id)) echo "Darbuotojo redagavimas"; else echo "Naujas darbuotojas"; ?></li>
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
			<legend>Darbuotojo informacija</legend>
			

			<p>
				<label class="field" for="Vardas">Vardas<?php echo in_array('Vardas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Vardas" name="Vardas" class="textbox textbox-150" value="<?php echo isset($data['Vardas']) ? $data['Vardas'] : ''; ?>" />
				<?php if(key_exists('Vardas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Vardas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Pavarde">Pavarde<?php echo in_array('Pavarde', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pavarde" name="Pavarde" class="textbox textbox-150" value="<?php echo isset($data['Pavarde']) ? $data['Pavarde'] : ''; ?>" />
				<?php if(key_exists('Pavarde', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pavarde']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="El_pastas">El_pastas<?php echo in_array('El_pastas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="El_pastas" name="El_pastas" class="textbox textbox-150" value="<?php echo isset($data['El_pastas']) ? $data['El_pastas'] : ''; ?>" />
				<?php if(key_exists('El_pastas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['El_pastas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Pareigos">Pareigos<?php echo in_array('Pareigos', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pareigos" name="Pareigos" class="textbox textbox-150" value="<?php echo isset($data['Pareigos']) ? $data['Pareigos'] : ''; ?>" />
				<?php if(key_exists('Pareigos', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pareigos']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="Idarbinimo_data">Idarbinimo_data<?php echo in_array('Idarbinimo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Idarbinimo_data" name="Idarbinimo_data" class="date" value="<?php echo isset($data['Idarbinimo_data']) ? $data['Idarbinimo_data'] : ''; ?>" />
				<?php if(key_exists('Idarbinimo_data', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Idarbinimo_data']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="fk_ImoneImones_id">Imone<?php echo in_array('fk_ImoneImones_id', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_ImoneImones_id" name="fk_ImoneImones_id">
					<option value="-1">Pasirinkite imone</option>
					<?php
						// išrenkame visas markes
						$imones = $darbuotojasObj->getImoneList();
						foreach($imones as $key => $val) {
							$selected = "";
							if(isset($data['fk_ImoneImones_id']) && $data['fk_ImoneImones_id'] == $val['Imones_id']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['Imones_id']}'>{$val['Pavadinimas']}</option>";
						}
					?>
				</select>
			</p>
</fieldset>
            <fieldset>
			<legend>Skundai</legend>
			<div class="childRowContainer">
				<div class="labelLeft<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) echo ' hidden'; ?>">Skundai</div>
				<div class="float-clear"></div>
				<?php
					if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) {
				?>
					
					<div class="childRow hidden">
						<input style="width: 380px" type="text" name="skundai[]" value="" class="textbox" />
						
						<a href="#" title="" class="removeChild">šalinti</a>
					</div>
					<div class="float-clear"></div>
					
				<?php
					} else {
						foreach($data['paslaugos_kainos'] as $key => $val) {
				?>
							<div class="childRow">
								<input style="width: 380px" type="text" name="skundai[]" value="<?php echo $val['skundas']; ?>" class="textbox" />
								
								<a href="#" title="" class="removeChild">šalinti</a>
							</div>
							<div class="float-clear"></div>
				<?php 
						}
					}
				?>
			</div>
			<p id="newItemButtonContainer">
				<a href="#" title="" class="addChild">Pridėti</a>
			</p>
		</fieldset> 
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<input type="hidden" name="Tab_nr" value="<?php echo isset($Tab_nr) ? $Tab_nr : ''; ?>" />
	</form>
</div>