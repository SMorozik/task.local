<?php
include('db.php');

$companiesArray = include('companies.php');
$errors = null;
$date = time();
$submitted = false;

if (isset($_POST['registration-submit'])) {
	$company = $_POST['company'];
	$username = $_POST['username'];
	$phone = $_POST['phone'];

	if ($company != '') {
		if (!array_key_exists($company, $companiesArray)) {
			$errors[] = 'Пожалуйста выберите <b>компанию</b>.';
		}
	} else {
		$errors[] = 'Пожалуйста выберите <b>компанию</b>.';
	}

	if ($username != '') {
		if (!preg_match("/^[а-яА-ЯёЁa-zA-Z]{3,50}$/u", $username)) {
			$errors[] = '<b>Имя</b> может состоять только из букв.';
		}
	} else {
		$errors[] = 'Пожалуйста введите <b>Имя</b>.';
	}

	if ($phone != '') {
		if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$/", $phone)) {
			$errors[] = 'Неправильный <b>Номер телефона</b>';
		}
	} else {
		$errors[] = 'Пожалуйста введите <b>Номер телефона</b>.';
	}

	if (!$errors) {
		$sql = "INSERT INTO user (company, username, phone, created_at) VALUES(:company, :username, :phone, :date)";
		$query = $pdo->prepare($sql);
		$query->bindParam(':company', $company);
		$query->bindParam(':username', $username);
		$query->bindParam(':phone', $phone);
		$query->bindParam(':date', $date);

		if ($query->execute()) {
			$submitted = true;
			unset($_POST);
		} else {
			// print_r($query->errorInfo());
		}
	}
}

?>

<!doctype html>

<html lang="ru">
<head>
	<meta charset="utf-8">

	<title>Регистрация</title>
	<meta name="description" content="Task for PlayNext">
	<meta name="author" content="Stanislav">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


  	<!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>
    	html {
    		height:100%;
    	}

    	body {
    		font-family: 'Open Sans', sans-serif;
    	}

    	.block-registraion {
    		width: 300px;
    		position: absolute;
    		top: 100px;
    		right: 0;
    		bottom: 0;
    		left: 0;
    		margin: auto;
    	}

    	#success {
    		margin-top: 50px;
    	}
    </style>
</head>

<body>
	<div class="container">
		<? if (!$submitted) : ?>
		<div class="block-registraion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Регистрация</strong>  
				</div>
				<div class="panel-body">
					<form method="POST" name="registration-form">
						<?php 
						if ($errors) {	
							print "<div class=\"alert alert-danger\">";
							foreach ($errors as $v) {
								print $v . "<br>";
							}
							print "</div>";
						}	
						?>
						<br>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
							<select class="form-control" name="company" id="company" required>
								<?php 
								foreach($companiesArray as $k => $v) {
									if ($k == $_POST['company']) {
										print "<option value=\"{$k}\" selected>{$v}</option>";
									} else {
										print "<option value=\"{$k}\">{$v}</option>";
									}
								}								
								?>
							</select>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" pattern="^[а-яА-ЯёЁa-zA-Z]{3,255}$" class="form-control" name="username" placeholder="Ваше Имя" value="<?= $_POST['username'] ?>" required>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="tel" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$" class="form-control" name="phone" placeholder="+790012345678" value="<?= $_POST['phone'] ?>" required>
						</div>

						<input type="submit" class="btn btn-success" name="registration-submit" value="Зарегистрировать">
						<hr>
						<a href="/list.php"><i class="fa fa-list"></i> Список зарегистрированных</a>
					</form>
				</div>
			</div>
			<a href="https://github.com/SMorozik/task.local" target="_blank"><i class="fa fa-link"></i> Code on Github</a>
		</div>
	<?php else: ?>
		<div class="alert alert-success" id="success">Спасибо за регистрацию. <a href="/"><strong>Вернуться ↝</strong></a></div>
	<?php endif; ?>
	</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

