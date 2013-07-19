<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    if (isset($_GET['id'])) {
        $profile_id = $_GET['id'];

        try {
            $client = new MobibaseVodClient($settings['apikey']);
            $service = $client->getTicketProfile($profile_id);

            if ($service->status == 'OK') {
                $profile = $service->response->profile;
            } else {
                $error = $service->response->error->message;
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = 'Ticket Profile ID missing.';
    }

    include "profile.html.php";
