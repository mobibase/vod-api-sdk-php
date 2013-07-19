<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    try {
        $client = new MobibaseVodClient($settings['apikey']);
        $service = $client->getPackages();

        if ($service->status == 'OK') {
            $packages = $service->response->packages;
        } else {
            $error = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "packages.html.php";