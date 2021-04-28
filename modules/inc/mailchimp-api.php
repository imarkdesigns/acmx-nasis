<?php

// Get Link ID from Mailchimp
$linkID = $_GET['lid'];

############################
## Connections to Mailchimp
############################

// NASIS Account
$apiKey     = '';
$list_id    = 'c7ece447b9';

// Test Account (disable if not using)
// $apiKey     = '';
// $list_id    = '530a1942ca';

$dc         = substr($apiKey, strpos( $apiKey, "-" )+1);
$args       = [  
    'headers' => [ 
        'Authorization' => 'Basic ' . base64_encode( 'user:' . $apiKey )
    ]
];


// Get Permalink of the page + Mailchimp parameter
// $permalink = get_permalink() . '?lid=*|HTML:LINKID|*';
if ( ! empty($_GET['cl']) ) {
	
	$permalink = 'https://www.nasinvestmentsolutions.com/property/'.$_GET['cl'].'?lid=*|HTML:LINKID|*';

} else {
	
	$permalink = get_permalink() . '?lid=*|HTML:LINKID|*';
    // $permalink = 'https://nasis.sb:8890/property/walgreens-burlington-vermont?lid=*|HTML:LINKID|*';
	
}

// Check if LinkID is true
if ( $linkID ) {

	// Get Campaign Title from Investment Admin
	$campaignTitle = get_field('campaign_title');
	if ( $campaignTitle ) {
		
		$campaignTitle = get_field('campaign_title');
		
	} else {
		
		$campaignTitle = $_GET['ct'];
		$campaignTitle = str_replace("-", " ", $campaignTitle);
		
	}

    ### GET TO KNOW THE VISITOR
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( wp_remote_retrieve_response_code( $request ) == 200 ) {
        foreach ( $body->members as $member ) {

            if ( $member->unique_email_id != $linkID )
                continue;

            // If found, get email address 
            $email = $member->email_address;

            // Convert email to HASH
            $subscriber_hash = md5($email);

            // Check if the user OPEN the campaign
            $status = $member->stats->avg_open_rate;

        }
    }

    // If user match, check if user open a campaign else bail it
    if ( ! $status ) {
        return false;
    }

    ### GET THE CAMPAIGN ID
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/reports?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( $campaignTitle ) {
        foreach ( $body->reports as $report ) {

            if ( $report->campaign_title != $campaignTitle )
                continue;

            // Get the ID
            $campaign_id = $report->id;

        }
    } else {

        // Halt fetching the records
        return false;

    }

    ### GET USER ACTIVITY USING HASHED EMAIL & CAMPAIGN ID
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members/'. $subscriber_hash .'/activity?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( wp_remote_retrieve_response_code( $request ) == 200 ) {
        foreach ( $body->activity as $action ) {

            if ( $action->campaign_id != $campaign_id )
                continue;

            if ( $action->action === 'click' ) {
                $urls[] = $action->url;
            }

        }

        foreach ( $urls as $url ) {
        
            $url        = explode('?', $url);
            $clicks[]   = $url[0];

            $clicks     = array_flip($clicks);
            $clicks     = array_flip($clicks);
            $clicks     = array_values($clicks);
        
        }

        // Collect all URLS that have been clicked by the user
        $clickedURLs = implode(', ', $clicks);
    }

    ### GET CAMPAIGN LINK-ID
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/reports/'. $campaign_id .'/click-details?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( wp_remote_retrieve_response_code( $request ) == 200 ) {
        foreach ( $body->urls_clicked as $clicked ) {

            if ( $clicked->url != $permalink )
                continue;

            $link_id = $clicked->id;

        }
    }

    ### GET TOTAL CLICKS TO CAMPAIGN LANDING PAGE
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/reports/'. $campaign_id .'/click-details/'. $link_id .'/members/'. $subscriber_hash .'?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( wp_remote_retrieve_response_code( $request ) == 200 ) {
        $totalClicks = $body->clicks;
    }

    ### GET TOTAL OPEN TO EMAIL CAMPAIGN
    $request = wp_remote_get( 'https://'. $dc .'.api.mailchimp.com/3.0/reports/'. $campaign_id .'/open-details/'. $subscriber_hash .'?count=1000', $args );
    $body = json_decode( wp_remote_retrieve_body( $request ) );

    if ( wp_remote_retrieve_response_code( $request ) == 200 ) {
        $totalOpens = $body->opens_count;

        if ( empty( $totalOpens ) ) {
            $totalOpens = 0;
        }
    }

} // end $linkID

