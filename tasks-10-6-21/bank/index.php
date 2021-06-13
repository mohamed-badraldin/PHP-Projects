<?php 
if(isset($_POST['loan']) && isset($_POST['years'])){
    if($_POST['years'] < 3){
        $interest_rate = $_POST['loan'] * 0.1 * $_POST['years']; 
    }
    else{
        $interest_rate = $_POST['loan'] * 0.15 * $_POST['years'];
    }
    
    $loan_after_interest = $_POST['loan'] + $interest_rate;
    
    $monthly = number_format($loan_after_interest / ($_POST['years'] * 12),2);
}

?>



<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>table th {color:#f53fae} table td {color:#fff} input {color:#fff}</style>
    <script src="https://kit.fontawesome.com/02da4c92dd.js" crossorigin="anonymous"></script>
</head>
  <body style="background: url('1.png') no-repeat 90% 40% fixed; background-size:cover;">
      <div class="container">
          <div class="row">
            <h1 class="display-3 col-4 offset-7 mb-4 mt-3" style="color:#fff;font-weight:bold"><i style="color:#f53fae"class="fab fa-btc"></i>ank</h1>
          </div>
          <div class="row">
        <form class="col-7 offset-5 mb-5" method="POST" action="">
        <div class="form-group mb-4">
          <label for="userName" class="font-weight-bold" style="color:#f53fae;">User name</label>
          <input name="username" type="text" class="form-control" style="background:transparent;border-color:#f53fae;color:#fff" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>">
        </div>
        <div class="form-group mb-4">
          <label for="loan" class="font-weight-bold" style="color:#f53fae;">Loan amount</label>
          <input name="loan" type="number" class="form-control" style="background:transparent;border-color:#f53fae;color:#fff" value="<?php if (isset($_POST['loan'])) echo $_POST['loan'] ?>">
        </div>
        <div class="form-group mb-4">
          <label for="years" class="font-weight-bold" style="color:#f53fae;">Loan years</label>
          <input name="years" type="number" class="form-control" style="background:transparent;border-color:#f53fae;color:#fff" value="<?php if (isset($_POST['years'])) echo $_POST['years'] ?>">
        </div>
        <button type="submit" class="btn btn-primary form-control mt-3" style="font-weight:bold;background-color:#f53fae;border:0;">Calculate  <i class="fas fa-sign-in-alt"></i></button>
        
        <?php 
                 if(isset($_POST['loan']) && isset($_POST['years'])){
                     echo '<table class="table mt-5">
                     <thead>
                     <tr>
                     <th scope="col">Interest rate</th>
                        <th scope="col">Loan after interest</th>
                        <th scope="col">monthly</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>'.$interest_rate .'</td>
                        <td>'. $loan_after_interest. '</td>
                        <td>'. $monthly.'</td>
                        </tr>
                        </tbody>
                        </table>';
                    }
                    ?>
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