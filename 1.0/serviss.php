<html>
<body>
    <?php
$dbhost = 'localhost';
    $dbname='serviss';
    $dbuser = 'postgres';
    $dbpass = 'admin';

    $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass")
        or die('Could not connect: ' . pg_last_error());

 
$pasutijuma_nummurs = pg_escape_string($_POST['pasutijuma_nummurs']);
    $datums = pg_escape_string($_POST['datums']);
    $vieta = pg_escape_string($_POST['vieta']);
    $pienema = pg_escape_string($_POST['pienema']);
    $vards = pg_escape_string($_POST['vards']);
    $uzvards = pg_escape_string($_POST['uzvards']);
    $telefons = pg_escape_string($_POST['telefons']);
    $email = pg_escape_string($_POST['email']);
    $veids = pg_escape_string($_POST['veids']);
    $parole = pg_escape_string($_POST['parole']);
    $garantija = pg_escape_string($_POST['garantija']);
    $papildaprikojums = pg_escape_string($_POST['papildaprikojums']);
    $saglabajama_info = pg_escape_string($_POST['saglabajama_info']);
    $defekts = pg_escape_string($_POST['defekts']);

adddb($pasutijuma_nummurs, $datums, $vieta, $pienema, $vards, $uzvards, $telefons, $email, $veids, $parole, $garantija, $papildaprikojums, $saglabajama_info, $defekts);
pdf($pasutijuma_nummurs, $datums, $vieta, $pienema, $vards, $uzvards, $telefons, $email, $veids, $parole, $garantija, $papildaprikojums, $saglabajama_info, $defekts);

function adddb ($pasutijuma_nummurs, $datums, $vieta, $pienema, $vards, $uzvards, $telefons, $email, $veids, $parole, $garantija, $papildaprikojums, $saglabajama_info, $defekts)
{
     

    $query = " INSERT INTO serviss (pasutijuma_nummurs, datums, vieta, pienema, vards, uzvards, telefons, email, veids, parole, garantija, papildaprikojums, saglabajama_info, defekts)
                           VALUES ('$pasutijuma_nummurs', '$datums', '$vieta', '$pienema', '$vards', '$uzvards', '$telefons', '$email', '$veids', '$parole', '$garantija', '$papildaprikojums', '$saglabajama_info', '$defekts') " ;
    $result = pg_query($query);
   if (!$result) {
       $errormessage = pg_last_error();
       echo "Error with query: " . $errormessage;
        exit();

        
    }
    printf ("These values were inserted into the database - %s %s %s", $pasutijuma_nummurs);
    pg_close();

};

 

function pdf($pasutijuma_nummurs, $datums, $vieta, $pienema, $vards, $uzvards, $telefons, $email, $veids, $parole, $garantija, $papildaprikojums, $saglabajama_info, $defekts)
{
    ob_start();
    require('tfpdf.php');
$pdf=new tFPDF();
$pdf->Addpage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',10);


$pdf->Image('header.png',3, 3, 204);
$pdf->Image('footer.png', 7, 220, 200);
$pdf->Image('body.png', 7, 55, 200);

$pdf->SetY(83);
$pdf->Setx(8.2);
$pdf->Cell(30, 6, $_POST['pasutijuma_nummurs'], 1, 0);

$pdf->Setx(49.4);
$pdf->Cell(30, 6, $_POST['datums'], 1, 0);

$pdf->Setx(100.6);
$pdf->Cell(30, 6, $_POST['vieta'], 1, 0);

$pdf->Setx(150.6);
$pdf->Cell(50, 6, $_POST['pienema'], 1, 0);






$pdf->SetY(116);
$pdf->Setx(8.2);
$pdf->Cell(30, 6, $_POST['vards'], 1, 0);

$pdf->Setx(58.6);
$pdf->Cell(40, 6, $_POST['uzvards'], 1, 0);

$pdf->Setx(111.6);
$pdf->Cell(30, 6, $_POST['telefons'], 1, 0);

$pdf->Setx(156.3);
$pdf->Cell(48, 6, $_POST['email'], 1, 0);





$pdf->SetY(146);
$pdf->Setx(8.2);
$pdf->Cell(55, 6, $_POST['veids'], 1, 0);

$pdf->Setx(74.5);
$pdf->Cell(55, 6, $_POST['parole'], 1, 0);





$pdf->SetY(163);
$pdf->Setx(8.2);
$pdf->Cell(90, 14, $_POST['papildaprikojums'], 1, 0);


$pdf->Setx(114);
$pdf->Cell(90, 14, $_POST['informacija'], 1, 0);




$pdf->SetY(187);
$pdf->Setx(8.2);
$pdf->Cell(195, 14, $_POST['saglabajama_info'], 1, 0);


$pdf->SetY(208);
$pdf->Setx(8.2);
$pdf->Cell(195, 14, $_POST['defekts'], 1, 0);










$pdf->output();
ob_end_flush();
};



?>

   
</body>
</html> 