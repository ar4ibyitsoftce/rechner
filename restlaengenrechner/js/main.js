$(function(){
    $('.form-control').on('input', function(){
        let blk = $(this).parent();

        let errBlocks = blk.find('.ci-form-error');

        errBlocks.each(function(k, elem) {
            $(elem).addClass('d-none');
        });
    })
})