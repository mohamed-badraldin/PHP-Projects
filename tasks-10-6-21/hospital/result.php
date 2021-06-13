<?php
if(!$_POST) header('location:index.php');
$sumSurvey = 0;
$surveyMessage;
if ($_POST) {
    if (count($_POST) < 6) {
        session_start();
        $_SESSION['uncompleted'] = 1;
        header('location:index.php');
    } else {
        foreach ($_POST as $value) {
            if ($value === "bad") $sumSurvey += 0;
            if ($value === "good") $sumSurvey += 3;
            if ($value === "very good") $sumSurvey += 5;
            if ($value === "excellent") $sumSurvey += 10;
        }
    }
}
if ($sumSurvey >= 25) {
    $surveyMessage = '<div class="alert col-12 font-weight-bold text-center m-0" style="background-color:#8a274c;color:white" role="alert">
                        <div class="pl-4 float-left"> Total review</div> <div class="float-right pr-4" >GOOD</div></div>' .
                            '<div class="alert alert-success col-12 font-weight-bold text-center" role="alert">THANK YOU</div>';
} else {
    $surveyMessage = '<div class="alert col-12 font-weight-bold text-center m-0" style="background-color:#8a274c;color:white" role="alert">
                        <div class="pl-4 float-left"> Total review</div> <div class="float-right pr-4" >BAD</div></div>' . 
                        '<div class="alert alert-danger col-12 font-weight-bold text-center" role="alert"> 
                             please contact the patient to find out the reason for the bad evaluation  +' . $_POST['phone'] . ' </div>';
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Review</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/02da4c92dd.js" crossorigin="anonymous"></script>
</head>

<body  style="background: url('2.jpeg') no-repeat center fixed; background-size:cover;">

    <div class="container">
        <div class="row col-10 offset-1">
            <h1 class="display-3 my-5" style="color:#8a274c;"><i class="fas fa-hospital-symbol "></i>ospital review</h1>
            <table style="color:#8a274c" class="table table-secondary table-hover rounded mb-0">
                <thead>
                    <tr>
                        <th class="col-10">Questions ?</th>
                        <th class="text-center">Review</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Are you satisfied with the level of cleanliness ?</td>
                        <td class="text-center"><?php echo ucfirst($_POST['cleanliness']) ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Are you satisfied with the service prices ?</td>
                        <td class="text-center"><?php echo ucfirst($_POST['price']) ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Are you satisfied with the nursing service ?</td>
                        <td class="text-center"><?php echo ucfirst($_POST['nursing']) ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Are you satisfied with the level of the doctor ?</td>
                        <td class="text-center"><?php echo ucfirst($_POST['doctor']) ?></td>
                    </tr>
                    <tr>
                        <td scope="row">Are you satisfied with the calmness in the hospital ?</td>
                        <td class="text-center"><?php echo ucfirst($_POST['calmness']) ?></td>
                    </tr>
                </tbody>
            </table>
            <?php echo $surveyMessage; ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>