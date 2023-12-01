$('#calcBlocks').submit(function (e) {
    e.preventDefault();

    let data = $(this).serializeArray();
    let url = $('#calcBlocks').attr('action');

    $.ajax({
        url: url,
        data: data,
        method: 'POST',
        success: function (res){
            let obj = JSON.parse(res);
            console.log(obj);
            if(obj.success === 1){
                $('#result-blk').html(obj.text);
                $('#result-blk').parent().removeClass('d-none');
            }
        },
        error: function (err){
            console.log(err);
        }
    });

});