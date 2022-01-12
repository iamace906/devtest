<?php


///////////////////// VULENERABLE TO SQL INJECTION //////////////////////////////////
// $servername = "localhost";
// $username = "root";
// $password = "1234";
// $dbname = "devtest";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// $xid = $_POST['x'];
// $query = "SELECT * FROM news WHERE id = ".$xid;
//     $res = mysqli_query($conn,$query);
//         if($res && mysqli_num_rows($res)>0){
//         echo "<table border='1'>";
//         echo "<tr><td> ID </td><td>SHORT DESCRIPTION</td><td>ARTICLE</td></tr>";
//             while($row = mysqli_fetch_assoc($res)){
//                 echo "<tr>";
//                 echo "<td>".$row['id']."</td>";
//                 echo "<td>".$row['short_description']."</td>";
//                 echo "<td>".$row['article']."</td>";
//                 echo "</tr>";
//             }
//         echo "</table>";
// }
//////////////////////////////////////////////////////////////////////////////////

$db_host = 'localhost';
$db_uname = 'root';
$db_pw = '1234';
$db_dbname = 'devtest';
$db_cnstr = "mysql:host=$db_host; dbname=$db_dbname";
$db_opt = array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>true);

try {
    $link_id = new PDO($db_cnstr, $db_uname, $db_pw, $db_opt);
} catch(Exception $e){
	echo "Connection Error ";
}

$xid = $_POST['x'];
$query = "SELECT * FROM news WHERE id = ?";
$xstmt = $link_id->prepare($query);
$xstmt->bindParam(1,$id);
$id = $xid;
$xstmt->execute();
$xres = $xstmt->fetchAll();

if($xres){
    echo "<table border='1'>";
    echo "<tr><td> ID </td><td>SHORT DESCRIPTION</td><td>ARTICLE</td></tr>";
    foreach ($xres as $key => $data) {
        echo "<tr>";
        echo "<td>".$data['id']."</td>";
        echo "<td>".$data['short_description']."</td>";
        echo "<td>".$data['article']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    header("HTTP/1.0 404 Not Found");
    die();
}
?>