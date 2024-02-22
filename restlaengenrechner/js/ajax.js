$('#calcBlocks').submit(function (e) {
    e.preventDefault();

    let data = $(this).serializeArray();
    let url = $('#calcBlocks').attr('action');

    $('.ci-form-error').each(function(k, elem){
        $(elem).addClass('d-none');
    });

    $.ajax({
        url: url,
        data: data,
        method: 'POST',
        success: function (res){
            let obj = JSON.parse(res);

            if(obj.success === 1){
                $('#result-blk').html(obj.text);
                $('#result-blk').parent().removeClass('d-none');
            } else {
                $('.'+obj.error).removeClass('d-none');
            }
        },
        error: function (err){
            console.log(err);
        }
    });

});