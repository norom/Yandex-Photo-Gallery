var parseAlbums = function(albumsData) {
    if (typeof albumsData !== 'object') $('#loading-info').html('Ошибка при загрузке информации об альбомах пользователя!');
    else {
        $(document).trigger('fotker.parseAlbums', [albumsData]);
    }
};