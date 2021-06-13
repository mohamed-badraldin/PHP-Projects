<?php
if ($_POST) {
    if (!$_POST['phone']) header("location:index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Survey</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/02da4c92dd.js" crossorigin="anonymous"></script>
</head>

<body  style="background: url('2.jpeg') no-repeat center fixed; background-size:cover;">
    <div class="container">
        <h1 class="display-3 my-5" style="color:#8a274c;"><i class="fas fa-hospital-symbol"></i>ospital survey</h1>
        <div class="row">
            <form action="result.php" method="post" class="col-12">
                <table style="color:#8a274c" class="table table-secondary table-hover rounded mb-0">
                    <thead>
                        <tr>
                            <th class="col-7">Questions ?</th>
                            <th>Bad</th>
                            <th>Good</th>
                            <th>Very good</th>
                            <th>Excellent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Are you satisfied with the level of cleanliness ?</td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="cleanliness" value="bad"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="cleanliness" value="good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="cleanliness" value="very good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="cleanliness" value="excellent"></td>
                        </tr>
                        <tr>
                            <td scope="row">Are you satisfied with the service prices ?</td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="price" value="bad"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="price" value="good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="price" value="very good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="price" value="excellent"></td>
                        </tr>
                        <tr>
                            <td scope="row">Are you satisfied with the nursing service ?</td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="nursing" value="bad"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="nursing" value="good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="nursing" value="very good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="nursing" value="excellent"></td>
                        </tr>
                        <tr>
                            <td scope="row">Are you satisfied with the level of the doctor ?</td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="doctor" value="bad"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="doctor" value="good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="doctor" value="very good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="doctor" value="excellent"></td>
                        </tr>
                        <tr>
                            <td scope="row">Are you satisfied with the calmness in the hospital ?</td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="calmness" value="bad"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="calmness" value="good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="calmness" value="very good"></td>
                            <td class="text-center"><input class="form-check-input" type="radio" name="calmness" value="excellent"></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="phone" value="<?php echo $_POST['phone'] ?>">
                <button style="background-color:#8a274c;border:none" type="submit" class="btn btn-primary form-control">Result <i class="fas fa-sign-in-alt"></i></button>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
