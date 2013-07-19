<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    if (isset($_POST['ticket'])) {
        $ticket_to_invalidate = $_POST['ticket'];

        try {
            $client = new MobibaseVodClient($settings['apikey']);
            $service = $client->invalidateTicket($ticket_to_invalidate);

            if ($service->status == 'OK') {
                $validity = $service->response->validity;
            } else {
                $error = $service->response->error->message;
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $ticket_to_invalidate = null;
    }
    
    include "invalidate.html.php";
