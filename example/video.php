<?php
    include_once "settings.php";
    include_once "../mobibase/MobibaseVodClient.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $error = 'Video ID missing.';
    }

    try {
        $client = new MobibaseVodClient($settings['apikey']);

        $service = $client->getVideo($id, 'WIFI');

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