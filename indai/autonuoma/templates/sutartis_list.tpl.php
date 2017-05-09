<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Sutartys</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja sutartis</a>
</div>
<div class="float-clear"></div>
<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Sutartis nebuvo pašalinta. Su sutartim yra susietos užsakytomis paslaugomis.
	</div>
<?php } ?>
<table class="listTable">
	<tr>
                <th>Nr</th>
		<th>Isnuomavimo_data</th>
                <th>Planuojamas_grazinimas</th>
                <th>Kaina</th>
                <th>Faktine_graz_data</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
                                        . "<td>{$val['Nr']}</td>"
										. "<td>{$val['Isnuomavimo_data']}</td>"
                                        . "<td>{$val['Planuojamas_grazinimas']}</td>"
                                        . "<td>{$val['Kaina']}</td>"
                                        . "<td>{$val['Faktine_grazinimo_data']}</td>"
                                        . "<td>"
                                                . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['Nr']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';

