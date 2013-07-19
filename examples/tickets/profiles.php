<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    try {
        $client = new MobibaseVodClient($settings['apikey']);
        $service = $client->getTicketProfiles();

        if ($service->status == 'OK') {
            $profiles = $service->response->profiles;
        } else {
            $error = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "profiles.html.php";