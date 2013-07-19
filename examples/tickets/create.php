<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    try {
        $client = new MobibaseVodClient($settings['apikey']);
        $service = $client->getTicketProfiles();

        if ($service->status == 'OK') {
            $available_profiles = $service->response->profiles;
        } else {
            $error = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    if (isset($_POST['ticket_profile_id'])) {
        $ticket_profile_id = $_POST['ticket_profile_id'];
        $tracking_id       = $_POST['tracking_id'];

        try {
            $client = new MobibaseVodClient($settings['apikey']);
            $service = $client->createTicket($ticket_profile_id, $tracking_id);

            if ($service->status == 'OK') {
                $ticket  = $service->response->ticket;
                $profile = $service->response->profile;
            } else {
                $error = $service->response->error->message;
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $ticket_profile_id = $tracking_id = null;
    }

    include "create.html.php";
