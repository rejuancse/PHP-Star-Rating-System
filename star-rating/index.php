<?php 
	require_once 'app/init.php';

	#all articles table
	$query = $db->query("
			SELECT articles.id, articles.title, AVG(article_rating.rating) AS rating 
			FROM articles
			LEFT JOIN article_rating 
			ON articles.id = article_rating.article
			GROUP BY articles.id
		");
 
	#loop
	$articles = [];
	while ( $row = $query->fetch_object() ) {
		$articles[] = $row;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Rating Control</title>
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>
</head>
<body>
	



<div class="container">
<div class="main-container">
	<?php foreach ($articles as $article) : ?>
		<div class="articles">
			<h3><a href="article.php?id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a></h3>
			<!-- <div class="article-rating">Rating: <?php// echo round($article->rating); ?>/5</div> -->
			<form>
               <input id="input-21e" value="<?php echo round($article->rating); ?>" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="xs" title="">
		    </form>
		</div>
	<?php endforeach; ?>
</div>
    
    
    <script>
        jQuery(document).ready(function () {
            $("#input-21f").rating({
                starCaptions: function (val) {
                    if (val < 3) {
                        return val;
                    } else {
                        return 'high';
                    }
                },
                starCaptionClasses: function (val) {
                    if (val < 3) {
                        return 'label label-danger';
                    } else {
                        return 'label label-success';
                    }
                },
                hoverOnClear: false
            });
            var $inp = $('#rating-input');

            $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'lg',
                showClear: false
            });

            $('#btn-rating-input').on('click', function () {
                $inp.rating('refresh', {
                    showClear: true,
                    disabled: !$inp.attr('disabled')
                });
            });


            $('.btn-danger').on('click', function () {
                $("#kartik").rating('destroy');
            });

            $('.btn-success').on('click', function () {
                $("#kartik").rating('create');
            });

            $inp.on('rating.change', function () {
                alert($('#rating-input').val());
            });


            $('.rb-rating').rating({
                'showCaption': true,
                'stars': '3',
                'min': '0',
                'max': '3',
                'step': '1',
                'size': 'xs',
                'starCaptions': {0: 'status:nix', 1: 'status:wackelt', 2: 'status:geht', 3: 'status:laeuft'}
            });
            $("#input-21c").rating({
                min: 0, max: 8, step: 0.5, size: "xl", stars: "8"
            });
        });
    </script>
</div>
</body>
</html>