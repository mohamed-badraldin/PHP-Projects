<?php
    function calculateBill(){
        $units = (int)$_GET['units'];
        if($units < 0) return "Input Positive Value";
        if($units >=0 && $units <= 50)  return "The total price is " . $units * 0.50 . "  $";
        if($units >=51 && $units <= 150) return "The total price is " . $units * 0.75 . "  $";
        if($units >=151 && $units <= 250) return "The total price is " . $units * 1.20 . "  $";
        if($units >=251) return "The total price is " . $units * 1.50 . "  $";
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
  </head>
  <body>
    <div class="container">
    <h1 class="my-3 text-center">Calculate Electricity Bill</h1>
    <table class="col-6 offset-3 mt-3 text-center">
        <tr scope="col">
            <th class="table-primary p-2">FROM</th>
            <th class="table-primary p-2">TO</th>
            <th class="table-primary p-2">PRICE</th>
        </tr>
        <tr>
            <td class="table-primary p-2">1 Unit</td>
            <td class="table-primary p-2">50 Units</td>
            <td class="table-primary p-2">0.50 $/Unit</td>
        </tr>
        <tr>
            <td class="table-primary p-2">51 Unit</td>
            <td class="table-primary p-2">150 Units</td>
            <td class="table-primary p-2">0.75 $/Unit</td>
        </tr>
        <tr>
            <td class="table-primary p-2">151 Unit</td>
            <td class="table-primary p-2">250 Units</td>
            <td class="table-primary p-2">1.20 $/Unit</td>
        </tr>
        <tr>
            <td class="table-primary p-2">251 Unit</td>
            <td class="table-primary p-2">unlimited Units</td>
            <td class="table-primary p-2">1.50 $/Unit</td>
        </tr>
    </table>

    <form method="GET">
        <div class="form-row align-items-center">
            
            <div class="col-4 offset-4">
            <div class="input-group my-3 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">Count Units</div>
                </div>
                <input type="number" class="form-control" name ="units">
            </div>
            </div>

            <div class="col-4 input-group-lg offset-4 ">
                <button type="submit" class="btn btn-primary mb-2 form-control ">Calculate</button>
            </div>

            <?php 
            if($_GET)
            echo('<div class="alert alert-primary col-4 offset-4 mt-3" style="text-align:center" role="alert">'
            . calculateBill() .
            '</div>')
            ?>
        </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>