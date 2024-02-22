

function changeMaterial(elem){
    let select = $(elem).find(":selected");

    let size = select.data('density');
    let parentBlk = $(elem).parent().parent().parent().find('.js-density');

    parentBlk.val(size);
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

    // function changeUnitNames(type){
    //     $('.js-mm-inch').each(function (k,elem) {
    //         (type === 'metric') ? $(elem).html('mm') : $(elem).html('inch');
    //     });

    //     $('.js-m3-gal').each(function (k,elem) {
    //         (type === 'metric') ? $(elem).html('kg/m³') : $(elem).html('lb/gal');
    //     });

    //     $('.js-kg-lb').each(function (k,elem) {
    //         (type === 'metric') ? $(elem).html('kg') : $(elem).html('lb.');
    //     });

    //     $('.js-input-field').each(function (k,elem) {
    //         let newText = (type === 'metric') ? $(elem).data('place-metric') : $(elem).data('place-imperial');
    //         $(elem).attr('placeholder', newText)
    //     });
    // }

    // $('.js-material').change(function (){
    //     let select = $(this).find(":selected");
    //
    //     let size = select.data('density');
    //     let parentBlk = $(this).parent().parent().parent().find('.js-density');
    //
    //     parentBlk.val(size);
    // });

    // $('.js-unit').change(function (){
    //     let unit = $(this).val();
    //
    //     if(unit === 'metric'){
    //         changeUnitVals('metric');
    //         changeUnitNames('metric');
    //     } else {
    //         changeUnitVals('imperial');
    //         changeUnitNames('imperial');
    //     }
    // })

    $('#add-row-btn').click(function () {
        let paltte = $('#platte-template').children();
        let platteNum = $('.platte-num').length + 1;
        let templ = paltte.clone();

        templ.find('.platte-num').html(platteNum);
        templ.find('.total-weight').html('0.00');
        templ.find('.js-length').parent().find('.ci-form-error').addClass(`length-error-${platteNum}`);
        templ.find('.js-width').parent().find('.ci-form-error').addClass(`width-error-${platteNum}`);
        templ.find('.js-strength').parent().find('.ci-form-error').addClass(`strength-error-${platteNum}`);
        templ.find('.js-density').parent().find('.ci-form-error').addClass(`density-error-${platteNum}`);

        $('.js-weight-blk-all').each(function (k, elem) {
            $(elem).removeClass('d-none');
        })

        let fields = templ.find('.js-input-field');
        fields.each(function (k, elem) {
            let oldName = $(elem).attr('name');
            let oldPlatteNum = (platteNum === 2) ? 0 : platteNum - 1;
            let newName = oldName.replace("["+oldPlatteNum+"]", `[${platteNum}]`);

            //let platteWeightBlk =
            templ.find('.js-weight-blk-all').addClass(`js-weight-blk-${platteNum}`);

            $(elem).attr('name', newName);
        });

        let clonedTmpl = templ.clone();
        $('#form-blk').append(clonedTmpl);
    });


});
