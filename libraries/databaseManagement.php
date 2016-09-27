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
        $query = "INSERT INTO rentABook.event (name) VALUES ('" . $identifier . "','". $name . "')";
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