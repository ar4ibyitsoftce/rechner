$(function () {
    //.form-check-input
    function request(){
        let data = $('#calcBlocks').serializeArray();
        let url = $('#calcBlocks').attr('action');

        $.ajax({
            url: url,
            data: data,
            // async: false,
            method: 'POST',
            success: function (res){
                let obj = JSON.parse(res);
                console.log(res);
                if(obj.success === 1){
                    $('#totalWeight').html(obj.weight);
                    // $('.js-unit-tumbler').val(obj.unitTumbler);
                }
            },
            error: function (err){
                console.log(err);
            }
        });
    }

    function unitRecalc(){
        // return new Promise((resolve, reject) => {
            let data = $('#calcBlocks').serializeArray();
            let url = '../requests/unit-recalc.php'

            $.ajax({
                url: url,
                data: data,
                // async: false,
                method: 'POST',
                success: function (res){
                    let obj = JSON.parse(res);

                    if(obj.success === 1){
                        // $('#calcBlocks')[0].reset();
                        //
                        // $(`input[value="${obj.units}"]`).prop("checked", true);
                        $('.js-density').val(obj.density);
                        $('.js-length').val(obj.length);
                        $('.js-width').val(obj.width);
                        $('.js-strength').val(obj.strength);

                        $('.js-unit-tumbler').val(obj.unitTumbler);
                    }

                    // resolve('ok');
                },
                error: function (err){
                    // reject('error');
                }
            });
        // });
    }

    $('.form-control').focusout(function (e){
        request();
    });

    $('.form-check-input').change(function (e) {
        unitRecalc()//.then(request());
        request();
    })
})