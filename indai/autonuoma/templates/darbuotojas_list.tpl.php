<ul id="pagePath">
  <li><a href="index.php">Pradžia</a></li>
  <li>Darbuotojai</li>
</ul>
<div id="actions">
  <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas darbuotojas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
  <div class="errorBox">
    Darbuotojas nebuvo pašalintas. Pirmiausia pašalinkite darbuotojų sutartis
  </div>
<?php } ?>

<table class="listTable">
  <tr>
    <th>Tab_nr</th>
    <th>Vardas</th>
    <th>Pavarde</th>
    
    <th>Pareigos</th>
    <th>Idarbinimo_data</th>
    <th></th>
  </tr>
  <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
      echo
        "<tr>"
          . "<td>{$val['Tab_nr']}</td>"
          . "<td>{$val['Vardas']}</td>"
          . "<td>{$val['Pavarde']}</td>"
         // . "<td>{$val['El_pastas']}</td>"
          . "<td>{$val['Pareigos']}</td>"
          . "<td>{$val['Idarbinimo_data']}</td>"
          . "<td>"
            . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Tab_nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
            . "<a href='index.php?module={$module}&action=edit&id={$val['Tab_nr']}' title=''>redaguoti</a>"
          . "</td>"
        . "</tr>";
    }
  ?>
</table>

<?php
  // įtraukiame puslapių šabloną
  include 'templates/paging.tpl.php';
?>