<?php
class Project {
    public $data;
    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn,
        $_projectleider,
        $n;
    
    public function __construct($n) {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');


        $sql = "SELECT * FROM projects WHERE id='$n'";
        $data = $this->_db->query($sql);
        foreach ($data->results() as $key) {
            $this->_projectleider = $key->projectleider;
        }
        
    }


    public function create($fields = array()) {
        if(!$this->_db->insert('projects', $fields)) {
            throw new Exception('Er was een probleem met het creeren van een project.');
        }
    }

    
    public static function get_project($n, $userid) {
        $sql = "SELECT * FROM `projects` WHERE id='$n'";
        $data = DB::getInstance()->query($sql);

     
        return $data;

        //$var="User', email='test";
        //$a=new PDO("mysql:host=localhost;dbname=database;","root","");
        // $sql = "SELECT * FROM projects WHERE id=:n";


        //  $stmt = $this->_db->prepare("SELECT * FROM projects WHERE id=?");
        // $stmt->execute(array($n));
        // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return var_dump($rows);

        // $this->_db->get('projects', array('id', '=', $n));
        // return $this;
    }


    public function get_project_info($n) {
        $this->lines = "";
        $sql = "SELECT * FROM `projects` WHERE `id`='$n'" ;
        $data  = DB::getInstance()->query($sql);
        foreach ($data->results() as $rij) {
            $this->projectname = $rij->naam;
            $this->opdrachtgever = $rij->opdrachtgever;
            $this->status = $rij->status;
             if ($rij->status == 0) {
            $this->status = "lopend";
             } else if ($rij->status == 1) {
                 $this->status = "afgerond";
             } else {
                 $this->status = "aankomend";	
             }
        }
        $this->lines = "<div class=\"projectnaam\">" . $this->projectname . "</div>";
        $this->lines .= "<div class=\"projectopdrachtgever\"><a href=\"opdrachtgever/" . $this->opdrachtgever . "\">" . $this->opdrachtgever . "</a></div>";
        $this->lines .= "<div class=\"projectstatus\">Status: " . $this->status . "</div>";
        return $this->lines; 
    }

    public function get_project_user_status($userid, $projectname, $status) {
        $this->lines = "";
        $sql = "SELECT * FROM projectsusers WHERE usersid='$userid' AND project ='$projectname'";
        $data = DB::getInstance()->query($sql);
        
        $this->lines .= '<div class="connectstatus">';//var_dump($data);
        if(!$data->count() )	{

            $this->lines .=  "<a class=\"button projectbtn\" href=\"addproject.php?n=" . $n .   "&u=" . $userid . "&a=1" . "&projectname=" .$projectname. " \"> Aanmelden voor project</a> <br/><br/>";
        } else {
            foreach ($data->results() as $rij) {
                if($rij->accept == "1") {
                    $this->lines .= "<a class=\"button projectbtn\" href=\"removeuserfromproject.php?id=" . $rij->id . "&pid=" .$projectname."  \">aanvraag intrekken</a>";
                    $this->lines .= "<label class=\"project\">aangevraagd</label>";
                }
                else if($rij->accept == "2") {
                    $this->lines .= "<a class=\"button projectbtn\" href=\"removeuserfromproject.php?id=" . $rij->id ."  \">weigeren</a>";
                    $this->lines .= "<a class=\"button projectbtn\" href=\"acceptuserinproject.php?id=" . $rij->id ."  \">accepteren</a> ";
                    $this->lines .= "<label class=\"project\">Je bent uitgenodigd</label>";
                }
                else {
                    if($projectleider == "no") {
                        $this->lines .= "<label class=\"project\">Je zit in het project</label>";
                    }
                }
            }
        }
        $this->lines .= '</div>';
        return $this->lines;
    }



    public function getProjectLeider($p) {
        $sql = "SELECT username FROM users WHERE id='$p'";
        $data = DB::getInstance()->query($sql);
        foreach($data->results() as $rij) {
            return $rij2->username;
        }
    }
    

    
    public function show_form() {
        $sql = "SELECT * FROM `opdrachtgevers`";
        $data = $_db->getInstance()->query($sql);
        echo  '<form id="frm" name="frm" method="post" action="">
       <div class="title2"><h4>Algemene informatie</h4></div>
        <div class="blocks">
        <div class="label">Projectnaam:</div> <input type="text" id="projectnaam" class="textbox" name="projectnaam" value=""><br>
        <div class="label">Opdrachtgever:</div> <select class="textbox" name="opdrachtgever" style="width: 226px">
    ';
        foreach ($data->results() as $rij) {
            echo '<option value=' . $rij->id . '>';
            echo $rij->opdrachtgever;
            if (!empty($rij->voornaam)) echo ' - ' . $rij->voornaam;
            if (!empty($rij->tussenvoegsel)) echo " " . $rij->tussenvoegsel;
            if (!empty($rij->achternaam)) echo " " . $rij->achternaam;
            echo  '</option>';
        }
        echo  ' </select><br /><br />';
    }
    
    public function project_add() {
        
    }

