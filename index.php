<?php

    //Connect to database and gain access to $conn variable
    include('config/db_connect.php');

    //Query for gathering clients
    $sql = 'SELECT id, name, phone, email FROM clients ORDER BY created_at';

    //Make query and store result
    $result = mysqli_query($conn, $sql);

    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $cli_array = array();
    foreach($clients as $cli){
        array_push($cli_array, $cli);
    }
    $rand_element = array_rand($cli_array) + 1;

    if($rand_element == 0) { $rand_element += 1; }

    //echo $rand_element;

    //Free memory and close connection
    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <div class="container">
        <a href="sorted.php"><div class="sorter">
            Sort (A-Z)
        </div></a>
    </div>

    <div class="container">
        <a href="details.php?id=<?php echo $rand_element;?>"><div class="sorter">
            Random
        </div></a>
    </div>

    <div class='container'>
        <div class='row' align='center'>

        <?php foreach($clients as $client): ?>
            <div>
                <div class='card'>
                <a href="details.php?id=<?php echo $client['id']?>">
                    <img src='img/CFMAdbookTelephone.svg' class='telephone-icon'>
                    <div class='card-content'>
                        <h2><?php echo htmlspecialchars($client['name']); ?></h2>
                        <div class='email-text'><?php echo htmlspecialchars($client['phone']) . '<br>' . 
                                                            htmlspecialchars($client['email']); ?></div>
                        <br>
                    </div>
                </a>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>

</html>