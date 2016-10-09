 <?php 

function getDatabaseConnection(){
    include 'libraries\pass.php';

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    return $con;
}

function closeDatabaseConnection($con){
    $con->close();
}

function addGame($name, $owner, $identifier){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.game (identifier, name, owner) VALUES ('" . $identifier . "','". $name . "','" . $owner ."')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addLender($identifier, $name){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.lender (identifier, name) VALUES ('" . $identifier . "','". $name . "')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addEvent($name, $startDate, $endDate){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.event (name, startDate, endDate) VALUES ('" . $name . "','". $startDate . "','". $endDate . "')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addHire($game_id, $lender_id, $event_id, $weight, $hire_start){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.hire (Game_idGame, Lender_identifier, Event_idEvent, weight, hirestart) VALUES ('" 
                 . $game_id . "','". $lender_id . "','". $event_id . "','". $weight . "','". $hire_start . "')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}
function addUser($login, $password_2, $canLend, $canAddGames, $canAddEvents, $canManageGames, $canManageLenders, $canManageUsers){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.user (login, password_2, canLend, canAddGames, canAddEvents, canManageGames, canManageLenders, canManageUsers) VALUES ('" 
                 . $login . "','". md5($password_2) . "','". $canLend . "','". $canAddGames . "','". $canAddEvents . "','". $canManageGames . "','". $canManageLenders . "','". $canManageUsers . "')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addWarehaus($name){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.warehaus ( name) VALUES ('". $name . "')";
        $result = mysqli_query($con, $query);
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addGameAvailableForEvent($game_id, $event_id){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO rentABook.GamesAvailableForEvent (Game_idGame, Event_idEvent) VALUES ('" 
                 . $game_id . "','". $event_id . "')";
        $result = mysqli_query($con, $query);
        if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}



function hireUpdateEndDate($idHire){
    $con = getDatabaseConnection();
    if ($con){


$query = "Update rentABook.Hire set hireEnd = now() Where idHire = ($idHire)";
        $result = mysqli_query($con, $query);
if($result == NULL){
            printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
        }
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}



function getUserAccess($login, $password_2){
	$accessList = array();
    $con = getDatabaseConnection();
    if( $con){
        $query = "SELECT login, canLend, canAddGames, canAddEvents, canManageGames, canManageLenders, canManageUsers FROM rentABook.user 
where login = '". $login ."' And password_2 = '". md5($password_2) ."' LIMIT 0,1000";

        $result = mysqli_query($con, $query);
        
      if($result){
            if (mysqli_num_rows($result) == 1){

		 $row = $result->fetch_object();
                $accessList['login'] = $row->login;
                $accessList['canLend'] = $row->canLend;
                $accessList['canAddGames'] = $row->canAddGames;
                $accessList['canAddEvents'] = $row->canAddEvents;
                $accessList['canManageGames'] = $row->canManageGames;
                $accessList['canManageLenders'] = $row->canManageLenders;
                $accessList['canManageUsers'] = $row->canManageUsers;
               
   /*         $result->close();

		echo $row->login . "</br>";
		echo $row->canLend . "</br>";
		echo $row->canAddGames . "</br>";
		echo $row->canAddEvents . "</br>";
		echo $row->canManageGames . "<br>";
		echo $row->canManageLenders . "</br>";
		echo $row->canManageUsers . "</br>"; 
*/
       		}   
            	
 
		}
//else {
//printf("Invalid query: %s\nWhole query: %s\n", $con->error, $query);
//}

        	closeDatabaseConnection($con);

    	}
	return $accessList;
	
}


function getGames(){
    $con = getDatabaseConnection();
    if( $con){
        $query = "SELECT * FROM rentABook.game LIMIT 0,1000";
        $result = mysqli_query($con, $query);
        
        if($result){
            while ($row = $result->fetch_object()){
                echo $row->name . "</br>";
            }
            $result->close();
        }
        closeDatabaseConnection($con);
    }
}
 ?> 