    public function get_all_projects () {
        $sql = "SELECT projects.id as id, projects.naam as naam,
projects.omschrijving as omschrijving,
markt.opdrachtgever as opdrachtgever,
users.name as leidernaam,
users.tussenvoegsel as leidertussenvoegsel,
users.achternaam as leiderachternaam
FROM `projects`,`users`,`markt`
WHERE projects.status='$s'
AND `projects`.`projectleider` = `users`.`id`
AND projects.bedrijf = `markt`.`id`
ORDER BY projects.naam ";
        //$sql = "SELECT * FROM projects WHERE projects.status='$s'";
        $data = DB::getInstance()->query($sql);
        return $data;
    }

    public  function delete_project_skill($n) {

        $sql = "DELETE FROM projectskills WHERE id= '$n'";
        DB::getInstance()->query($sql);

    }

    public function get_projects($p) {
$sql = "SELECT *
FROM projects
WHERE projects . id = '$p'";

$data = DB::getInstance()->query($sql);
        global $id;
        global $naam;
        global $omschrijving;
        global $evaluatie;
        global $skills;
        global $startdatum;
        global $einddatum;
        global $projectleider;
        global $status;
        global $opdrachtgever;
        global $bedrijf;
        global $prijs;
        global $kosten;
        global $storting;
        foreach($data->results() as $rij) {
            $id = $rij->id;
            $naam = $rij->naam;
            $omschrijving = $rij->omschrijving;
            $evaluatie = $rij->evaluatie;
            $skills = $rij->skills;
            $startdatum = $rij->startdatum;
            $einddatum = $rij->einddatum;
            $projectleider = $rij->projectleider;
            //if(!empty($rij->leidertussenv)) $projectleider .= " ".$rij->leidertussenv;
            //if(!empty($rij->leiderachtern)) $projectleider .= " ".$rij->leiderachtern;
            $status = $rij->status;
            $opdrachtgever = $rij->opdrachtgever;
            $bedrijf = $rij->bedrijf;
            $prijs = $rij->prijs;
            $kosten = $rij->kosten;
            $storting = $rij->storting;
    
        }

    }

    public function update_project($p) {
        global $omschrijving;
        global $evaluatie;
        global $naam;
        global $startdatum;
        global $einddatum;
        global $opdrachtgever;
        global $kosten;
        global $prijs;
        global $storting;
        global $level;
        global $projectleider;
        $status = serialize($_POST['status']);
        if (isset($_POST['omschrijving'])) {$omschrijving = str_replace("'","&#39;",$_POST['omschrijving']);}
        if (isset($_POST['evaluatie'])) {$evaluatie  = $_POST['evaluatie'];}
        if (isset($_POST['naam'])) {$naam = $_POST['naam'];}
        if (isset($_POST['startdatum'])) {$startdatum = $_POST['startdatum'];}
        if (isset($_POST['einddatum'])) {$einddatum = $_POST['einddatum'];}
        if (isset($_POST['opdrachtgever'])) {$opdrachtgever = $_POST['opdrachtgever'];}
        if (isset($_POST['kosten'])) {$kosten = $_POST['kosten'];}
        if (isset($_POST['prijs'])) {$prijs = $_POST['prijs'];}
        if (isset($_POST['level'])) {$level = $_POST['level'];}
        if (isset($_POST['status'])) {$status = $_POST['status'];}
        if (isset($_POST['storting'])) {$storting = $_POST['storting'];}
        if (isset($_POST['projectleider'])) {$projectleider = $_POST['projectleider'];}
    
        $sql = "UPDATE projects SET 
 evaluatie='$evaluatie',
 naam='$naam',
 omschrijving='$omschrijving',
 startdatum='$startdatum',
 einddatum='$einddatum',
 opdrachtgever='$opdrachtgever',
 projectleider='$projectleider',
 prijs='$prijs',
 kosten='$kosten',
 storting='$storting',
 status='$status' 
  WHERE id ='$p'";
        DB::getInstance()->query($sql);

        $sql = "UPDATE projectsusers SET project='$_POST[naam]'  WHERE projectid='$p' ";
        DB::getInstance()->query($sql);
    }



    
    public function update_project_skill($p) {
        $skill = $_POST['addskill'];
        $level = $_POST['level'];

        $sql = "SELECT id FROM `skills` WHERE `skill` = '$skill'";
        $selectedskills = DB::getInstance()->query($sql);
        foreach($selectedskills->results() as $key) {
            $selectedskill =  $key->id;
            $sql = "INSERT INTO `projectskills` (`id` , `projectid`, `skillid`, `lvl`) VALUES (NULL, '$p', '$selectedskill', '$level')";
            DB::getInstance()->query($sql);
        }
    }


 
    public function get_form_users() {
    
        //        $sql = "SELECT * FROM `users` WHERE group != 2 AND user != 'Admin'";
        $sql = "SELECT * FROM users";
        $data = DB::getInstance()->query($sql);
        foreach ($data->results() as $rij) {
            $line .= '<option  ';
            if ($this->_projectleider == $rij->id ) {
                $line .= 'selected';
            }
            $line .= ' value='.$rij->id . '>' . $rij->name;
            if(!empty($rij->tussenvoegsel)) $line .= " " . $rij->tussenvoegsel;
            if(!empty($rij->achternaam)) $line .= " " . $rij->achternaam;
    
        }
        return $line;

    }

}
