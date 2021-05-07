<?php
/*
Plugin Name: DISABLE FEED AND REST API
Description: Disable feeds and redirect to home and disables REST API(wp-json)
Wordpress Version: 5.7.1
Version: 0.1
Author: Teddy
*/
function disable_feeds() {
	wp_redirect( home_url() );
	die;
}

// Disable global RSS, RDF & Atom feeds.
add_action( 'do_feed',      'disable_feeds', -1 );
add_action( 'do_feed_rdf',  'disable_feeds', -1 );
add_action( 'do_feed_rss',  'disable_feeds', -1 );
add_action( 'do_feed_rss2', 'disable_feeds', -1 );
add_action( 'do_feed_atom', 'disable_feeds', -1 );

// Disable comment feeds.
add_action( 'do_feed_rss2_comments', 'disable_feeds', -1 );
add_action( 'do_feed_atom_comments', 'disable_feeds', -1 );

// Prevent feed links from being inserted in the <head> of the page.
add_action( 'feed_links_show_posts_feed',    '__return_false', -1 );
add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
remove_action( 'wp_head', 'feed_links',       2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Disable REST API
remove_action( 'rest_api_init', 'create_initial_rest_routes', 99 );
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove the REST API lines from the HTML Header
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
