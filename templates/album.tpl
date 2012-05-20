<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Aldeke.in &mdash; фотографии</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="{$siteurl}css/general.css" type="text/css" media="screen" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="/js/galleria-1.2.6.js"></script>
        <script src="/js/galleria.history.min.js"></script>
	</head>
<body>

<div id="loading-info">
    Загрузка...<br>
    <img src="/img/loading.gif" alt="Loading..." width="220" height="19">
    <div id="loading-info-more"></div>
</div>

<div id="galleria" class="hidden"></div>

<script>
    var previewSize = 'M';
    var pageTitle = 'Aldeke.in — фотографии';

    var albumId = {$albumid};
    var galleria;
    $(function() {
        // init
        galleria = $('#galleria');
        $.get('http://api-fotki.yandex.ru/api/users/aldekein/album/'+albumId+'/?format=json&callback=parseAlbum', function () { }, 'script')
    });

    var parseAlbum = function(albumData) {
        if (typeof albumData !== 'object') $('#loading-info').html('Ошибка при загрузке информации об альбоме!');
        else {
            $('#loading-info-more').html(albumData.imageCount + ' фотографий');

            $.get('http://api-fotki.yandex.ru/api/users/aldekein/album/'+albumId+'/photos/?format=json&callback=parsePhotos', function () { }, 'script')
        }

        // console.log(albumData);
    };

    var parsePhotos = function(photosData) {
        if (typeof photosData !== 'object') $('#loading-info').html('Ошибка при загрузке информации о фотографиях!');
        else {
            var imgData, imgDataOriginal, imgDataBig;
            // console.log(photosData);
            document.title = pageTitle + ' — ' + photosData.title;

            for (var i = 0; i < photosData.imageCount; i++) {
                imgData = photosData.entries[i].img[previewSize];
                if (typeof photosData.entries[i].img.XXXL != 'undefined') {
                    // some really small photos does not have these sizes at all
                    imgDataBig = photosData.entries[i].img.XXXL;
                    imgDataOriginal = photosData.entries[i].img.XXL;
                }
                else {
                    imgDataBig = imgData;
                    imgDataOriginal = imgData;
                }

                galleria.append('<a href="'+imgDataBig.href+'"><img ' +
                        'src="'+imgData.href+'" ' +
                        'width="'+imgData.width+'" ' +
                        'height="'+imgData.height+'" ' +
                        'alt="'+photosData.entries[i].title+'" ' +
//                        'data-big="'+imgDataOriginal.href+'" ' +   // you can uncomment this if you have descriptive titles in yandex albums
                        '></a>');
            }
        }

        $('#loading-info').hide();
        // Galleria.loadTheme('/galleria/themes/classic/galleria.classic.min.js');
        // Galleria.loadTheme('/galleria/themes/twelve/galleria.twelve.min.js');
        // read http://galleria.io/docs/getting_started/quick_start/ for customizing for our best experience

        Galleria.loadTheme('/galleria-themes/folio/galleria.folio.min.js');
        galleria.galleria().show();
    };

</script>

</body>
</html>