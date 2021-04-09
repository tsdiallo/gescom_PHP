$(".link-load").on("click", function() {
    var url = $(this).data("link");
    $("#div-content").empty().load(url);
});