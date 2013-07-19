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

        <h2>Ticket profile</h2>

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
            <table>
                <tr>
                    <th>Name</th>
                    <td><b><?php echo $profile->name ?></b></td>
                </tr>
                <tr>
                    <th>Validity</th>
                    <td><?php echo $profile->validity_duration ?></td>
                </tr>
                <tr>
                    <th>Duration per video</th>
                    <td><?php echo $profile->duration_per_video ?></td>
                </tr>
                <tr>
                    <th>Total duration allowed</th>
                    <td><?php echo $profile->total_duration ?></td>
                </tr>
                <tr>
                    <th>Total videos allowed</th>
                    <td><?php echo $profile->total_videos ?></td>
                </tr>
                <tr>
                    <th>price</th>
                    <td><?php echo $profile->price ?> <?php echo $profile->devise ?></td>
                </tr>
                <tr>
                    <th>Network</th>
                    <td><?php echo implode($profile->networks, ', ') ?></td>
                </tr>
            </table>
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