<?php 

include('db.php');

$companiesArray = include('companies.php');

$sql = "SELECT * FROM user";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll();

?>

<!doctype html>

<html lang="ru">
<head>
	<meta charset="utf-8">

	<title>Список зарегистрированных</title>
	<meta name="description" content="Task for PlayNext">
	<meta name="author" content="Stanislav">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<style>
		html {
			height:100%;
		}

		body {
			font-family: 'Open Sans', sans-serif;
		}

		.list {
			width: 1200px;
			margin-top:50px;
		}

		.list table .ID {
			width: 50px;
		}

		.list table .company {
			width: 350px;
		}

		.list table .username {
			width: 350px;
		}

		.list table .phone {
			width: 200px;
		}

		.list table .date {
			width: 250px;
		}
	</style>
</head>

<body>
	<div class="container">

		<div class="list">
			<table class="table table-striped">
				<tr>
					<th class="ID">ID</th>
					<th class="company">Компания</th>
					<th class="username">Имя</th>
					<th class="phone">Телефон</th>
					<th class="date">Дата</th>
				</tr>
				<?php foreach($result as $item): ?>
					<tr>
						<td><?= $item['id']; ?></td>
						<td><?= $companiesArray[$item['company']]; ?></td>
						<td><?= $item['username']; ?></td>
						<td><?= $item['phone']; ?></td>
						<td><?= date(DATE_RFC822, $item['created_at']); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<a href="/"><i class="fa fa-angle-double-left"></i> Вернуться к форме</a>
	</div>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
