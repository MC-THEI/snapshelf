$("#updateAlbumForm").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
        url: "/Snapshelf/albums-updateAlbum",
        type: "POST",
        data: $(this).serialize(),

    }).done(function (data) {
        $('#relPhotoAlbums').html(data);
    }).fail(function () {
        alert("Fehler");
    })
});