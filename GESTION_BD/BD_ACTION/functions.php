<?php
include '../BD_Connexion/connexion.php';
GLOBAL $connect;

function create(string $table){
    global $connect;
    switch($table){
        case "public":
            $query = "CREATE TABLE public( PID VARCHAR(50), name VARCHAR(50),audio VARCHAR(150), icon VARCHAR(150), image VARCHAR(150), video VARCHAR(150),
                                            quantiter int, Date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP, description Varchar(1500), price DECIMAL(10,2),
                                            CONSTRAINT PK_public PRIMARY KEY (PID));";
            break;
        case "achat":
            $query = "CREATE TABLE achat( CID VARCHAR(50), quantiter INT,PID VARCHAR(50)
                                            CONSTRAINT PK_public PRIMARY KEY (CID));";
            break;
        case "admine":
            $query = "CREATE TABLE admine( AID VARCHAR(50), address varchar(100),password VARCHAR(256)
                                            CONSTRAINT PK_public PRIMARY KEY (AID));";
            break;
        case "user":
            $query = "CREATE TABLE user( UID VARCHAR(50), address varchar(100),password VARCHAR(256)
                                            CONSTRAINT PK_public PRIMARY KEY (UID));";
            break;
        default : 
            echo "invalide table name";
            $query = "";
            break;
    }
    mysqli_query($connect,$query);
}

function insert(string $table, $data) {
    global $connect;
    switch($table) {
        case "public":
            $columns = "PID, name, audio, icon, image, video, quantiter, Date_ajout, description, price";
            $values = "'{$data['id']}', '{$data['name']}', '{$data['audio']}', '{$data['icon']}', '{$data['image']}', '{$data['video']}', " . intval($data['quantiter']) . ", NOW(), '{$data['description']}', " . floatval($data['price']);
            break;
        case "achat":
            $columns = "CID, quantiter, PID";
            $values = "'{$data['id']}', " . intval($data['quantiter']) . ", '{$data['PID']}'";
            break;
        case "admine":
            $columns = "AID, address, password";
            $values = "'{$data['id']}', '{$data['address']}', '{$data['password']}'";
            break;
        case "user":
            $columns = "UID, address, password";
            $values = "'{$data['id']}', '{$data['address']}', '{$data['password']}'";
            break;
        default:
            echo "Invalid table name";
            return;
    }
    $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values});";
    mysqli_query($connect, $query);
}

function modify(string $table, $data) {
    global $connect;
    
    switch($table) {
        case "public":
            $setClause = "name = '{$data['name']}', audio = '{$data['audio']}', icon = '{$data['icon']}', image = '{$data['image']}', video = '{$data['video']}', quantiter = " . intval($data['quantiter']) . ", description = '{$data['description']}', price = " . floatval($data['price']);
            $idColumn = "PID";
            break;
        case "achat":
            $setClause = "quantiter = " . intval($data['quantiter']) . ", PID = '{$data['PID']}'";
            $idColumn = "CID";
            break;
        case "admine":
            $setClause = "address = '{$data['address']}', password = '{$data['password']}'";
            $idColumn = "AID";
            break;
        case "user":
            $setClause = "address = '{$data['address']}', password = '{$data['password']}'";
            $idColumn = "UID";
            break;
        default:
            echo "Invalid table name";
            return;
    }

    $query = "UPDATE {$table} SET {$setClause} WHERE {$idColumn} = '{$data['id']}';";
    mysqli_query($connect, $query);
}


function remove(string $table, $data) {
    global $connect;
    
    switch($table) {
        case "public":
            $idColumn = "PID";
            break;
        case "achat":
            $idColumn = "CID";
            break;
        case "admine":
            $idColumn = "AID";
            break;
        case "user":
            $idColumn = "UID";
            break;
        default:
            echo "Invalid table name";
            return;
    }

    $query = "DELETE FROM {$table} WHERE {$idColumn} = '{$data['id']}';";
    mysqli_query($connect, $query);
}

function select_row(string $table, $data) {
    global $connect;
    
    switch($table) {
        case "public":
            $idColumn = "PID";
            break;
        case "achat":
            $idColumn = "CID";
            break;
        case "admine":
            $idColumn = "AID";
            break;
        case "user":
            $idColumn = "UID";
            break;
        default:
            echo "Invalid table name";
            return null;
    }

    $query = "SELECT * FROM {$table} WHERE {$idColumn} = '{$data['id']}';";
    return mysqli_fetch_row(mysqli_query($connect, $query));
}

function select_all(string $table, $data) {
    global $connect;
    
    switch($table) {
        case "public":
            $idColumn = "PID";
            break;
        case "achat":
            $idColumn = "CID";
            break;
        case "admine":
            $idColumn = "AID";
            break;
        case "user":
            $idColumn = "UID";
            break;
        default:
            echo "Invalid table name";
            return null;
    }

    $query = "SELECT * FROM {$table} ;";
    return mysqli_fetch_all(mysqli_query($connect, $query));
}

function sql(string $db = "product", string $table = "public",string $type = "create", $data = ["id"=>"p-0"]){
    GLOBAL $connect ;
    $connect = connexion($db);
    switch($type){
        case "create":
            create($table);
            break;
        case "insert":
            insert($table, $data);
            break;
        case "modify":
            remove($table, $data);
            break;
        case "remove":
            remove($table, $data);
            break;
        case "select_row":
            return select_row($table, $data);
        case "select_all":
            return select_all($table, $data);
        default:
        echo"no such type exist";
    }

}
?>