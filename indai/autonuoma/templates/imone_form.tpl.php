<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Esamos imones</a></li>
	<li><?php if(!empty($id)) echo "Imones redagavimas"; else echo "Nauja imone"; ?></li>
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
			<legend>Imones informacija</legend>
			

			<p>
				<label class="field" for="Pavadinimas">Pavadinimas<?php echo in_array('Pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pavadinimas" name="Pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['Pavadinimas']) ? $data['Pavadinimas'] : ''; ?>" />
				<?php if(key_exists('Pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pavadinimas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Adresas">Adresas<?php echo in_array('Adresas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Adresas" name="Adresas" class="textbox textbox-150" value="<?php echo isset($data['Adresas']) ? $data['Adresas'] : ''; ?>" />
				<?php if(key_exists('Adresas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Adresas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="El_pastas">El_pastas<?php echo in_array('El_pastas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="El_pastas" name="El_pastas" class="textbox textbox-150" value="<?php echo isset($data['El_pastas']) ? $data['El_pastas'] : ''; ?>" />
				<?php if(key_exists('El_pastas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['El_pastas']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="Telefono_nr">Telefono nr<?php echo in_array('Telefono_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Telefono_nr" name="Telefono_nr" class="textbox textbox-150" value="<?php echo isset($data['Telefono_nr']) ? $data['Telefono_nr'] : ''; ?>" />
				<?php if(key_exists('Telefono_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Telefono_nr']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="Faksas">Faksas<?php echo in_array('Faksas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Faksas" name="Faksas" class="textbox textbox-150" value="<?php echo isset($data['Faksas']) ? $data['Faksas'] : ''; ?>" />
				<?php if(key_exists('Faksas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Faksas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="Valstybe">Valstybe<?php echo in_array('Valstybe', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Valstybe" name="Valstybe" class="textbox textbox-150" value="<?php echo isset($data['Valstybe']) ? $data['Valstybe'] : ''; ?>" />
				<?php if(key_exists('Valstybe', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Valstybe']} simb.)</span>"; ?>
			</p>

			<p>
				<label class="field" for="fk_MiestasMiesto_id">Miestas<?php echo in_array('fk_MiestasMiesto_id', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_MiestasMiesto_id" name="fk_MiestasMiesto_id">
					<option value="-1">Pasirinkite miesta</option>
					<?php
						// išrenkame visas markes
					var_dump($imones);
						$imones = $imoneObj->getMiestasList();
						var_dump($imones);
						foreach($imones as $key => $val) {
							$selected = "";
							if(isset($data['fk_MiestasMiesto_id']) && $data['fk_MiestasMiesto_id'] == $val['Miesto_id']) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['Miesto_id']}'>{$val['Pavadinimas']}</option>";
						}
					?>
				</select>
			</p>
			</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['Imones_id'])) { ?>
			<input type="hidden" name="Imones_id" value="<?php echo $data['Imones_id']; ?>" />
		<?php } ?>
	</form>
</div>