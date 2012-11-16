# Mobibase’s VOD Service PHP wrapper V1

## Getting started

Include the client class.

    include "mobibase/MobibaseVodClient.php";

Instanciate the client class with your Mobibase VOD API key.

    $client = new MobibaseVodClient($apikey);

## Methods

### getPackages()

Returns the list of all available packages in the service defined by the API key.

    $service = $client->getPackages();

### getPackages( [ {OPTIONS} ] )

Pagination parameters can be passed as options.

    $service = $client->getPackages(array(
        'page'    => 2,
        'perpage' => 5
    ));

Offset parameters can be passed as options.

    $service = $client->getPackages(array(
        'limit'    => 5,
        'offset'   => 5
    ));

**Note:** page/perpage and limit/offset can't be used in the same request.

### getPackage( {PACKAGE_ID} )

Returns a specific package information and the list of videos attached.

    $service = $client->getPackage({PACKAGE_ID});

### getPackage( {PACKAGE_ID} [, {OPTIONS} ] )

Pagination parameters can be passed as options.

    $service = $client->getPackage($id, array(
        'page'    => 2,
        'perpage' => 5
    ));

Offset parameters can be passed as options.

    $service = $client->getPackage($id, array(
        'limit'    => 5,
        'offset'   => 5
    ));

**Note:** page/perpage and limit/offset can't be used in the same request.

### getVideos()

Returns the list of all available videos in the service defined by the API key.

    $service = $client->getVideos();

### getVideos( [ {OPTIONS} ] )

Pagination parameters can be passed as options.

    $service = $client->getVideos(array(
        'page'    => 2,
        'perpage' => 5
    ));

Offset parameters can be passed as options.

    $service = $client->getVideos(array(
        'limit'    => 5,
        'offset'   => 5
    ));

**Note:** page/perpage and limit/offset can't be used in the same request.

### getVideo( {VIDEO_ID} [, {NETWORK} ] )

Returns a specific video information. 

If a Network (EDGE, UMTS, HSDPA, WIFI) is defined, the response returns the right streaming URL for the device.

    $service = $client->getVideo($id);

Or to get the streaming URL.

    $service = $client->getVideo($id, $network, $_SERVER['HTTP_USER_AGENT']);

### setUserAgent( {USER_AGENT} )

Overides User Agent of the current device for the further requests.

    $service = $client->setUserAgent($_SERVER['HTTP_USER_AGENT']);

### isDeviceCompatible( [ USER_AGENT ] )

Returns information about the streaming compatibility of a device.

By defaut the SDK runs the compatibility check with the current device, excepted if another one has been set by setUserAgent(). 
Another User Agent can be given to check compatibility of a different device.

    $service = $client->isDeviceCompatible($_SERVER['HTTP_USER_AGENT']);

## Full example

Best practice.

    include "VodClient.php";

    $client = new MobibaseVodClient($apikey);

    $service = $client->getVideos();

    if ($service->status == 'OK') {
        $videos = $service->response->videos;
    } else {
        die($service->response->error->message);
    }

