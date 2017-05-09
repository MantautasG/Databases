<ul id="pagePath">
  <li><a href="index.php">Pradžia</a></li>
  <li>Mokejimai</li>
</ul>
<div id="actions">
  <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas mokejimas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
  <div class="errorBox">
    Mokejimas nebuvo pašalintas. Pirmiausia pašalinkite klientu mokejimus
  </div>
<?php } ?>

<table class="listTable">
  <tr>
    <th>Data</th>
    <th>Suma</th>
    <th>Mokejimo_id</th>
    
    <th>Kliento_vardas</th>
    <th>Sutarties_data</th>
    <th></th>
  </tr>
  <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
      echo
        "<tr>"
          . "<td>{$val['Data']}</td>"
          . "<td>{$val['Suma']}</td>"
          . "<td>{$val['Mokejimo_id']}</td>"
         // . "<td>{$val['El_pastas']}</td>"
          . "<td>{$val['Vardas']}</td>"
          . "<td>{$val['Data']}</td>"
          . "<td>"
            . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Mokejimo_id']}\"); return false;' title=''>šalinti</a>&nbsp;"
            . "<a href='index.php?module={$module}&action=edit&id={$val['Mokejimo_id']}' title=''>redaguoti</a>"
          . "</td>"
        . "</tr>";
    }
  ?>
</table>

<?php
  // įtraukiame puslapių šabloną
  include 'templates/paging.tpl.php';
?>