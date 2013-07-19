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

        <h2>Tickets profiles</h2>

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
                    <th>Validity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($profiles as $profile): ?>
                <tr>
                    <th><a href="profile.php?id=<?php echo $profile->id ?>"><?php echo $profile->name ?></a> (<?php echo $profile->id ?>)</th>
                    <td><?php echo $profile->validity_duration ?></td>
                    <td><?php echo $profile->price ?> <?php echo $profile->devise ?></td>
                    <th><a href="profile.php?id=<?php echo $profile->id ?>">Details</a></th>
                </tr>
                <?php endforeach ?>
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