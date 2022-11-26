
<?php


        if (isset($_SESSION['username'])) {

            $connect = mysqli_connect("localhost", "almajded_dashboard_user", "Wdk?p)3L?3(H", "almajded_dashboard");
            // $connect = mysqli_connect("localhost", "root", "", "dashboard_5");
            $message = '';

            if(isset($_POST["upload"])) {
                if($_FILES['product_file']['name']) {
                    $filename = explode(".", $_FILES['product_file']['name']);
                    if(end($filename) == "csv") {
                        $handle = fopen($_FILES['product_file']['tmp_name'], "r");
                        function cleanFu($string) {

                            return preg_replace('/[^\w\s]+/u','' ,$string);
                        }
                        $st =" TRUNCATE TABLE `daily_product`;"	;
                        mysqli_query($connect, $st);
                        while($data = fgetcsv($handle)) :

                            $parent_id          = cleanFu(mysqli_real_escape_string($connect, $data[0]));
                            $name               = cleanFu(mysqli_real_escape_string($connect, $data[1]));
                            $student_id         = cleanFu(mysqli_real_escape_string($connect, $data[2]));
                            $stage              = cleanFu(mysqli_real_escape_string($connect, $data[3]));
                            $student_row        = cleanFu(mysqli_real_escape_string($connect, $data[4]));
                            $previous_fees      = cleanFu(mysqli_real_escape_string($connect, $data[5])); // الرسوم السابقة
                            $current_year_fees  = cleanFu(mysqli_real_escape_string($connect, $data[6])); // رسومالسنة الحالية
                            $rebate             = cleanFu(mysqli_real_escape_string($connect, $data[7]));

                            $translate          = cleanFu(mysqli_real_escape_string($connect, $data[8]));
                            $books              = cleanFu(mysqli_real_escape_string($connect, $data[9]));
                            
                            $paid               = cleanFu(mysqli_real_escape_string($connect, $data[10]));
                            $payment_date       = cleanFu(mysqli_real_escape_string($connect, $data[11]));
                            $payout_ratio       = cleanFu(mysqli_real_escape_string($connect, $data[12]));
                            $remaining          = cleanFu(mysqli_real_escape_string($connect, $data[13]));



                        $sql = "INSERT INTO `daily_product` 
                                        (`id`, `parent_id`, `name`, `student_id`, `stage`, `student_row`, `previous_fees`, `current_year_fees`,`translate`, `books`, `rebate`, `paid`, `payment_date`, `payout_ratio`, `remaining`)
                                        VALUES
                                        (NULL, '$parent_id', '$name', '$student_id', '$stage', '$student_row', '$previous_fees', '$current_year_fees', '$translate', '$books', '$rebate', '$paid', '$payment_date', '$payout_ratio', '$remaining');";
                        mysqli_query($connect, $sql);

                        endwhile;
                        fclose($handle);
                        // header("location: index.php?updation=1");
                    } else {
                        $message = '<label class="text-danger">Please Select CSV File only</label>';
                    }

                }
                else {
                    $message = '<label class="text-danger">Please Select File</label>';
                }

            } // first if ($_POST["upload"])

            if(isset($_GET["updation"])) {
                $message = '<label class="تم رفع الملف بنجاح"</label>';
            }

            $query = "SELECT * FROM daily_product";
            $result = mysqli_query($connect, $query);

?>

<!DOCTYPE html >
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>تحديث قاعدة البيانات من خلال من اكسل</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
 <body>

  <div class="container">
   <h2 align="center">تحديث قاعدة بيانات الطلاب </h2>
   <div class="d-flex  row text-center info-upload" style="display: flex; text-align: center; background: #eee;  margin: auto; padding: 10px 20px; gap: 35px; justify-content: space-evenly; border-radius: 8px;">
       <a class="col btn btn-danger" style="height: fit-content;" href="logout.php">تسجيل الخروج</a>
       <form class="col" method="post" enctype='multipart/form-data'>
           <p><label>ارجو اختيار ملف من نوع cvs</label>
           <input type="file" name="product_file" /></p>
           <input type="submit" name="upload" class="btn btn-info" value="رفع" />
        </form>
    </div>
   <?php echo $message; ?>
   <h3 align="center">البيانات المحفوظة</h3>
   <div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
     <tr>

      <th>رقم ولي الامر</th>
      <th>الاسم</th>
      <th>رقم الطالب </th>

      <th> المرحلة </th>
      <th> الصف </th>

      <th> الرسوم السابقة </th>
      <th> الرسوم الحالية </th>

      <th> الخصم </th>

      <th>رسوم النقل </th>
      <th>رسوم الكتب</th>

      <th>المدفوع</th>
      <th>التاريخ</th>
      <th>المتبقي</th>

      <th>نسبة الدفع</th>
      
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["parent_id"].'</td>
       <td>'.$row["name"].'</td>
       <td>'.$row["student_id"].'</td>
       <td>'.$row["stage"].'</td>
       <td>'.$row["student_row"].'</td>

       <td>'.$row["previous_fees"].'</td>
       <td>'.$row["current_year_fees"].'</td>
       <td>'.$row["rebate"].'</td>
       
       <td>'.$row["translate"].'</td>
       <td>'.$row["books"].'</td>

       <td>'.$row["paid"].'</td>
       <td>'.$row["payment_date"].'</td>
       <td>'.$row["payout_ratio"].'</td>
       <td>'.$row["remaining"].'</td>
      </tr>
      ';
     }
     ?>
    </table>
   </div>
  </div>
 </body>
</html>

<?php
    } else {
        echo "غير مسموح لك في الدخول لهذه الصفحة";
        print_r($_SESSIONj['username']);
    }
?>