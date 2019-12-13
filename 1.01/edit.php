<html>
 <head>  <title>Datu bāzes meklēšana</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="search.css">
 <style>
li {list-style: none;}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "";
            }).parent().addClass("pienemts");
        });
    });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "dia";
            }).parent().addClass("diagnostika");
        });
    });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "gatavs";
            }).parent().addClass("done");
        });
    });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "atdods";
            }).parent().addClass("complete");
        });
    });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "parads";
            }).parent().addClass("debt");
        });
    });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $("#table_id").find("tr").each(function(){
         $("td").filter(function()  {
                return $(this).text() === "garantija";
            }).parent().addClass("warranty");
        });
    });
</script>
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
                             Izdevumi:
<input type="text" name="update4" size="3" />
                             Meistara izdevumi:
<input type="text" name="update5" size="3" />                                                         

<li><input type="submit" name="submit" /></li>
</form>
</ul>
<ul>
    <h1>Šādi statusi ir jāievada:</h1>
        "dia" = diagnostika. <br>
        "atdods" = atdods klientam. <br>
        "parads" = Cilvēks nav atdevis naudu pēc iekārtas atdošanas. <br>
        "gatavs" = Gatavs, bet vēl servisā <br>
        "garantija" = Cilvēka ir garantija <br>
        <p> Neaizmirstat ievadīt visus izmaiņas lauciņus. Sorry not sorry</p>
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

        $query = "UPDATE serviss SET izdevumi = '$_POST[update4]' WHERE $_POST[columnu] = '$_POST[searchu]' ";
        $result = pg_query($query);

        $query = "UPDATE serviss SET meistara_izdevumi = '$_POST[update5]' WHERE $_POST[columnu] = '$_POST[searchu]' ";
        $result = pg_query($query);

        $query = "SELECT DISTINCT * FROM serviss order by pasutijuma_nummurs desc";
    $result = pg_query($query) or die('Error message: ' . pg_last_error());

    
    

    
     
     
      echo "<table id=\"table_id\">";
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
                    <th>Izdevumi</th>
                    <th>Meistara Izdevumi</th>
            </tr>";

    while ($row = pg_fetch_row($result)) {
        
         ;
         
       
         echo " <tr class=\"(pienemts == \"serviss\" ? \"pienemts\" : \"\")\", class=\"(dia == \"diagnostika\" ? \"dia\" : \"\")\", class=\"(gatavs == \"done\" ? \"gatavs\" : \"\")\", class=\"(complete == \"atdods\" ? \"atdods\" : \"\")\", class=\"(debt == \"parads\" ? \"parads\" : \"\")\", class=\"(warranty == \"garantija\" ? \"garantija\" : \"\")\" >
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
         <td>$row[18]</td>
         <td>$row[19]</td>
         
         </tr>\n";

        
    }

    




    echo "</table>";

    
    pg_query($dbconn, $query);
 
    pg_free_result($result);

  
  
  

    pg_close($dbconn);
?>


</body>
</html>
