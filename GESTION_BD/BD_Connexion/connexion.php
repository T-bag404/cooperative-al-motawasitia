<?php 
function connexion(string $db = "users"){
    try{
        mysqli_connect("localhost","root","",$db);
    }catch(mysqli_sql_exception){
        $connect = mysqli_connect("localhost","root","");
        $query = "CREATE DATABASE {$db}";
        switch($db){
            case "product":
                mysqli_query($connect,$query);
                break;
            case "pannier":
                mysqli_query($connect,$query);
                break;
            case "users":
                mysqli_query($connect,$query);
                break;
            default : echo("NO such DB is created");
                $db = "";
                break;
        }
    }
    return mysqli_connect("localhost","root","",$db);
}
connexion("users")
?>