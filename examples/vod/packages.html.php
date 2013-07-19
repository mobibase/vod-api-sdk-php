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
            <h2>All packages <span><?php echo $service->response->contents ?> packages</span></h2>

            <p>See <a href="videos.php">all videos</a></p>
            
            <ul id="packages">
            <?php foreach ($packages as $package): ?>
                <li>
                    <a href="package.php?id=<?php echo $package->id ?>">
                        <img src="<?php echo $package->video->preview ?>">
                        <h3><?php echo $package->name ?></h3>
                    </a>
                    <p><?php echo $package->contents ?> videos</a></p>
                </li>
            <?php endforeach ?>
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