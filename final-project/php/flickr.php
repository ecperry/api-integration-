<?php
//Function: Get flickr media and display based on user id
function getFlickrPhotos($id, $limit=9) {
    require_once("phpFlickr/phpFlickr.php");
    $f = new phpFlickr("Your-Api-Key");
    $photos = $f->people_getPublicPhotos($id, NULL, NULL, 12);
    $return.='<ul class="flickrPhotos">';
    foreach ($photos['photos']['photo'] as $photo) {
        $return.='<li><a href="' . $f->buildPhotoURL($photo, 'medium') . '" title="' . $photo['title'] . '"><img src="' . $f->buildPhotoURL($photo, 'square') . '" alt="' . $photo['title'] . '" title="' . $photo['title'] . '" /></a></li>';
    }
    echo $return.='</ul>';
} ?>
<?php getFlickrPhotos('flickrUserID',6); ?>
