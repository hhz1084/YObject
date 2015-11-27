<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $article['title']?></title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/static/css/main.css" />
</head>
<body>
    <div class="panel panel-info">
      <div class="panel-heading">
      <?php echo $article['title']?>
      </div>
      <div class="panel-body">
        <p class="content"><?php echo $article['content']?></p>
      </div>
      
    </div>
</body>
</html>