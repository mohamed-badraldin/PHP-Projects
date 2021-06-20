<?php
$td = '';
if ($_POST) {
  if ($_POST['product'] !== '' && $_POST['username'] !== '') {
    for ($i = 1; $i <= (int)$_POST['product']; $i++) {
      $td .= '<tr>' .
        '<td><input class="form-control" name="_pro' . $i . '" type="text"></td>' .
        '<td><input class="form-control" name="_pri' . $i . '" type="number"></td>' .
        '<td><input class="form-control" name="_quant' . $i . '" type="number"></td>' .
        '<tr>';
    }
  }
}


if (isset($_POST['product'])) {
  $count_of_rows = $_POST['product'];
  if (isset($_POST['menu'])) {
    $arr_of_rows = [];

    for ($i = 1; $i <= $count_of_rows; $i++) {
      $arr = [];

      foreach ($_POST as $key => $val) {
        if (strpos($key, (string)$i)) {
          array_push($arr, $val);
        }
      }

      array_push($arr_of_rows, $arr);
    }

    $total = 0;
    $count =  count($arr_of_rows);
    for ($i = 0; $i < $count; $i++) {
      $sub_total = (int)$arr_of_rows[$i][1] * (int)$arr_of_rows[$i][2];
      array_push($arr_of_rows[$i], $sub_total);
      $total += $sub_total;
    }

    $table_arr = [];
    for ($i = 0; $i < $count; $i++) {
      array_unshift($table_arr, '<tr>');

      for ($j = 0; $j < 4; $j++) {
        $td = '<td>' . $arr_of_rows[$i][$j] . '</td>';
        array_push($table_arr, $td);
      }
      array_push($table_arr, '</tr>');
    }

    $table_str = implode('', $table_arr);
    // echo $table_str;

    // echo sizeof($arr_of_rows);
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
  <style>
    table th {
      color: #e81a51
    }

    table td {
      color: #0a183b
    }
  </style>
  <script src="https://kit.fontawesome.com/02da4c92dd.js" crossorigin="anonymous"></script>
</head>

<body style="background: url('1.jpg') no-repeat left bottom fixed; background-size:cover;">

  <div class="container">
    <div class="row">
      <h1 class="display-3 font-weight-bold col-12 mb-4 mt-3" style="color:#0a183b;">
        <i class="fab fa-shopify" style="color:#e81a51"></i>upermarket
      </h1>
    </div>

    <div class="row">
      <form class="col-7 offset-5 mb-5" method="POST" action="">
        <div class="form-group mb-4">
          <label for="userName" class="font-weight-bold" style="color:#e81a51;">User name</label>
          <input name="username" type="text" id="userName" class="form-control" style="background:transparent;border-color:#e81a51;color:#0a183b" value="<?php if (isset($_POST['username'])) {
                                                                                                                                                            echo $_POST['username'];
                                                                                                                                                          } ?>">
        </div>

        <label for="city" class="font-weight-bold" style="color:#e81a51;">City</label>
        <select name="city" class="custom-select mb-4" id="city" style="background-color:transparent;border-color:#e81a51;">
          <option <?php if (isset($_POST['city']) && $_POST['city'] == 'cairo') {
                    echo "selected";
                  } ?> value="cairo">Cairo</option>
          <option <?php if (isset($_POST['city']) && $_POST['city'] == 'giza') {
                    echo "selected";
                  } ?> value="giza">Giza</option>
          <option <?php if (isset($_POST['city']) && $_POST['city'] == 'alex') {
                    echo "selected";
                  } ?> value="alex">Alex</option>
          <option <?php if (isset($_POST['city']) && $_POST['city'] == 'others') {
                    echo "selected";
                  } ?> value="others">others</option>
        </select>

        <div class="form-group">
          <label for="product" class="font-weight-bold" style="color:#e81a51;">Number of varieties</label>
          <input name="product" type="number" id="product" class="form-control mb-5" style="background:transparent;border-color:#e81a51; color:#0a183b" value="<?php if (isset($_POST['product'])) {
                                                                                                                                                                  echo $_POST['product'];
                                                                                                                                                                } ?>">
        </div>

        <button type="submit" class="btn btn-primary form-control" style="background-color:#0a183b;border:0;color:#efebdf;">Enter products</button>
        <div class="row">
          <?php
          if ($_POST) {
            if (isset($_POST['menu'])) {
              ob_start("replace");
            }
            if ($_POST['product'] !== '' && $_POST['username'] !== '') {
              echo
              '<table class="table table-bordered text-center mt-5 mb-3" style="color:#e81a51">
                      <thead>
                         <tr>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantities</th>
                         </tr>
                        </thead>
                      <tbody>',
              $td,
              '</tbody>
                    </table>',
              '<button name="menu" type="submit" class="btn btn-primary form-control mb-5" 
                        style="background-color:#0a183b;border:0;color:#efebdf;">Receipt</button>',
              '</form>';
            }
            ob_end_flush();
          }

          function replace()
          {
            global $table_str, $total;
            $discount = 0;
            $total_after_discount = 0;
            if ($total < 1000) {
              $discount = $total * 0;
            }
            $total_after_discount = $total - $discount;
            if ($total < 3000 && $total >= 1000) {
              $discount = $total * 0.1;
            }
            $total_after_discount = $total - $discount;
            if ($total < 4500 && $total >= 3000) {
              $discount = $total * 0.15;
            }
            $total_after_discount = $total - $discount;
            if ($total > 4500) {
              $discount = $total * 0.20;
            }
            $total_after_discount = $total - $discount;

            $delivery = 0;
            if ($_POST['city'] == 'cairo') {
              $delivery = 0;
            }
            if ($_POST['city'] == 'giza') {
              $delivery = 30;
            }
            if ($_POST['city'] == 'alex') {
              $delivery = 50;
            }
            if ($_POST['city'] == 'others') {
              $delivery = 100;
            }
            if ($total_after_discount == 0) {
              $delivery = 0;
            }

            $net_total = $total_after_discount + $delivery;

            return '<table class="table table-bordered text-center my-5 mb-3">
          <thead>
            <tr>
              <th scope="col">Product name</th>
              <th scope="col">Price</th>
              <th scope="col">Quantities</th>
              <th scope="col">Sub total</th>
            </tr>
          </thead>
          <tbody>'
              . $table_str .
              '<tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">Clint name</td>
              <td colspan="2"style="text-align:left">' . $_POST['username'] . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">City</td>
              <td colspan="2"style="text-align:left">' . $_POST['city'] . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">Total</td>
              <td colspan="2"style="text-align:left">' . $total . '  EGP' . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">Discount</td>
              <td colspan="2"style="text-align:left">' . $discount . '  EGP' . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">Total after discount</td>
              <td colspan="2"style="text-align:left">' . $total_after_discount . '  EGP' . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; text-align:left">Delivery</td>
              <td colspan="2"style="text-align:left">' . $delivery . '  EGP' . '</td>
              </tr>
              <tr>
              <td  colspan="2"style="font-weight:bold; color:#e81a51; text-align:left">Net Total</td>
              <td  colspan="2"style="font-weight:bold; text-align:left">' . $net_total . '  EGP' . '</td>
              </tr>
          </tbody>
          </table>';
          }

          ?>




        </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>