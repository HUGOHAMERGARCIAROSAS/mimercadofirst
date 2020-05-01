$('ul.pagination').hide();
$('.infinite-scroll').jscroll({
    autoTrigger: true,
    loadingHtml: '<div class="d-flex justify-content-center"><div class="loader"></div></div>',
    padding: 0,
    nextSelector: '.pagination li.active + li a',
    contentSelector: 'div.infinite-scroll',
    callback: function () {
        $('ul.pagination').remove();
    }
});
