<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    try {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $client = new MobibaseVodClient($settings['apikey']);

        $service = $client->isDeviceCompatible($user_agent);

        if ($service->status == 'OK') {
            $device = $service->response->device;
        } else {
            $error  = $service->response->error->message;
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
    }

    include "device.html.php";
