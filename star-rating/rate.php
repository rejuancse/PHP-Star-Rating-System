<?php 
	require_once 'app/init.php';
	
	if (isset($_GET['article'], $_GET['rating'])) {
		$article = (int)$_GET['article'];
		$rating = (int)$_GET['rating'];

		if (in_array($rating, [1, 2, 3, 4, 5])) {
			$exists = $db->query("SELECT id FROM articles WHERE id = {$article}")->num_rows ? true : false;

			if ($exists) {
				$db->query("INSERT INTO article_rating (article, rating) VALUES ({$article}, {$rating})");
			}
		}

		header('Location: article.php?id=' .$article);

	}

