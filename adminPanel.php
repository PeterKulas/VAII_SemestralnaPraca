<?php
    require "classes/user.classes.php";
    $userStorage = new UserStorage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/adminPanel.css">

</head>

<body>
    <?php 
    if (isset($_GET['delete'])) {
        $deletedID = $_GET['id'];
        $userStorage->deleteUser($deletedID); 
    }                      
    ?>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidebar">
                <div class="theme-box">
                    <button class="theme-btn thm-1 active">1</button>
                    <button class="theme-btn thm-2">2</button>
                    <button class="theme-btn thm-3">3</button>
                </div>
                <h4>Admin panel</h4>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li class="list-item"><a href="index.php">Domov</a></li>
                    <li class="list-item"><a href=" #">Používatelia</a></li>
                    <li class="list-item"><a href=" #">Databáza kníh</a></li>
                </ul><br>
            </div>

            <div class="col-sm-10 maincontent">
                <h2>Používatelia</h2>

                <?php 
    if (isset($_GET['edit'])) { 
        $id = $_GET['id'];
        $firstName = $_GET['firstname'];
        $lastName = $_GET['lastname'];
        $email = $_GET['email'];
        ?> <form action="adminPanel.php">
                    <label for="country">ID:</label>
                    <input type="text" id="ID" name="ID" value="<?php echo $id ?>" readonly><br>
                    <label for="Firstname">Meno:</label>
                    <input id="inputEditFirstName" type="text" id="Firstname" name="Firstname"
                        value="<?php echo $firstName ?>">
                    <label for="Lastname">Priezvisko:</label>
                    <input id="inputEditLastName" type="text" id="Lastname" name="Lastname"
                        value="<?php echo $lastName ?>">
                    <label for=" Email">Email:</label>
                    <input id="inputEditEmail" type="email" id="Email" name="Email" value="<?php echo $email ?>">
                    <button class=" btn btn-primary" type="submit"> Editovat</button>
                </form>
                <p id="EditValidation"></p>
                <?php   
             
            } ?>

                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><i class="bi bi-pencil-fill"></i></th>
                            <th scope="col">#</th>
                            <th scope="col">Meno</th>
                            <th scope="col">Priezvisko</th>
                            <th scope="col">Email</th>
                            <th scope="col">Heslo</th>
                            <th scope="col">Dátum registrácie</th>
                            <th scope="col">O</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userStorage->getAllUsers() as $user) { ?>
                        <tr>
                            <td><input type="radio"></td>
                            <th scope="row"><?php echo $user["id"] ?></th>
                            <td><?php echo  $user['firstname'] ?></td>
                            <td><?php echo  $user['lastname']  ?></td>
                            <td><?php echo  $user['email']  ?></td>
                            <td>
                                <?php $tempPass = substr($user['password'],0,15)." ..."; 
                                echo  $tempPass  ?>
                            </td>
                            <td><?php echo  $user['registrationDate']  ?></td>
                            <td><a class="edit"
                                    href="adminPanel.php?edit=<?php echo "edit" ?>&id=<?php echo $user["id"]; ?>&firstname=<?php echo $user["firstname"]; ?>&lastname=<?php echo $user["lastname"]; ?>&email=<?php echo $user["email"]; ?>">Edit</a>
                                <a class="delete"
                                    href="adminPanel.php?delete=<?php echo "delete" ?>&id=<?php echo $user["id"]; ?>">Delete</a>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/registrationPage.js"></script>
    <script src="js/adminPanel.js"></script>
</body>

</html>