<?php 
	require_once 'app/init.php';
	
	$article = null;
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
		$article = $db->query("
			SELECT articles.id, articles.title, AVG(article_rating.rating) AS rating 
			FROM articles
			LEFT JOIN article_rating 
			ON articles.id = article_rating.article
			WHERE articles.id = {$id}
		")->fetch_object();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Article</title>
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
	<?php if($article): ?>
		<div class="article">
			<h3>This is article "<?php echo $article->title; ?>"</h3>
			<div class="article-rating"><span>Rating: <?php echo round($article->rating); ?>/5</span></div>
			<div class="article-rate">
				Rate this article:
				<?php foreach(range(1, 5) as $rating): ?>
					<a href="rate.php?article=<?php echo $article->id; ?>&rating=<?php echo $rating; ?>"><?php echo $rating; ?></a>
				<?php endforeach; ?>
			</div> 
		</div>
	<?php endif ?>
</div>
</body>
</html>