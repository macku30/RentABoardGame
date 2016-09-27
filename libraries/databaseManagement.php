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
    echo 'add game';
    $con = getDatabaseConnection();
    if ($con){
        echo 'add game2';
        $query = "INSERT INTO game (identifier, name, owner) VALUES (" . $identifier . ",". $name . "," . $owner .")";
        $result = mysqli_query($con, $query);
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}

function addWarehaus($name){
    $con = getDatabaseConnection();
    if ($con){
        $query = "INSERT INTO warehaus ( name) VALUES (". $name . ")";
        $result = mysqli_query($link, $query);
        closeDatabaseConnection($con);
        return $result;
    }
    return false;
}
 ?> 