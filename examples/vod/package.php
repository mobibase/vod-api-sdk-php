<?php
    include_once "../settings.php";
    include_once "../../mobibase/MobibaseVodClient.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        try {
            $client = new MobibaseVodClient($settings['apikey']);
            $service = $client->getPackage($id, array(
                'page'    => $page,
                'perpage' => $settings['perpage']
            ));

            if ($service->status == 'OK') {
                $package = $service->response->package;

                $pages = ceil($package->contents / $settings['perpage']);
            } else {
                $error = $service->response->error->message;
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = 'Package ID missing.';
    }

    include "package.html.php";