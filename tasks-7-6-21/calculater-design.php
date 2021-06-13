<?php
    function result(){
        $frist = (integer)$_GET['first_num'];
        $second = (integer)$_GET['second_num'];
        $operator = $_GET['operator'];

        switch($operator){
            case "+":
                $result = $frist + $second;
                return  "$frist  +  $second  =  " . $result;
                break;
            case "-":
                $result = $frist - $second;
                return  "$frist  -  $second  =  " . $result;
                break;
            case "*":
                $result = $frist * $second;
                return  "$frist  *  $second  =  " . $result;
                break;
             case "/":
                $result = $frist / $second;
                return  "$frist  /  $second  =  " . $result;
                break;
            default:
                return "chose correct operator";
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
                <div class="input-group-text">Number</div>
                </div>
                <input type="number" class="form-control" name ="first_num" Required>
            </div>
        </div>
        <div class="col-6  offset-3">
            <div class="input-group mb-2 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">Number</div>
                </div>
                <input type="number" class="form-control" name ="second_num" Required >
            </div>
        </div>
        <div class="row">
            <div class="col-1 input-group-lg mt-3 mb-3 offset-4">
                    <button type="submit" class="btn btn-primary mb-2 form-control " name="operator" value="+">+</button>
            </div>
            <div class="col-1 input-group-lg mt-3 mb-3">
                    <button type="submit" class="btn btn-primary mb-2 form-control " name="operator" value="-">-</button>
            </div>
            <div class="col-1 input-group-lg mt-3 mb-3">
                    <button type="submit" class="btn btn-primary mb-2 form-control " name="operator" value="*">*</button>
            </div>
            <div class="col-1 input-group-lg mt-3 mb-3">
                    <button type="submit" class="btn btn-primary mb-2 form-control " name="operator" value="/">/</button>
            </div>
        </div>
        
        <?php
        if($_GET){
           echo ('<div class="alert alert-primary col-4 offset-4" style="text-align:center" role="alert">'
                . result() .
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