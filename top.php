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
		<h1>India Trip Blog</h1>
		<p><a href="https://ryosuke2022053.github.io/portfolio/">Change to English</a></p>
	</header>

	<!-- メニュー -->
	<nav class="globalnav" id="menu">
		<ul class="grid">
			<li class="active"><a href="top.php">Top</a></li>
			<li><a href="main.php">Blog</a></li>
			<li><a href="https://ryosuke2022053.github.io/portfolio/" target="_blank">Portfolio<img src='./img/125_arr_hoso.svg' height="25"></a></li>
			<li><a href="https://www.linkedin.com/in/ryosuke-ito-83a685237/" target="_blank">Linkedin<img src='./img/125_arr_hoso.svg' height="25"></a></li>
		</ul>
	</nav>

	<!-- コンテンツ -->
	<main class="contents">
		<h2>About This Site</h2>
		<p>2022年5月から7月までの3ヶ月間インドを旅しました。<br>
			旅の３ヶ月間で私は、あらゆる街に行き、様々な体験をすることができました。<br>
			このサイトはインド旅ブログのまとめサイトとなっております。<br>
			気になるブログのURLを押していただくとLinkdeInのブログのページに移動します。<br>
		</p>
		<h2>What's New</h2>
		<ul class="news">
			<!-- <li>
				<a href="https://www.linkedin.com/in/ryosuke-ito-83a685237/">
					<time>2018.09.14</time>
					<span class="text">更新内容を記載してください</span>
				</a>
			</li> -->

			<?php
			error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
			// $conn = "host=localhost dbname=myblog user=iryosuke password=ryosuke8121";
			$conn = "host=localhost dbname=s2022053 user=s2022053 password=J6LLllOC";
			$link = pg_connect($conn);
			$result = pg_query('SELECT title, updates, urls FROM mylink order by updates desc;');
			for ($i = 0; $i < pg_num_rows($result); $i++) {
				$rows = pg_fetch_array($result, NULL, PGSQL_ASSOC);
				if ($i == 0) {
					print('<li>');
					print('<a href="' . $rows["urls"] . '">');
					print('<time>' . $rows['updates'] . '</time>');
					print('<span class="text"><span class="change-font">new　</span>' . $rows['title'] . '</span> ');
					print('</a></li>');
				} else {
					print('<li>');
					print('<a href="' . $rows["urls"] . '">');
					print('<time>' . $rows['updates'] . '</time>');
					print('<span class="text">' . $rows['title'] . '</span>');
					print('</a></li>');
				}
			}
			$close_flag = pg_close($link);
			?>

		</ul>


		<h2>About Link</h2>
		<dl class="gridlist">
			<dt>サイト名</dt>
			<dd>India Trip Blog</dd>
			<dt>開発者</dt>
			<dd>Ito Ryosuke</dd>
			<dt>URL</dt>
			<dd><a href='https://www.linkedin.com/in/ryosuke-ito-83a685237/' target="_blank">https://www.linkedin.com/in/ryosuke-ito-83a685237</a></dd>
		</dl>
	</main>

	<!-- フッター　クレジット -->
	<footer class="footer">
		<small>©2022 Ito Ryosuke | India Trip Blog</small>
		<!-- <small>Template & Material @ <a href="https://utsusemi.hiroec.com/" target="_blank">空蝉</a></small> -->
	</footer>

	<!--jQuery 読込-->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="js/common.js" type="text/javascript"></script>

</body>

</html>