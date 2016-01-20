Mobibase VOD Service PHP wrapper V2
===================================

Getting started
---------------

Include the client class.

    include "mobibase/MobibaseVodClient.php";

Instanciate the client class with your Mobibase VOD API key.

    $client = new MobibaseVodClient($api_key);

Methods
-------

### enableCdn()

Enable CDN support.

### isDeviceCompatible( [ USER_AGENT ] )

Returns information about the streaming compatibility of a device.

By default the SDK runs the compatibility check with the current device, excepted if another one has been set by setUserAgent(). 
Another User Agent can be given to check compatibility of a different device.

    $client->isDeviceCompatible($_SERVER['HTTP_USER_AGENT']);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->isDeviceCompatible($_SERVER['HTTP_USER_AGENT']);

    $device = $service->response->device; // device object
    
    if ($device->compatible) {
        echo "This device is streaming compatible.";
    } else {
        echo "This device is NOT streaming compatible.";
    }

### getPackages()

Returns the list of all available packages in the service defined by the API key.

    $client->getPackages();

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

    $client->getPackage($package_id);

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

    $client->getVideos();

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

### getVideo( {VIDEO_ID} [, {TICKET}, {NETWORK} [, {USER_AGENT} ]] )

Returns a specific video information. 

If a valid user Ticket and a Network (EDGE, UMTS, HSDPA, WIFI) are defined, the response returns the right streaming URL for the device.

    $client->getVideo($video_id);

Or to get the streaming URL.

    $client->getVideo($video_id, $ticket, $network);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->getVideo($video_id);

    $video = $service->response->video; // video object

Request with a network defined to get a stream URL for the current device.

    $client = new MobibaseVodClient($api_key);

    $service = $client->getVideo($video_id, $ticket, 'wifi');

    $video = $service->response->video; // video object
    $sream = $service->response->sream; // stream object

### getTicketProfiles()

Returns the list of all available ticket profiles attached to the service defined by the API key.

    $client->getTicketProfiles();

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getTicketProfiles();

    $profiles = $service->response->profiles; // array of ticket profiles objects

### getTicketProfile( {TICKET_PROFILE_ID} )

Returns a specific Profile information.

    $client->getTicketProfile($ticket_profile_id);

#### Example

    $client = new MobibaseVodClient($api_key);

    $service = $client->getTicketProfile($ticket_profile_id);

    $profile = $service->response->profile; // ticket profile object

### createTicket( {TICKET_PROFILE_ID} )

Creates a new Ticket from a Ticket Profile ID

    $client->createTicket($ticket_profile_id);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->createTicket($ticket_profile_id);

    $ticket  = $service->response->ticket;  // ticket object
    $profile = $service->response->profile; // ticket profile object

### isTicketValid( {TICKET} )

Returns information about a ticket and its current validity.

    $client->isTicketValid($ticket);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->isTicketValid($ticket);

    $validity = $service->response->validity->status;

    if ($validity->status) {
        echo "This ticket is valid.";
    } else {
        echo "This ticket is NOT valid.";
    }

### invalidateTicket( {TICKET} )

Invalidate the current validity of a Ticket. 

    $client->invalidateTicket($ticket);

#### Examples

    $client = new MobibaseVodClient($api_key);

    $service = $client->invalidateTicket($ticket);

    $validity = $service->response->validity->status;

### setUserAgent( {USER_AGENT} )

Overides User Agent of the current device for the further requests.

    $client->setUserAgent($_SERVER['HTTP_USER_AGENT']);

### getUserAgent()

Returns the User Agent defined for all requests.

    $user_agent = $client->getUserAgent();

### getLastRequest()

Returns the last request sent to the service.

    $request = $client->getLastRequest();

### getLastPostedData()

Returns the last posted data to the service.

    $posted_data = $client->getLastPostedData();

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

