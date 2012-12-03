Mobibase VOD Service PHP wrapper V1
===================================

Getting started
---------------

Include the client class.

    include "mobibase/MobibaseVodClient.php";

Instanciate the client class with your Mobibase VOD API key.

    $client = new MobibaseVodClient($api_key);

Methods
-------

### getPackages()

Returns the list of all available packages in the service defined by the API key.

    $service = $client->getPackages();

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getPackages();

    $packages = $service->response->packages; // array of package objects

### getPackages( [ {OPTIONS} ] )

Order parameters can be passed as options.

    $service = $client->getPackages(array(
        'orderby'  => 'name:asc',
    ));

Order can be set on:

- id
- name
- content (number on content)

The sorting direction is apply after the field name.

- :asc
- :desc

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

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getPackages(array('limit' => 5));

    $packages = $service->response->packages; // array of 5 package objects

### getPackage( {PACKAGE_ID} )

Returns a specific package information and the list of videos attached.

    $service = $client->getPackage($package_id);

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getPackage($package_id);

    $package = $service->response->package; // package object

### getPackage( {PACKAGE_ID} [, {OPTIONS} ] )

Pagination parameters can be passed as options.

    $service = $client->getPackage($package_id, array(
        'page'    => 2,
        'perpage' => 5
    ));

Offset parameters can be passed as options.

    $service = $client->getPackage($package_id, array(
        'limit'    => 5,
        'offset'   => 5
    ));

**Note:** page/perpage and limit/offset can't be used in the same request.

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getPackage($package_id, array('limit' => 5));

    $package = $service->response->package; // package object with 5 videos

### getVideos()

Returns the list of all available videos in the service defined by the API key.

    $service = $client->getVideos();

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getVideos();

    $videos = $service->response->videos; // array of video objects

### getVideos( [ {OPTIONS} ] )

Order parameters can be passed as options.

    $service = $client->getVideos(array(
        'orderby'  => 'name:asc',
    ));

Order can be set on:

- id
- name
- duration
- package.id
- package.date

The sorting direction is apply after the field name.

- :asc
- :desc

Some extra parameters are allowed for videos, a periodical ramdon order can be set.

- random (every call)
- hourly
- daily
- monthly
- yearly

    $service = $client->getVideos(array(
        'orderby'  => 'monthly:asc',
    ));

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

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getVideos(array('limit' => 5));

    $videos = $service->response->videos; // array of 5 video objects

### getVideo( {VIDEO_ID} [, {NETWORK} ] )

Returns a specific video information. 

If a Network (EDGE, UMTS, HSDPA, WIFI) is defined, the response returns the right streaming URL for the device.

    $service = $client->getVideo($video_id);

Or to get the streaming URL.

    $service = $client->getVideo($video_id, $network);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->geVideo($video_id);

    $video = $service->response->video; // video object

Request with a network defined to get a stream URL for the current device.

    $client = new MobibaseVodClient($api_key);

    $service = $client->geVideo($video_id, 'wifi');

    $video = $service->response->video; // video object
    $sream = $service->response->sream; // stream object

### setUserAgent( {USER_AGENT} )

Overides User Agent of the current device for the further requests.

    $service = $client->setUserAgent($_SERVER['HTTP_USER_AGENT']);

### isDeviceCompatible( [ USER_AGENT ] )

Returns information about the streaming compatibility of a device.

By defaut the SDK runs the compatibility check with the current device, excepted if another one has been set by setUserAgent(). 
Another User Agent can be given to check compatibility of a different device.

    $service = $client->isDeviceCompatible($_SERVER['HTTP_USER_AGENT']);

### getLastRequest()

Returns the last request sent to the service.

    $request = $client->getLastRequest();

### getLastResponse()

Return the last response sent by the service.

    $response = $client->getLastResponse();

Full example
------------

Best practice for error management.

    try {
        $client = new MobibaseVodClient($api_key);

        $service = $client->getVideos();

        if ($service->status == 'OK') {
            $videos = $service->response->videos;
        } else {
            die($service->response->error->message);
        }
    } catch(Exception $e) {
        die($e->getMessage());
    }