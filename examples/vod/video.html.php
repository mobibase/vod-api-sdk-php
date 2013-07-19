<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mobibase SDK : VOD example</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/mediaplayer/jwplayer.js"></script>
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
            <h2>Video <span><?php echo $video->name ?></span></h2>
            
            <p><a href="javascript:history.go(-1)">Back</a></p>

            <div id="video">
                <?php if ($stream->streamer) : ?>
                <video id="player"
                       src="<?php echo $stream->url ?>" 
                       width="480"
                       height="320"
                       poster="<?php echo $video->preview ?>">
                </video>
                <script>
                jwplayer("player").setup({
                    autostart: true,
                    flashplayer: "js/mediaplayer/player.swf",
                    streamer: '<?php echo $stream->streamer ?>'
                });
                </script>
                <?php else: ?>
                <a href="<?php echo $stream->url ?>">
                    <img src="<?php echo $video->preview ?>">
                </a>
                <?php endif ?>
                <h3><?php echo $video->name ?></h3>
                <p><a href="package.php?id=<?php echo $video->package->id; ?>"><?php echo $video->package->name; ?></a></p>
                <p><?php echo gmdate('H:i:s', $video->duration); ?></p>
                <p><?php echo $stream->url ?></p>
            </div>
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