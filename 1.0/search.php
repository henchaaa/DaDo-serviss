<html>
 <head>  <title>Datu bāzes meklēšana</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="search.css">
 <style>
li {list-style: none;}
</style>
</head>
<body>
<ul>
<form name="display" action="search.php" method="POST" >

<li>Meklēšana</li>
 <select name="column">
    <option value="" > Kārtot pēc...........</option>
    <option value="pasutijuma_nummurs"> Pasutijuma nummura </option>
    <option value="telefons"> Telefona numura </option>
    <option value="vards"> Vārda </option>
    <option value="uzvards"> Uzvārda </option>
 </select>
<input type="text" name="search" />

<li><input type="submit" name="submit" /></li>
</form>
</ul>

 <?php
    
 $dbhost = 'localhost';
    $dbname='serviss';
    $dbuser = 'postgres';
    $dbpass = 'admin';

    $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass")
        or die('Could not connect: ' . pg_last_error());




    $query = "SELECT * FROM serviss WHERE $_POST[column] = '$_POST[search]'";
    $result = pg_query($query) or die('Error message: ' . pg_last_error());
     
      echo "<table>";
        echo "<tr>  <th>Pasutijuma nummurs</th>
                    <th>Datums</th>
                    <th>Vieta</th>
                    <th>Pieņēma</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Telefons</th>
                    <th>E-pasts</th>
                    <th>Veids</th>
                    <th>Parole</th>
                    <th>Garantija</th>
                    <th>papildaprikojums</th>
                    <th>Saglabājamā informācija</th>
                    <th>Defekets</th>
                    <th>Statuss</th>
                    <th>Laboja</th>
                    <th>izdarits</th>
                    <th>Cena</th>
            </tr>";

    while ($row = pg_fetch_row($result)) {
        
         ;
         
       
         echo "<tr onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\">
         <td>$row[0]</td>
         <td>$row[1]</td>
         <td>$row[2]</td>
         <td>$row[3]</td>
         <td>$row[4]</td>
         <td>$row[5]</td>
         <td>$row[6]</td>
         <td>$row[7]</td>
         <td>$row[8]</td>
         <td>$row[9]</td>
         <td>$row[10]</td>
         <td>$row[11]</td>
         <td>$row[12]</td>
         <td>$row[13]</td>
         <td>$row[14]</td>
         <td>$row[15]</td>
         <td>$row[16]</td>
         <td>$row[17]</td>
         
         </tr>\n";

        
    }




    echo "</table>";

    pg_free_result($result);

  


    pg_close($dbconn);
?>


</body>
</html>