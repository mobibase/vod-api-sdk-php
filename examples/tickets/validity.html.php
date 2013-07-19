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

        <h2>Check a Ticket</h2>

        <ul class="navigation">
            <li><a href="profiles.php">Tickets Profiles</a></li>
            <li><a href="create.php">Create a ticket</a></li>
            <li><a href="invalidate.php">Invalidate a ticket</a></li>
            <li><a href="validity.php">Check a ticket</a></li>
        </ul>

        <!-- An error occurs -->
        <?php if (isset($error)): ?>
            <div id="error">
                <?php echo $error ?>
            </div>

        <!-- Everything is ok -->
        <?php else : ?>
            <form action="validity.php" method="get">
                <input type="text" name="ticket" placeholder="Enter a ticket..." value="<?php echo $ticket_to_check ?>">
                <input type="submit" value="Check">
            </form>

            <?php if (isset($validity)) : ?>
            <?php 
                switch($validity->status) {
                    case true:
                        $message = 'This ticket is valid.';
                        $class = 'valid';
                    break;
                    case false:
                        $message = 'This ticket is no longer valid.';
                        $class = 'invalid';
                    break;
                    default: 
                        $message = 'No info about this ticket.';
                        $class = 'unknown';
                }
            ?>
            <div class="status <?php echo $class ?>"><?php echo $message ?></div>
            <?php endif ?>
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