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
        <?php else: ?>
            <h2>Device compatibility</h2>
            <p>Is the device compatible with the service.</p>
            
            <?php 
                switch($device->compatible) {
                    case 'true':
                        $message = 'Compatible.';
                        $class = 'compatible';
                    break;
                    case 'false':
                        $message = 'Not compatible.';
                        $class = 'not-compatible';
                    break;
                    case 'player_required':
                        $message = 'Compatible but an extra player could be needed.';
                        $class = 'player-required';
                    break;
                    default: 
                        $message = 'No info about this device.';
                        $class = 'unknown';
                }
            ?>
            <div class="status <?php echo $class ?>"><?php echo $message ?></div>
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