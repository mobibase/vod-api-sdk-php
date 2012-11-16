<?php
    include_once "settings.php";
    include_once "../mobibase/MobibaseVodClient.php";

    try {
        $client = new MobibaseVodClient($settings['apikey']);

        $service = $client->isDeviceCompatible();

        if ($service->status == 'OK') {
            $device = $service->response->device;
        } else {
            $error  = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "device.html.php";