function activateNavItemWhenReady(itemId) {
    $(function () {
        $('#' + itemId).addClass('active');
    });
}
