<html>
<head>
  <meta charset="utf-8">
  <title>Directly accessing Street View data</title>
  <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/desktop.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../tweetLinkIt/tweetLinkIt/tweetLinkIt.js"></script>
</body>
</html>

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2863190572-bvGkH5ccC47SLfWjrcAUD1eqKlKG2hwqYD6b4PO",
    'oauth_access_token_secret' => "31MLofp484MV5g3fcTxFFlp7dD5SQrhEWMAQe38PJyyNF",
    'consumer_key' => "i9xh013dvDlcMZmwew2O2Ga5X",
    'consumer_secret' => "2GS4kyRVerNsPC3XzqMj0OAFN4RA18q34CPbSsbjFovApBx7j2"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
//$twitter = new TwitterAPIExchange($settings);
//echo $twitter->buildOauth($url, $requestMethod)
  //           ->setPostfields($postfields)
    //         ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23venicebiennale';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$tweetData = json_decode($twitter->setGetfield($getfield)
              ->buildOauth($url, $requestMethod)
              ->performRequest(), $assoc = TRUE);


foreach($tweetData ['statuses'] as $items)
{
  $entitiesArray = $items ['entities'];


echo "<div class='name'>" .$items['user']['profile_image']. "</div>";
echo "<div class='name'>". $items['user']['name']."</div> <div class='screen-name'> @". $items['user']['screen_name']."</div>";
 echo "</br>";
 echo " <div class='twitter-tweet'>" . $items['text'] . "</div> ";
 echo "<div class='where'" . $items['created_at'] . "</div>";
  echo "</br>";

//   echo "Tweet: " . $items['text'] . "</br>";
  //echo "When: " . $items['created_at'] . "</br>";
   //echo "Where: " . $items['created_at'] . "</br>";


  if (isset($entitiesArray['media'])) {

    $mediaArray = $entitiesArray['media'];
    $tweetMedia = $mediaArray [0];
    echo "<a target='_blank' href=' " . $tweetMedia['expanded_url'] . "'><img target='_blank' src='" . $tweetMedia ['media_url'] . "'></a>";
  }

}


?>

<html>
<script>
$('.tweet').tweetLinkify();

    function pageComplete(){
        $('.tweet').tweetLinkify();
    }
</script>
</html>
<?php


//echo $twitter->setGetfield($getfield)
//             ->buildOauth($url, $requestMethod)
    //         ->performRequest();
