<?php

	include('pdoContect.php');
	$resultIs = false;
	$er = "لايوجد بيانات لعرضها ابحث اولا";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if (isset($_POST['searchId'])) :

			$searchId = $_POST['searchId'];
			
			if ($searchId == "") {

				$er = " لا يوجد كلمة بحث في حقل البحث الخاص ب رقم الهويه";

			} else {

				
				
				$stmt = $con->prepare("SELECT * FROM daily_product WHERE parent_id = ?");
				
				$stmt->execute(array($searchId));
				
				$countRow = $stmt->rowCount();
				
				if ($countRow > 0) {
					
					// echo "استعلام برقم الهويه صحيح";
					// echo "+1";
					$resultIs = $stmt->fetchAll();
				} else {
					
					echo "<div style=' text-align: center; padding: 10px; background: red; color: white;'>  لا يوجد معلومات عن بحثك رقم الهويه خاطى</div>";
					
				}
			}

		endif; // searchId

		if (isset($_POST['numberStudent'])) :

			$numberStudent= $_POST['numberStudent'];

			if($numberStudent == "") {
				$er = "لا يوجد كلمة بحث في الحقل الخاص برقم الطالب";
			} else {

				$stmt = $con->prepare("SELECT * FROM daily_product WHERE student_id = ?");
				
				$stmt->execute(array($numberStudent));
				
				$countRow = $stmt->rowCount();
				
				if ($countRow > 0) {
					
					// echo "استعلام برقم الطالب صحيح";
					echo "+1";
					
					$resultIs = $stmt->fetchAll();
					
				} else {
					
					echo "<div style=' text-align: center; padding: 10px; background: red; color: white;'>لا يوجد نتائج لبحثك ارجو ادخال رقم الطالب بشكل صحيح</div>";
					
				}
			}

		endif;
	}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/home.css">
        <title>لوحة النتائج</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
    </head>
    <body style="margin:0px">
			<header>
				<div class="container">

					<a href="https://almajd.edu.sa/" class="logo">
						<img src="./img/logo.png" alt="مدارس  المجد الاهلية">
					</a>
					<ul>
						<li><a href="http://almajd.edu.sa/">الصفحة الرئيسية</a></li>
						<li><a href="https://almajd.edu.sa/contact/">اتصل بنا</a></li>
					</ul>
				</div>
			</header>
			<div class="container">

				<h1>صفحة المعلومات</h1>
				<div class="search-box">
					<div class="id-student">
						<form aaction=" <?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
							<label for="searchId">البحث برقم الهوية</label>
							<input type="text" name="searchId" id="searchId" placeholder="رقم الهوية">
							<div class="btn-form">
								<input type="submit" value="بحث">
								<input class="rest" type="reset" value="أعادة تعيين">
							</div>
						</form>
					</div>
					<div class="number-student">
						<form action=" <?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
							<label for="numberStudent">البحث برقم الطالب</label>
							<input type="text" name="numberStudent" id="numberStudent" placeholder="رقم الطالب">
							<div class="btn-form">
								<input type="submit" value="بحث">
								<input class="rest" type="reset" value="أعادة تعيين">
							</div>
						</form>
					</div>
				</div>
				<div class="table">
					<?php
						if($resultIs) {
							$className = 1;
							foreach  ($resultIs as $r ) {
								$parent_id 	 		= $r['parent_id'];
								$name 		 		= $r['name'];
								$student_id  		= $r['student_id'];
								$stage 		 		= $r['stage'];
								$student_row 		= $r['student_row'];
								$previous_fees 		= $r['previous_fees'];
								$current_year_fees 	= $r['current_year_fees'];
								$rebate 			= $r['rebate'];
								$paid 				= $r['paid'];
								$translate 			= $r['translate'];
								$books 				= $r['books'];
								$payment_date 		= $r['payment_date'];
								$payout_ratio 		= $r['payout_ratio'];
								$remaining 			= $r['remaining'];
								
								echo <<<"info"
									<div class="name-student-table"> 
										<span>
											اسم الطالب/ة
										</span>
										<h2> $name </h2>
										<p class="show-details" data-classname="student$className">إظهار التفاصيل</p>
									</div>
									<div class="details active student$className">

										<ul>
											<li>
												<span>اسم الطالب </span>
												<span> $name </span>
											</li>
											<li>
												<span>رقم الطالب</span>
												<span>$student_id</span>
											</li>
											<li>
											<span>المرحلة</span>
											<span>$stage</span>
											
											</li>
											<li>
											<span>الصف</span>
											<span>$student_row</span>

											</li>
										</ul>

										<ul>
											<li>
												<span>الرسوم المستحقة</span>
												<span>$previous_fees</span>

											</li>

											<li>
												<span>الرسوم الحالية</span>
												<span>$current_year_fees</span>

											</li>
											<li>
												<span>الخصم</span>
												<span>$rebate</span>

											</li>
											<li>
												<span>رسوم النقل</span>
												<span>$translate</span>

											</li>
										</ul>
									
										<ul>
											<li>
												<span>الكتب</span>
												<span>$books</span>
												
											</li>
											<li>
												<span>المدفوع</span>
												<span>$paid</span>

											</li>
											<li>
												<span>المتبقي</span>
												<span>$payout_ratio</span>

											</li>
											<li>
											<span>نسبة الدفع</span>
											<span>$remaining</span>
											
											</li>	
										</ul>
										<ul>
											<li class="last-items-date">
											<span>التاريخ</span>
											<span>$payment_date</span>
											</li>	
										</ul>
									</div>
								info;
								$className++;
							}
						} else {
							echo $er;
						}
					?>
				</div>
			</div>
		<script src="js/all.js"></script>
	</body>
</html>