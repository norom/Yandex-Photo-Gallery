{include file="includes/header.tpl" customtitle="альбомы пользователя `$username`"}
{include file="includes/load.tpl"}

<div id="albums-list" class="hidden"></div>

<script id="album-template" type="text/html">
    {literal}
    <a class="album" href="${href}"><div class="title">${linktitle}</div><img src="${albumpreview}"/></a>
    {/literal}
</script>

<script type="text/javascript">
    var username = "{$username}";
    var timeoutTimeout;

    $(function() {
        timeoutTimeout = setTimeout(function() {
            $('#loading-info').html('Ошибка при загрузке информации о пользователе! Неверное имя пользователя или таймаут соединения.');
        }, 6789);

        $.ajax({
            url: 'http://api-fotki.yandex.ru/api/users/'+username+'/albums/?format=json&callback=parseAlbums',
            dataType: 'script'
        });

        $(document).bind('fotker.parseAlbums', function(junk, albumsData) {
            var albumsList = $('#albums-list');
            var albumTemplate = $('#album-template');

            for (var albumInternalId in albumsData.entries) {
                var album = albumsData.entries[albumInternalId];
                var albumId = album.id.split(':').pop();
                var albumImg = (typeof album.img == 'undefined') ? '' : ((typeof album.img.S == 'undefined') ? '' : album.img.S.href);

                // if (album.protected) albumImg = '/img/lock.png';
                if (!album.protected && album.imageCount > 0) albumsList.append(albumTemplate.tmpl({ href: '/u/'+username+'/'+albumId, linktitle: album.title, albumpreview: albumImg }));

            }

            $('#loading-info').hide();
            albumsList.show();
        });

    });

    var parseAlbums = function(albumsData) {
        clearTimeout(timeoutTimeout);

        if (typeof albumsData !== 'object') $('#loading-info').html('Ошибка при загрузке информации об альбомах пользователя!');
        else {
            $(document).trigger('fotker.parseAlbums', [albumsData]);
        }
    };

</script>

{include file="includes/footer.tpl"}