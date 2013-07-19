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

        <h2>Invalidate a Ticket</h2>

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
            <form action="invalidate.php" method="post">
                <input type="text" name="ticket" placeholder="Enter a ticket..." value="<?php echo $ticket_to_invalidate ?>">
                <input type="submit" value="Invalidate">
            </form>
        
            <?php if (isset($validity)) : ?>
                <div class="status">This ticket is no longer valid</div>
            <?php endif ?>
        <?php endif ?>

        <!-- Display response -->
        <?php if ($settings['trace'] && isset($service)) : ?>
        <div id="trace">
            <a id="toggle-debug" href="#">Show trace</a>
            <div>
                <h4>Request</h4>
                <pre><?php print_r($client->getLastRequest()); ?></pre>

                <h4>Posted Data</h4>
                <pre><?php print_r($client->getLastPostedData()); ?></pre>

                <h4>Response</h4>
                <pre><?php print_r($client->getLastResponse()); ?></pre>
            </div>
        </div>
        <?php endif ?>
    </body>
</html>