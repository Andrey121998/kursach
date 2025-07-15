<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>TO DO LIST</title>
	<!-- Подключение Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Подключение вашего CSS -->
    <link rel="stylesheet" href="/application/style.css"> <!-- Изменено на относительный путь -->
</head>
<body>
	<?php include 'application/views/'.$content_view; ?>
	 <!-- Подключение jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- Подключение Bootstrap JS (необязательно) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Подключение вашего JavaScript -->
    <script src="/application/edit.js"></script> <!-- Изменено на относительный путь -->
</body>
</html>