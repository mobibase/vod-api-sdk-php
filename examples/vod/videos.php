<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    try {
        $client = new MobibaseVodClient($settings['apikey']);
        $service = $client->getVideos(array(
            'page'    => $page,
            'perpage' => $settings['perpage'],
            'orderby' => 'hourly'
        ));

        if ($service->status == 'OK') {
            $videos = $service->response->videos;

            $pages = ceil($service->response->contents / $settings['perpage']);
        } else {
            $error = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "videos.html.php";