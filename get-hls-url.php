<?php
$channelid = $_REQUEST['id'];
ini_set("user_agent", "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_USERAGENT, "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
  curl_setopt($ch, CURLOPT_REFERER, "http://facebook.com");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$urlVideoDetails = "https://www.youtube.com/get_video_info?video_id=" . $channelid . "&el=detailpage";
$returnedData = get_data($urlVideoDetails);
parse_str($returnedData, $query);
$player_response = json_decode($query['player_response'], true);
$downloadUrl = $player_response['streamingData']['hlsManifestUrl'];
header("Location: $downloadUrl");
?>