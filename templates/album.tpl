{include file="includes/header.tpl"}

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

{include file="includes/footer.tpl"}