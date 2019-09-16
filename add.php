<?php 

include('config/db_connect.php');

$name = $phone = $email = '';
$errors= array('name'=>'', 'phone'=>'', 'email'=>'',);

if(isset($_POST['submit'])){
    // Validation for name
    if(empty($_POST['name-field']))
    {
        $errors['name'] = 'ERROR: A name is required. Please enter a name before clicking \'Finished Adding Client\' <br> ';
    } else {
        $name = htmlspecialchars($_POST['name-field']);
    }

    // Validation for phone
    if(empty($_POST['phone-number-field']))
    {
        $phone = 'none';
    } else {
        $phone = htmlspecialchars($_POST['phone-number-field']);
    }

    // Validation for email
    if(empty($_POST['email-field']))
    {
        $errors['email'] = 'ERROR: An email is required. Please enter an email before clicking \'Finished Adding Client\' <br> ';
    } else {
        $email = $_POST['email-field'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'ERROR: A valid email is required. Please enter a valid email before clicking \'Finished Adding Client\'';
        }
    }

    if(array_filter($errors)){
        //echo 'there are errors in the form';
    } else {

        $name = mysqli_real_escape_string($conn, $_POST['name-field']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone-number-field']);
        $email = mysqli_real_escape_string($conn, $_POST['email-field']);

        //Create SQL
        $sql = "INSERT INTO clients(name, phone, email) VALUES('$name', '$phone', '$email')";

        //Save to database and check 
        if(mysqli_query($conn, $sql)){
            //successful save - redirect to index.php
            header('Location: index.php');

        } else {
            echo 'QUERY ERROR: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <section class="form-container">
        <h2 align="center" class="###">Enter client info below before clicking 'Finished Adding Client'.</h4>
        <form class="form-container" action="add.php" method="POST">
            <label>Client Name<span class="required">*</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </label>
            <input type="text" name="name-field" value="<?php echo htmlspecialchars($name) ; ?>">
            <div class="errors"><?php echo $errors['name']; ?></div>
            <br><br>
            <label>Client Phone Number&nbsp&nbsp: </label>
            <input type="text" name="phone-number-field" value="<?php echo htmlspecialchars($phone) ; ?>">
            <div class="errors"><?php echo $errors['phone']; ?></div>
            <br><br>
            <label>Client Email<span class="required">*</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </label>
            <input type="text" name="email-field" value="<?php echo htmlspecialchars($email) ; ?>">
            <div class="errors"><?php echo $errors['email']; ?></div>
            <br><br>
            <div>
                <input class="add-button" type="submit" name="submit" value="Finished Adding Client">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

    
</html>