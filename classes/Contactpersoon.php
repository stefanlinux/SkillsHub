class Contactpersoon {
    public function contactpersoon_insert {
            $volledigenaam = $_POST["voornaam"] . " " . $_POST["tussenvoegsel"] . " " . $_POST["achternaam"];
    $volledigenaam = str_replace("  ", " ", $volledigenaam);
   
$sql2 = "INSERT INTO contactpersonen (
id,
 voornaam,
 tussenvoegsel,
 achternaam,
 volledigenaam,
 tel,
 mail

)
VALUES (
NULL,
 '$_POST[voornaam]',
 '$_POST[tussenvoegsel]',
 '$_POST[achternaam]',
 '$volledigenaam',
 '$_POST[tel]',

 '$_POST[mail]')";

DB::getInstance()->query($sql2);
    }
}