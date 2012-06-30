{include file="includes/header.tpl" customtitle="альбомы пользователя `$username`"}
{include file="includes/load.tpl"}

<div id="albums-list" class="hidden"></div>

<script id="album-template" type="text/html">
    {literal}
    <a class="album" href="${href}">${linktitle}<img src="${albumpreview}"/></a>
    {/literal}
</script>

<script type="text/javascript">
    var username = "{$username}";

    $(function() {
        // init

        $.ajax({
            url: 'http://api-fotki.yandex.ru/api/users/'+username+'/albums/?format=json&callback=parseAlbums',
            error: function(XMLHttpRequest, textStatus, errorThrown) { alert('not found'); },
            dataType: 'script',
            statusCode: {
                404: function() {
                    alert("user not found");
                }
            }
        }).fail(function() { alert("error"); });

        // all of these ^^^^^^^^^^^ fails fail! FUCK! how to catch 404?!
        // maybe we should use setTimeout and reset timeout on success



        $(document).bind('fotker.parseAlbums', function(junk, albumsData) {
            console.log(albumsData);
            var albumsList = $('#albums-list');
            var albumTemplate = $('#album-template');

            for (var albumInternalId in albumsData.entries) {
                var album = albumsData.entries[albumInternalId];
                var albumId = album.id.split(':').pop();
                var albumImg = (typeof album.img == 'undefined') ? '' : album.img.S.href;
                // var link = $("<a/>").html(album.title).attr('href', '/u/'+username+'/'+albumId);

                albumsList.append(albumTemplate.tmpl({ href: '/u/'+username+'/'+albumId, linktitle: album.title, albumpreview: albumImg }));

            }

            $('#loading-info').hide();
            albumsList.show();
        });

    });
</script>

{include file="includes/footer.tpl"}