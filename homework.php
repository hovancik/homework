<?php
/* yet another table to json class 
 * Jan Hovacik, 2014, http://hovancik.net */

class Homework {

  public function tableToJSON($url) {
    
    $html = file_get_contents($url);
    $dom = new domDocument;
    $dom->loadHTML($html);
    $dom->preserveWhiteSpace = false;
    $tables = $dom->getElementsByTagName('table');
    $rows = $tables->item(0)->getElementsByTagName('tr');
    $array_for_json = Array();
    $i = 0;
    foreach ($rows as $row)
    {
      $cols = $row->getElementsByTagName('td');
      $array_for = Array();
      $y = 0;
      foreach ($cols as $col)
      {
        $array_for[$y] = $col->nodeValue;
        $y++;
      }
      $array_for_json[$i] = $array_for;
      $i++;
    } 
    
    unset($array_for_json[0]);
    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($array_for_json));
    fclose($fp);
  }

  public function JSONtoTable($file,$table_header) {
    $fh = fopen($file, 'r');
    $theData = fread($fh, filesize($file));
    fclose($fh);
    $x = json_decode($theData, true);
    $echos = "<table>";
    $echos .= $table_header;
    foreach ( $x as $key => $value ) { 
      $echos .= "<tr>";
      foreach ( $value as $dkey => $dvalue) {
        $echos.= "<td>$dvalue</td>";
      }
      $echos.=  "</tr>";
    } 
    $echos.= "</tbody></table>";
    return $echos;
  }
}
?>