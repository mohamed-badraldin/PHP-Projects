<?php
session_start();
if (isset($_SESSION['uncompleted'])){
    $alret = '<div class="alert alert-danger col-12 font-weight-bold" role="alert">
                Please make sure you answer the five questions. </div>';
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Hospital</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/02da4c92dd.js" crossorigin="anonymous"></script>
  </head>
  <body style="background: url('1.jpeg') no-repeat center fixed; background-size:cover;">
      <div class="container" style="margin-top:20vh;">
            <h1 class="display-3" style="color:#8a274c;"><i class="fas fa-hospital-symbol"></i>ospital</h1>
            <div class="row col-6">
            <form action="survey.php" method="post">
              <div class="row mt-4">
                  <div class="input-group mb-1">
                  <span class="input-group-text">Phone number</span>
                  <input name="phone" type="text" class="form-control">
                  </div>
                  <div style="color:gray;text-indent:10px; font-size:.8rem">We do not sell your personal information to anyone</div>
              <button style="background-color:#8a274c;border:none"type="submit" class="btn btn-primary form-control my-4">Survey <i class="fas fa-sign-in-alt"></i></button>
            <?php 
              if(isset($alret)) echo $alret;
            ?>
              </div>
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
<?php session_destroy() ?>