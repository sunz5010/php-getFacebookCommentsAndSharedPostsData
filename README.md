php-getFacebookCommentsAndSharedPostsData
=========================================

Using PHP get Facebook Comments and SharedPosts Data

usage

<?php
  $fbid = "here is fbid";
	$api = "comments"; //comments or sharedposts
	$access_token = "here is access token";

	$result = getFacebookCommentsAndSharedPosts::getData($fbid, $api, $access_token);
	echo "total ".count($result)." datas\r\n";
?>
