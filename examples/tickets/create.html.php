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

        <h2>Create a Ticket</h2>

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
            <form action="create.php" method="post">
                <select name="ticket_profile_id">
                <?php foreach($available_profiles as $available_profile) : ?>
                    <option value="<?php echo $available_profile->id ?>"><?php echo $available_profile->name ?></option>
                <?php endforeach ?>
                </select>
                <input type="text" name="tracking_id" placeholder="Enter a tracking ID..." value="<?php echo $tracking_id ?>">
                <input type="submit" value="Create">
            </form>

            <?php if (isset($ticket)) : ?>
                <h3>New Ticket</h3>
                <table>
                    <tr>
                        <th>Ticket</th>
                        <td><?php echo $ticket->id ?></td>
                    </tr>
                    <tr>
                        <th>Tracking Id</th>
                        <td><?php echo $ticket->tracking_id ?></td>
                    </tr>
                </table>

                <h3>Profile</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $profile->name ?></td>
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
        <?php endif ?>

        <!-- Display response -->
        <?php if ($settings['trace'] && isset($service) && isset($ticket)) : ?>
        <div id="trace">
            <a id="toggle-debug" href="#">Show trace</a>
            <div>
                <h4>POST</h4>
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