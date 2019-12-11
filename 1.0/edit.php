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
<form name="display" action="edit.php" method="POST" >


 
 <li> Labošana</li>

<select name="columnu">
    <option value="pasutijuma_nummurs"> Pasutijuma nummurs </option>
    <option value="telefons"> Telefons</option>
    <option value="vards"> Vārds</option>
    <option value="uzvards"> Uzvārds</option>
</select>
<input type="text" name="searchu">
 
                             Status:
<input type="text" name="update" size="8" />
                             Kurš laboja:
<input type="text" name="update1" size="8" />
                             Kas ir izdarīts:
<input type="text" name="update2" size="20" /> 
                             Cena:
<input type="text" name="update3" size="3" />                                                         

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



   
$query = "SELECT DISTINCT * FROM serviss order by pasutijuma_nummurs desc";
    $result = pg_query($query) or die('Error message: ' . pg_last_error());
    

    $query = "UPDATE serviss SET statuss = '$_POST[update]' WHERE $_POST[columnu] = '$_POST[searchu]' ";
    $result = pg_query($query);

    $query = "UPDATE serviss SET laboja = '$_POST[update1]' WHERE $_POST[columnu] = '$_POST[searchu]' ";
        $result = pg_query($query);

    $query = "UPDATE serviss SET izdarits = '$_POST[update2]' WHERE $_POST[columnu] = '$_POST[searchu]' "; 
        $result = pg_query($query);

    $query = "UPDATE serviss SET cena = '$_POST[update3]' WHERE $_POST[columnu] = '$_POST[searchu]' ";
        $result = pg_query($query);

        $query = "SELECT DISTINCT * FROM serviss order by pasutijuma_nummurs desc";
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

    
    pg_query($dbconn, $query);
 
    pg_free_result($result);

  
  
  

    pg_close($dbconn);
?>


</body>
</html>



