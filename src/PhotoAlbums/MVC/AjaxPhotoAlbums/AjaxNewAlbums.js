$("#newAlbumForm").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
        url: "/Snapshelf/albums-newAlbum",
        type: "POST",
        data: $(this).serialize(),

    }).done(function (data) {
       $('#relPhotoAlbums').html(data);
    }).fail(function () {
        alert("Fehler");
    })
});