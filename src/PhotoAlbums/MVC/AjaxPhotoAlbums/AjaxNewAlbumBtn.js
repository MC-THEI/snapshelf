$(".newAlbumBtn").on("click", function (event) {
    event.preventDefault();

    console.log()

    $.ajax({
        url: "/Snapshelf/albums-newAlbum",
        type: "POST",
        data: {
            userId: $(this).data("userid"),
            albumName: $(this).data("albumname"),
            albumDescription: $(this).data("albumdescription")
        }
    }).done(function (data) {
        $('#relPhotoAlbums').html(data);
    }).fail(function () {
        alert("Fehler");
    })
});