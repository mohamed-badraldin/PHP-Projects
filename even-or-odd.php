<?php
    function even_Odd(){
        if(!$_GET['number']){
            return "Input The Number";
        }
        $num = $_GET['number'];
        if($num % 2 !== 0){
            return "Odd Number";
        }
        else{
            return "Even Number";
        }
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
      
    <form method="GET">
    <div class="container" style="margin-top:150px">
    <h1 style="text-align:center; font-weight:bold" class="mb-3">Even-or-Odd</h1>
        <div class="col-6  offset-3">
            <div class="input-group mb-2 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">The Number</div>
                </div>
                <input type="number" class="form-control" name ="number">
            </div>
        </div>
        <div class="col-6 input-group-lg offset-3 mt-3 mb-3">
                <button type="submit" class="btn btn-primary mb-2 form-control ">CHECK</button>
        </div>
        
        <?php
        if($_GET){
           echo ('<div class="alert alert-primary col-4 offset-4" style="text-align:center" role="alert">'
                . even_Odd() .
                '</div>');
        }
        ?>
    </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>