<ul id="pagePath">
  <li><a href="index.php">Pradžia</a></li>
  <li>Imones</li>
</ul>
<div id="actions">
  <a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja imone</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
  <div class="errorBox">
    Imone nebuvo pašalinta. Pirmiausia pašalinkite įmonės darbuotojus
  </div>
<?php } ?>

<table class="listTable">
  <tr>
    <th>Pavadinimas</th>
    <th>Adresas</th>
    <th>Faksas</th>
    <th>Valstybe</th>
    <th>Imones id</th>
    <th>Miestas</th>
    <th></th>
  </tr>
  <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
      echo
        "<tr>"
          . "<td>{$val['Pavadinimas']}</td>"
          . "<td>{$val['Adresas']}</td>"
          . "<td>{$val['Faksas']}</td>"
          . "<td>{$val['Valstybe']}</td>"
          . "<td>{$val['Imones_id']}</td>"
          . "<td>{$val['Pavadinimas']}</td>"
          . "<td>"
            . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Imones_id']}\"); return false;' title=''>šalinti</a>&nbsp;"
            . "<a href='index.php?module={$module}&action=edit&id={$val['Imones_id']}' title=''>redaguoti</a>"
          . "</td>"
        . "</tr>";
    }
  ?>
</table>

<?php
  // įtraukiame puslapių šabloną
  include 'templates/paging.tpl.php';
?>