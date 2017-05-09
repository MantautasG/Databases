<ul id="pagePath">
  <li><a href="index.php">Pradžia</a></li>
  <li>Miestai</li>
</ul>
<div id="actions">
  <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas miestas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
  <div class="errorBox">
    Miestas nebuvo pašalintas. Pirmiausia pašalinkite imones, esančias mieste
  </div>
<?php } ?>

<table class="listTable">
  <tr>
    <th>Pavadinimas</th>
    <th>Rajonas</th>
    <th>Miesto_id</th>
    <th></th>
  </tr>
  <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
      echo
        "<tr>"
          . "<td>{$val['Pavadinimas']}</td>"
          . "<td>{$val['Rajonas']}</td>"
          . "<td>{$val['Miesto_id']}</td>"
          . "<td>"
            . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Miesto_id']}\"); return false;' title=''>šalinti</a>&nbsp;"
            . "<a href='index.php?module={$module}&action=edit&id={$val['Miesto_id']}' title=''>redaguoti</a>"
          . "</td>"
        . "</tr>";
    }
  ?>
</table>

<?php
  // įtraukiame puslapių šabloną
  include 'templates/paging.tpl.php';
?>