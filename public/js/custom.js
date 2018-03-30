$(".btn-edit").click(function(){
    var url = baseURL + '/api/show/' + $(this).data('id');
    var editUrl = baseURL + '/register/edit/' + $(this).data('id');
    $.getJSON(url, function(result){
        $("#nama").val(result.data.nama);
        $("#no_telp").val(result.data.no_telp);
        $("#email").val(result.data.email);
        $("#keterangan").val(result.data.keterangan);
        $("#form-input").attr('action', editUrl);
    });
});

$("#btn-reset").click(function(){
    $("#form-input").attr('action', baseURL + '/home/post');
});

$("#cbo-keterangan").change(function(){
    table.draw();
});