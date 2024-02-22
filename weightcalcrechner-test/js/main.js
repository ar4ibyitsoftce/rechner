function removeBlk(elem){
    let blk = $(elem).parent().parent().parent();

    blk.remove();
}
$(function(){
    function changeUnitVals(type){
        $('.js-material').each(function (k,block){
            let selects = $(block).find('option');
            selects.each(function (k,select) {
                let elem = $(select);

                if(elem.data('type') === type){
                    $(elem).removeClass('d-none');
                } else {
                    $(elem).addClass('d-none');
                }
            })
        });
    }

    function changeUnitNames(type){
        $('.js-mm-inch').each(function (k,elem) {
            (type === 'metric') ? $(elem).html('mm') : $(elem).html('inch');
        });

        $('.js-m3-gal').each(function (k,elem) {
            (type === 'metric') ? $(elem).html('kg/m³') : $(elem).html('lb/gal');
        });

        $('.js-kg-lb').each(function (k,elem) {
            (type === 'metric') ? $(elem).html('kg') : $(elem).html('lb.');
        });

        $('.js-input-field').each(function (k,elem) {
            let newText = (type === 'metric') ? $(elem).data('place-metric') : $(elem).data('place-imperial');
            $(elem).attr('placeholder', newText)
        });
    }

    $('.js-material').change(function (){
        let select = $(this).find(":selected");

        let size = select.data('density');
        let parentBlk = $(this).parent().parent().parent().find('.js-density');

        parentBlk.val(size);
    });

    $('.js-unit').change(function (){
        let unit = $(this).val();

        if(unit === 'metric'){
            changeUnitVals('metric');
            changeUnitNames('metric');
        } else {
            changeUnitVals('imperial');
            changeUnitNames('imperial');
        }
    })

    $('#add-row-btn').click(function () {
        let templ = $('#platte-template').children();

        let clonedTmpl = templ.clone();


        $('#form-blk').append(clonedTmpl);

    });


});
