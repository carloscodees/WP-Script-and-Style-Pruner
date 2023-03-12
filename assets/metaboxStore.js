jQuery(document).ready(function($){
    console.log('load')
    $('.click-all').on('click', function(e) {
        $('.pe-items').css('display', 'table');
    });
    $('.click-scripts').on('click', function(e) {
        $('.pe-items').css('display', 'none');
        $('.items-scripts').css('display', 'table');
    });
    $('.click-styles').on('click', function(e) {
        $('.pe-items').css('display', 'none');
        $('.items-styles').css('display', 'table');
    });

}); 