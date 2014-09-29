<html>
<head>
  <title>Homework</title>
  <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
  <style type="text/css">
    a, a:visited, a:active {
      color: #262626;
    }
    table, h1 {
      margin: 1.3em auto 0 auto;
      text-align: center; 
      border-collapse: collapse;
      font-family: Arial;
      color:  #262626;
    }
    td, th { padding: .5em; }
    th {
      background-color: gray;
    }
    tr:hover {
      background-color:lightgrey;
    }
    tr {
      border-bottom: 1px solid grey;
    }
    td:hover {
      background-color:grey;
    }
  </style>
  <script type="text/javascript">
    var previouslySorted = 0;
    function sortTable(column) {
      var table = document.getElementsByTagName("table")[0];
      var tbody = document.getElementsByTagName("tbody")[0];
      var rows = tbody.rows;
      var rowArray = new Array();
      for (var i=0, length=rows.length; i<length; i++) {
        rowArray[i] = new Object;
        rowArray[i].oldIndex = i;
        rowArray[i].value = rows[i].getElementsByTagName('td')[column].firstChild.nodeValue;
      }
      if (column == previouslySorted) { rowArray.reverse(); }
      else {
        previouslySorted = column;
        if (previouslySorted == 0) {
          rowArray.sort(Numerically);
        }
        else if (previouslySorted == 1) {
          rowArray.sort(Alphabetically);
        }
        else {
          rowArray.sort(Numerically);
        }
      }
      var newTbody = document.createElement('tbody');
      for (var i=0, length=rowArray.length; i<length; i++) {
        newTbody.appendChild(rows[rowArray[i].oldIndex].cloneNode(true));
      }
      table.replaceChild(newTbody, tbody);
    } 
    function Alphabetically(a, b) {
      return new Intl.Collator("cz").compare(a.value,b.value);
    }
    function Numerically(a, b) {
      return (a.value - b.value);
    }
  </script>
</head>
<body>
  <?php
  echo "<h1>Dooh!</h1>";  
  include_once 'homework.php';
  $please = new Homework();
  $table_header = "<thead><tr><th><a href='javascript:;' onclick='sortTable(0);'>Poradie</a></th><th><a href='javascript:;' onclick='sortTable(1);'>Názov mužstva</a></th><th><a href='javascript:;' onclick='sortTable(2);'>Zápasy</a></th><th><a href='javascript:;' onclick='sortTable(3);'>Výhry</a></th><th><a href='javascript:;' onclick='sortTable(4);'>Výhry po predlžení</a></th><th><a href='javascript:;' onclick='sortTable(5);'>Prehry po predlžení</a></th><th><a href='javascript:;' onclick='sortTable(6);'>Prehry</a></th><th>Skóre</th><th><a href='javascript:;' onclick='sortTable(8);'>Body</a></th><th colspan='10'>Sled výsledkov</th></tr></thead><tbody>";
  $please->tableToJSON("https://www.nike.sk/app/statistika/20590/7/");
  echo $please->JSONtoTable('results.json',$table_header);
  ?>
</body>
</html> 