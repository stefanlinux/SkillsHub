<?php
require_once 'core/init.php';
$letter = "2";
$letter2 = "#";

$sql = "SELECT * FROM users ORDER BY name ";
$data = DB::getInstance()->query($sql);

if ($data != "")	{
    foreach ($data->results() as $rij) {
        if ($rij->volledigenaam != "Administrator") {
            $string2 = $rij->volledigenaam;
            $string = utf8_encode($string2);
            $volledigenaam = $rij->volledigenaam;
            //$volledigenaam2 = utf8_decode($rij->volledigenaam);
            $letter = strtolower($string);

            if ($letter != $letter2)
            {
                echo '<br /><div id="' . $letter . '" class="title2 title3"><h4>' . $letter . '</h4></div><br />';
                $letter2 = $letter;
            }
            echo '<div title="' . $rij->motivatie . '"class="searchresult2">' . '<a  href="profiel/' .  $rij->id . '">';
            echo '<p class="lid">' .$string. '</p>';

            echo  "<div class=\"projectleider\"><h2>" . $rij->functie . "</h2></div>";
            echo  "<div class=\"omschrijving\">" . $rij->motivatie . "</div>";

            if (file_exists("img/profilepic/" . $rij->id . ".jpg")) {
                echo "<img class=\"radius2";
                echo "\"src=\"img/profilepic/" . $rij->id . ".jpg\">";
            }
            else {
                echo "<img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\">";
            }
            echo "</a></div>";
            ?>
<?php
            $string = $rij->name;
            $letter = $string[0];
        }
    }
}	

?>