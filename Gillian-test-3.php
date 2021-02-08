<?php
    $dsn = 'mysql:host=162.241.219.131;dbname=tinyfee4_sources';
    $username = 'tinyfee4_Admin';
    $password = 'R$xiUJI}-Z6J';
    $var = $_POST[region_ID];
    echo $var;

    try {
        $db = new PDO($dsn, $username, $password);
        $select = "SELECT zip, cement_and_manufacturing, waste, electricity_commercial, electricity_industrial, electricity_residential
                    FROM v_sectorAllTotalGHG_zip
                    WHERE zip=$var";
    $statement = $db->prepare($select);
    $statement->execute();
    $results = $statement->fetchAll();
    echo "<ul>";
    foreach($results as $row){
        echo "<li>" . "Zip = " . $row['zip'] . "    " . " cement_and_manufacturing = " . $row['cement_and_manufacturing'] . " waste = " . $row['waste'] . " electricity_commercial = " . $row['electricity_commercial'] . " electricity_industrial = " . $row['electricity_industrial'] . " electricity_residential = " . $row['electricity_residential'] . "</li>";       
    }
    echo "</ul>";
    $statement->closeCursor();
} catch(PDOException $e) {
    $msg = $e->getMessage();
    echo "<p>ERROR: $msg</p>";
}
?>