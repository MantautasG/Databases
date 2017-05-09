<ul id="pagePath">
  <li><a href="index.php">Pradžia</a></li>
  <li>Paslaugos</li>
</ul>
<div id="actions">
  <a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja paslauga</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
  <div class="errorBox">
    Paslauga nebuvo pašalinta. Pirmiausia pašalinkite uzsakytu paslaugas
  </div>
<?php } ?>

<table class="listTable">
  <tr>
    <th>Pavadinimas</th>
    <th>Aprasymas</th>
    <th>Paslaugos id</th>
    <th></th>
  </tr>
  <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
      echo
        "<tr>"
          . "<td>{$val['Pavadinimas']}</td>"
          . "<td>{$val['Aprasymas']}</td>"
          . "<td>{$val['Pasaugos_id']}</td>"
          . "<td>"
            . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Pasaugos_id']}\"); return false;' title=''>šalinti</a>&nbsp;"
            . "<a href='index.php?module={$module}&action=edit&id={$val['Pasaugos_id']}' title=''>redaguoti</a>"
          . "</td>"
        . "</tr>";
    }
  ?>
</table>

<?php
  // įtraukiame puslapių šabloną
  include 'templates/paging.tpl.php';
?>