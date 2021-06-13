<?php 

function calculate(){
    if($_GET){
        $firstNum = $_GET['frist'];
        $secondNum = $_GET['second'];
        $thirdNum = $_GET['third'];

        if ( $firstNum > $secondNum ){
        
            if ( $firstNum > $thirdNum ){
                return "Number " . $firstNum . " is the maximum ";
            }
            elseif ( $firstNum === $thirdNum ) {
                return "Number " . $firstNum . " and number " . $thirdNum . 
                    " are equal in value and they are biger than " . $secondNum;
            }
            else{
                return "Number " . $thirdNum . " is the maximum ";
            }
        
        }
        
        elseif ( $firstNum === $thirdNum && $firstNum === $secondNum ) {
            return "Number " . $firstNum . ", number " . $thirdNum . 
                " and number " . $secondNum . "are equal in value";
        }
        elseif($secondNum > $firstNum){
        
            if ( $secondNum > $thirdNum ){
                return "Number " . $secondNum . " is the maximum ";
            }
            elseif ( $secondNum === $thirdNum ) {
                return "Number " . $secondNum . " and number " . $thirdNum . 
                    " are equal in value and they are biger than " . $thirdNum;
            }
            else{
                return "Number " . $thirdNum . " is the maximum ";
            }
        }
        else{
            return "Number " . $firstNum . " and number " . $secondNum . 
                " are equal in value and they are biger than " . $thirdNum;
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>calculate the maximum</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
        
 <!-- container to hold all inputs of form  -->
    <div class="container" style="margin-top: 150px">
    <h1 class="mb-3" style="text-align:center;font-weight:bold">Calculate the maximum </h1>
        <form method="GET">
        <div class="form-row align-items-center">
            
            <div class="col-4">
            <div class="input-group mb-2 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">Frist Number</div>
                </div>
                <input type="number" class="form-control" name ="frist">
            </div>
            </div>

            <div class="col-4">
            <div class="input-group mb-2 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">Second Number</div>
                </div>
                <input type="number" class="form-control" name ="second">
            </div>
            </div>

            <div class="col-4">
            <div class="input-group mb-2 input-group-lg">
                <div class="input-group-prepend">
                <div class="input-group-text">Third Number</div>
                </div>
                <input type="number" class="form-control" name ="third">
            </div>
            </div>

            <div class="col-8 input-group-lg offset-2 mt-3">
                <button type="submit" class="btn btn-primary mb-2 form-control ">Calculate</button>
            </div>

            <?php 
            if(calculate())
            echo('<div class="alert alert-primary col-8 offset-2 mt-3" style="text-align:center" role="alert">'
            . calculate() .
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