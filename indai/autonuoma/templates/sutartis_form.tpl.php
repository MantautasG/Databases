<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Sutartys</a></li>
	<li><?php if(!empty($id)) echo "Sutarties redagavimas"; else echo "Nauja sutartis"; ?></li>
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
			<legend>Sutarties informacija</legend>

			<p>
				<label class="field" for="Isnuomavimo_data">Isnuomavimo data<?php echo in_array('Isnuomavimo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Isnuomavimo_data" name="Isnuomavimo_data" class="date" value="<?php echo isset($data['Isnuomavimo_data']) ? $data['Isnuomavimo_data'] : ''; ?>">
			</p>
                       
			<p>
				<label class="field" for="Planuojamas_grazinimas">Planuojamas grazinimas<?php echo in_array('Planuojamas_grazinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Planuojamas_grazinimas" name="Planuojamas_grazinimas" class="date" value="<?php echo isset($data['Planuojamas_grazinimas']) ? $data['Planuojamas_grazinimas'] : ''; ?>">
			</p>
			<p>
				<label class="field" for="Kaina">Kaina<?php echo in_array('Kaina', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Kaina" name="Kaina" class="textbox textbox-70" value="<?php echo isset($data['Kaina']) ? $data['Kaina'] : ''; ?>">
			</p>

			<p>
				<label class="field" for="Faktine_grazinimo_data">Faktine grazinimo data<?php echo in_array('Faktine_grazinimo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Faktine_grazinimo_data" name="Faktine_grazinimo_data" class="date" value="<?php echo isset($data['Faktine_grazinimo_data']) ? $data['Faktine_grazinimo_data'] : ''; ?>">
			</p>
			<p>
				<label class="field" for="Busena">Busena<?php echo in_array('Busena', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Busena" name="Busena" class="textbox textbox-70" value="<?php echo isset($data['Busena']) ? $data['Busena'] : ''; ?>">
			</p>
			<p>
				<label class="field" for="Pradine_bukle">Pradine bukle<?php echo in_array('Pradine_bukle', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pradine_bukle" name="Pradine_bukle" class="textbox textbox-70" value="<?php echo isset($data['Pradine_bukle']) ? $data['Pradine_bukle'] : ''; ?>">
			</p>
			<p>
				<label class="field" for="Galutine_bukle">Galutine bukle<?php echo in_array('Galutine_bukle', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Galutine_bukle" name="Galutine_bukle" class="textbox textbox-70" value="<?php echo isset($data['Galutine_bukle']) ? $data['Galutine_bukle'] : ''; ?>">
			</p>
                                     
                        <p>
                                <label class="field" for="fk_DarbuotojasTab_nr">Darbuotojas<?php echo in_array('fk_DarbuotojasTab_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_DarbuotojasTab_nr" name="fk_DarbuotojasTab_nr">
					<option value="">---------------</option>
					<?php
						// išrenkame aikšteles
						$clients = $sutartisObj->getDarbuotojas();
						foreach($clients as $key => $val) {
							$selected = "";
							if(isset($data['fk_DarbuotojasTab_nr']) && $data['fk_DarbuotojasTab_nr'] == $val['Tab_nr']) {
								$selected = " selected='selected'";
							}
                                                        
							echo "<option{$selected} value='{$val['Tab_nr']}'>{$val['Vardas']} {$val['Pavarde']}</option>";
						}
                                                
					?>
                                        
				</select>
                        </p>


                        <p>
                                <label class="field" for="fk_KlientasAsm_kodas">Klientas<?php echo in_array('fk_KlientasAsm_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_KlientasAsm_kodas" name="fk_KlientasAsm_kodas">
					<option value="">---------------</option>
					<?php
						// išrenkame aikšteles
						$clients = $sutartisObj->getKlientas();
						foreach($clients as $key => $val) {
							$selected = "";
							if(isset($data['fk_KlientasAsm_kodas']) && $data['fk_KlientasAsm_kodas'] == $val['Asm_kodas']) {
								$selected = " selected='selected'";
							}
                                                        
							echo "<option{$selected} value='{$val['Asm_kodas']}'>{$val['Vardas']} {$val['Pavarde']}</option>";
						}
                                                
					?>
                                        
				</select>
                        </p>


		</fieldset>

		<fieldset>
			<legend>Indai</legend>
			<div class="childRowContainer">
				<div class="labelLeft wide<?php if(empty($data['Items']) || sizeof($data['Items']) == 0) echo ' hidden'; ?>">Indai</div>
				<div class="float-clear"></div>
				<?php
					if(empty($data['Items']) || sizeof($data['Items']) == 0) {
				?>
                                <div class="childRow hidden">
                                    <select style="width: 380px" class="elementSelector" name="paslaugos[]" disabled="disabled">
                                        <?php
								$tmp = $indasObj->getIndasList();
								foreach($tmp as $key1 => $val1) {
									
										$selected = "";
										if(isset($data['fk_IndoIndas_id']) && $data['fk_IndoIndas_id'] == $val1['BAR_kodas']) {
											$selected = " selected='selected'";
										}
										echo "<option{$selected} value='{$val1['BAR_kodas']}'>{$val1['Spalva']} {$val1['Verte']} EUR</option>";
								}
					?>
                                    </select>
                                    <input type="text" name="kiekiai[]" class="textbox textbox-30" value="" disabled="disabled" />
                                    <a href="#" title="" class="removeChild">Šalinti</a>
                                </div>
                                <div class="float-clear"></div>
                                <?php
					} else {
						foreach($data['Items'] as $key => $val) {
                                                    
				?>
                                <div class="childRow">
                                        <select style="width: 380px" class="elementSelector" name="paslaugos[]">
                                            <?php
								$tmp = $indasObj->getIndasList();
								foreach($tmp as $key1 => $val1) {
									
										$selected = "";
										if( $val['fk_IndoIndas_id'] == $val1['BAR_kodas']) {
											$selected = " selected='selected'";
										}
										echo "<option{$selected} value='{$val1['BAR_kodas']}'>{$val1['Spalva']} {$val1['Verte']} EUR</option>";
									
								}
					?>
                                        </select>
                                        <input type="text" name="kiekiai[]" class="textbox textbox-30" value="<?php echo isset($val['Count']) ? $val['Count'] : ''; ?>" />
                                        <a href="#" title="" class="removeChild">šalinti</a>
                                </div>
                                <div class="float-clear"></div>
                                <?php 
                                                }
					}
				?>
			</div>
			<p id="newItemButtonContainer">
                            <a href="#" title="" class="addChild" >Pridėti</a>
			</p>
		</fieldset>
		<p class="required-note">* Pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<input type="hidden" name="Nr" value="<?php echo isset($Nr) ? $Nr : ''; ?>" />
	</form>
</div>

