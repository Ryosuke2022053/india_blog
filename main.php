<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<title>ItoRyosuke | India Trip</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Roboto:wght@400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>

	<!-- メニューボタン -->
	<div id="menubtn">
		<button class="ui-hamburger-05"></button>
	</div>

	<!-- ヘッダー　トップ画像とサイト名 -->
	<header class="header">
		<h1>India Trip Blog</a></h1>
		<p><a href="https://ryosuke2022053.github.io/portfolio/">Change to English</a></p>
	</header>

	<!-- メニュー -->
	<nav class="globalnav">
		<ul class="grid">
			<li><a href="top.php">Top</a></li>
			<li class="active"><a href="main.php">Blog</a></li>
			<li><a href="https://ryosuke2022053.github.io/portfolio/" target="_blank">Portfolio<img src='./img/125_arr_hoso.svg' height="25"></a></li>
			<li><a href="https://www.linkedin.com/in/ryosuke-ito-83a685237/" target="_blank">Linkedin<img src='./img/125_arr_hoso.svg' height="25"></a></li>
			<!-- <li><a href="link.php">Link</a></li> -->
		</ul>
	</nav>

	<!-- コンテンツ -->
	<main class="contents">
		<h2>Blog</h2>

		<div class="blog-scroll">
			<!-- <div class="blog-pack1">
				<h3>blog title</h3>
				<p class="blog-p">updates | locations
					<br><a href="https://www.linkedin.com/in/ryosuke-ito-83a685237/" target="_blank">https://www.linkedin.com/in/ryosuke-ito-83a685237/</a>
				</p>
				<figure class="side_image"><img src="./img/sample2.jpg"></figure>
				<p class="side_text">コロッセオは西暦80年にウェスパシアヌス帝、ティトゥス帝によって建てられた円形闘技場である。「コロッセオが立つ限り、ローマも立つ。コロッセオが倒れれば、ローマも倒れる。ローマが倒れれば、世界も倒れる。」と称えられているように、それはローマ帝国の繁栄を象徴するものであった。aaaaaaaaaaaaaaabbbbbbbbbbbb</p>
			</div>
			<hr> -->
			<div class="blog-pack1">
				<?php
				error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
				// $conn = "host=localhost dbname=myblog user=iryosuke password=ryosuke8121";
				$conn = "host=localhost dbname=s2022053 user=s2022053 password=J6LLllOC";
				$link = pg_connect($conn);
				$result = pg_query('SELECT * FROM mylink order by updates desc;');
				for ($i = 0; $i < pg_num_rows($result); $i++) {
					$rows = pg_fetch_array($result, NULL, PGSQL_ASSOC);
					print('<h3>' . $rows['title'] . '</h3>');
					print('<p class="blog-p">' . $rows['updates'] . '　|　' . $rows['locations'] . '<br><a href="' . $rows['urls'] . '" taget="_blank">' . $rows['urls'] . '</a>');
					print('<figure class="side_image"><img src=' . $rows['images'] . '></figure>');
					print('<p class="side_text">' . $rows['contents'] . '</p><hr>');
				}
				$close_flag = pg_close($link);
				?>
			</div>

		</div>
		<h2>Images</h2>
		<!-- <h3>Category</h3> -->
		<ul class="illust-thumb spotlight-group" data-page="true">
			<!-- <li><a href="img/sample2.jpg" class="spotlight"><img src="/img/sample2.jpg" alt=""></a></li> -->
			<?php
			error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
			$images = glob('img/*jpg');
			foreach ($images as $v) {
				print('<li><a href="'  . $v . '" class="spotlight"><img src="' . $v . '" alt=""></a></li>');
			}
			?>
		</ul>
	</main>

	<!-- フッター　クレジット -->
	<footer class="footer">
		<small>©2022 Ito Ryosuke | India Trip Blog</small>
		<!-- <small>Template & Material @ <a href="https://utsusemi.hiroec.com/" target="_blank">空蝉</a></small> -->
	</footer>

	<!--jQuery 読込-->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="js/common.js" type="text/javascript"></script>

	<!-- spotlight　読込 -->
	<script src="https://rawcdn.githack.com/nextapps-de/spotlight/0.6.3/dist/spotlight.bundle.js"></script>


</body>

</html>