<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $error = 'Video ID missing.';
    }

    try {
        $user_agent  = $_SERVER['HTTP_USER_AGENT'];
        $user_ticket = $settings['ticket'];

        $client = new MobibaseVodClient($settings['apikey']);

        $service = $client->getVideo($id, $user_ticket, 'WIFI', $user_agent);

        if ($service->status == 'OK') {
            $video  = $service->response->video;
            $stream = $service->response->stream;
        } else {
            $error  = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "video.html.php";