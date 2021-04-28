<?php 

// $linkedID = '6db5b486ce'; // Test Link ID of mark@ohwowmarketing.com
$linkedID = $_GET['lid'];

// $api_key = '';
$api_key = '';
// $list_id = '478547c406';
$list_id = '530a1942ca';

// $camp_id = '5bc27b6a8e';
// $link_id = '2f976e53b0';

$campaign_title = 'Sample Campaign v2';

$dc = substr($api_key,strpos($api_key,'-')+1);
$args = array(
    'headers' => array(
        'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
    )
);

if ( $linkedID ) :

##### GET TO KNOW THE CAMPAIGN VISITOR
$memberID = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/', $args );
$body = json_decode( wp_remote_retrieve_body( $memberID ) );
// $emails = array();

if ( wp_remote_retrieve_response_code( $memberID ) == 200 ) {
    foreach ( $body->members as $member ) {

        if( $member->unique_email_id != $linkedID )
            continue;

        // Retrieve user email address & pass to next function
        $user_email  = $member->email_address;

        // Retrieve user average open
        $user_open[] = $member->stats;

    }
}

echo '<p> Email: ' . $user_email . '</p>';
echo '<p> Open Campaign: ' . $user_open[0]->avg_open_rate . '</p>';


##### GET THE CAMPAIGN ID
$campaignID = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/reports', $args );
$body = json_decode( wp_remote_retrieve_body( $campaignID ) );

// echo '<pre>'; print_r($body); echo '</pre>';

if ( $body->reports[0]->campaign_title == $campaign_title ) {

    // Get the ID
    $camp_id = $body->reports[0]->id;

}

echo '<p> Campaign Title: '.$campaign_title.' </p>';
echo '<p> Campaign ID: ' . $camp_id . ' <small class="uk-text-muted">(campaign id of the current campaign title)</small> </p>';


##### GET THE VISITOR ACTIVITY AND THROW THE CAMPAIGN ID LINKED TO IT
// Encrypt User Email
$subscriber_hash = md5($user_email);

$activityDetails = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/'.$subscriber_hash.'/activity', $args );
$body = json_decode( wp_remote_retrieve_body( $activityDetails ) );
// $activities = array();

foreach ( $body->activity as $act ) {
    if ( $act->campaign_id == $camp_id ) {
        if ( $act->action == 'click' ) {
            $urls[] = $act->url;
        }
    }
}

foreach ( $urls as $url ) {
    $url = explode("?", $url);
    $feedURLs[] = $url[0];

    $feedURLs  = array_flip($feedURLs); 
    $feedURLs  = array_flip($feedURLs);
    $feedURLs = array_values($feedURLs); 
}

$feedURLlist = implode(', ', $feedURLs);

echo '<p> Feed URLs: <br /> '. $feedURLlist .' </p>' ;

    ##### GET THE CAMPAIGN LINK ID
$urlClicked = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/reports/'.$camp_id.'/click-details', $args );
$body = json_decode( wp_remote_retrieve_body( $urlClicked ) );

    $link_url = $body->urls_clicked[0]->url;
    $link_url = explode("?", $link_url);
    $link_url = $link_url[0];
    $link_id  = $body->urls_clicked[0]->id;

    ##### MATCH THE VISITOR ID FROM CAMPAIGN AND FETCH TOTAL CLICKS
    $clickDetails = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/reports/'.$camp_id.'/click-details/'.$link_id.'/members/'.$subscriber_hash.'', $args );
    $body = json_decode( wp_remote_retrieve_body( $clickDetails ) );

    // echo '<pre>'; print_r($body); echo '</pre>';

    if ( $link_id === $body->url_id ) {
        $totalClicks = $body->clicks;
    }

    // if ( wp_remote_retrieve_response_code( $clickDetails ) == 200 ) {
    //     foreach ( $body->members as $member ) {

    //         if( $member->email_address != $user_email )
    //             continue;

    //         // Retrieve total clicks
    //         $totalClicks = $member->clicks;

    //     }
    // }

    echo '<p> Total Clicks: ' . $totalClicks . '</p>';

    ##### MATCH THE VISITOR ID FROM CAMPAIGN AND FETCH TOTAL OPENS
$openDetails = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/reports/'.$camp_id.'/open-details/'.$subscriber_hash.'', $args );
$body = json_decode( wp_remote_retrieve_body( $openDetails ) );

    // Retrieve total clicks
    $totalOpens = $body->opens_count;

    if ( empty( $totalOpens ) ) {
        $totalOpens = 0;
    }


    echo '<p> Total Opens: ' . $totalOpens . '</p>';

endif;