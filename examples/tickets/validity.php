<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    if (isset($_GET['ticket'])) {
        $ticket_to_check = $_GET['ticket'];

        try {
            $client = new MobibaseVodClient($settings['apikey']);
            $service = $client->isTicketValid($ticket_to_check);

            if ($service->status == 'OK') {
                $validity = $service->response->validity;
            } else {
                $error = $service->response->error->message;
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $ticket_to_check = null;
    }

    include "validity.html.php";
