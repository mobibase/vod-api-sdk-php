<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mobibase SDK : VOD example</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="js/app.js"></script>
    </head>
    <body>
        <h1><a href="index.php">Mobibase VOD example</a></h1>

        <!-- An error occurs -->
        <?php if (isset($error)): ?>
            <div id="error">
                <?php echo $error ?>
            </div>

        <!-- Everything is ok -->
        <?php else : ?>
            <h2><?php echo $package->name ?> <span><?php echo $package->contents ?> videos</span></h2>
            
            <p><a href="javascript:history.go(-1)">Back</a></p>

            <ul id="videos">
            <?php foreach ($package->videos as $video): ?>
                <li>
                    <a href="video.php?id=<?php echo $video->id ?>">
                        <img src="<?php echo $video->preview ?>">
                        <h3><?php echo $video->name ?></h3>
                    </a>
                    <p><?php echo gmdate('H:i:s', $video->duration) ?></p>
                </li>
            <?php endforeach ?>
            </ul>

            <ul id="pagination">
            <?php for($i = 1; $i <= $pages; $i++) : ?>
                <?php if ($i == $page) : ?>
                <li class="current"><?php echo $i ?></li>
                <?php else: ?>
                <li><a href="?id=<?php echo $package->id ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            </ul>
        <?php endif ?>

        <!-- Display response -->
        <?php if ($settings['trace'] && isset($service)) : ?>
        <div id="trace">
            <a id="toggle-debug" href="#">Show trace</a>
            <div>
                <h4>GET</h4>
                <pre><?php print_r($client->getLastRequest()); ?></pre>

                <h4>Response</h4>
                <pre><?php print_r($client->getLastResponse()); ?></pre>
            </div>
        </div>
        <?php endif ?>
    </body>
</html>