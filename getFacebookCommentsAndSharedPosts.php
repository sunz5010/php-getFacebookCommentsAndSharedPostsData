<?php
	class getFacebookCommentsAndSharedPosts
	{
		public static function getData($fbid, $api, $access_token)
		{
			switch ($api) {
				case "comments":
				case "sharedposts":
					break;
				default:
					return false;
			}

			//initial 
			$tempURL = "https://graph.facebook.com/v2.0/".$fbid."/".$api."?limit=200&&method=GET&format=json&suppress_http_code=1&access_token=".$access_token;
			$tempData = array();

			//Start get data
			while(1)
			{
				//Prepare CURL
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, $tempURL); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
				$result = curl_exec($ch); 
				curl_close($ch); 

				//Decode json data
				$result = json_decode($result, true);

				//Merge Data
				$tempData = array_merge($tempData, $result["data"]);

				//set next url if exist
				if(!$result["paging"]["next"])
				{
					break;
				}
				else
				{
					$tempURL = $result["paging"]["next"];
				}
			}

			return $tempData;
		}
	}

	//use case
	if(0)
	{
		$fbid = "here is fbid";
		$api = "comments"; //comments or sharedposts
		$access_token = "here is access token";

		$result = getFacebookCommentsAndSharedPosts::getData($fbid, $api, $access_token);
		echo "total ".count($result)." datas\r\n";
	}
?>