function removeBlk(elem){
    let blk = $(elem).parent().parent().parent();

    blk.remove();

    request();
}
function request(){
    let data = $('#calcBlocks').serializeArray();
    let url = $('#calcBlocks').attr('action');

    let platteNum = $('.platte-num').length + 1;

    $.ajax({
        url: url,
        data: data,
        method: 'POST',
        success: function (res){
            let obj = JSON.parse(res);

            $.each(obj.data,function(index, value){
                $(`.js-weight-blk-${index + 1}`).find('.total-weight').html(value.weight);
            });

            $('#totalWeight').html(obj.weight.toFixed(2));
        },
        error: function (err){
            console.log(err);
        }
    });
}
$(function () {


    function unitRecalc(){
        let data = $('#calcBlocks').serializeArray();
        let url = '../requests/unit-recalc.php'

        $.ajax({
            url: url,
            data: data,
            method: 'POST',
            success: function (res){
                let obj = JSON.parse(res);

                if(obj.success === 1){
                    $('.js-density').val(obj.density);
                    $('.js-length').val(obj.length);
                    $('.js-width').val(obj.width);
                    $('.js-strength').val(obj.strength);

                    // $('.js-unit-tumbler').val(obj.unitTumbler);
                }
            },
            error: function (err){
                console.log(err)
            }
        });
    }

    // $('.form-control').focusout(function (e){
    //     request();
    // });

    $('#calcBlocks').submit(function (e) {
        e.preventDefault();
        request();
    });

    $('.form-check-input').change(function (e) {
        unitRecalc()
        request();
    })
})