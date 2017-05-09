<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Esami mokejimai</a></li>
	<li><?php if(!empty($id)) echo "Mokejimo redagavimas"; else echo "Naujas mokejimas"; ?></li>
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
			<legend>Mokejimo informacija</legend>
			

			<p>
				<label class="field" for="Data">Data<?php echo in_array('Data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Data" name="Data" class="date" value="<?php echo isset($data['Data']) ? $data['Data'] : ''; ?>" />
				<?php if(key_exists('Data', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Data']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Suma">Suma<?php echo in_array('Suma', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Suma" name="Suma" class="textbox textbox-150" value="<?php echo isset($data['Suma']) ? $data['Suma'] : ''; ?>" />
				<?php if(key_exists('Suma', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Suma']} simb.)</span>"; ?>
			</p>
			
			<p>
				<label class="field" for="fk_KlientasAsm_kodas">Klientas<?php echo in_array('fk_KlientasAsm_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_KlientasAsm_kodas" name="fk_KlientasAsm_kodas">
					<option value="-1">Pasirinkite klienta</option>
					<?php
						// išrenkame visas markes
						$imones = $mokejimasObj->getKlientas();
						foreach($imones as $key => $val) {
							$selected = "";
							if(isset($data['fk_KlientasAsm_kodas']) && $data['fk_KlientasAsm_kodas'] == $val['Asm_kodas']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['Asm_kodas']}'>{$val['Vardas']} {$val['Pavarde']}</option>";
						}
					?>
				</select>
			</p>

			<p>
				<label class="field" for="fk_SaskaitaNr">Saskaita<?php echo in_array('fk_SaskaitaNr', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_SaskaitaNr" name="fk_SaskaitaNr">
					<option value="-1">Pasirinkite saskaita</option>
					<?php
						// išrenkame visas markes
						$imones = $mokejimasObj->getSaskaita();
						foreach($imones as $key => $val) {
							$selected = "";
							if(isset($data['fk_SaskaitaNr']) && $data['fk_SaskaitaNr'] == $val['Nr']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['Nr']}'>{$val['Data']} {$val['Suma']}</option>";
						}
					?>
				</select>
			</p>
			</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['Mokejimo_id'])) { ?>
			<input type="hidden" name="Mokejimo_id" value="<?php echo $data['Mokejimo_id']; ?>" />
		<?php } ?>
	</form>
</div>