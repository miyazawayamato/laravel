$(function(){

    //記事削除モーダル
    $('.delete-article-modal').click(function() {
        $('#delete-article').removeClass('d-none');
        const deleteid = $(this).data('article');
        $('#delete-id').val(deleteid);
    })
    //単語削除モーダル
    $('.delete-word-modal').click(function() {
        $('#delete-word').removeClass('d-none');
        const deleteid = $(this).data('word');
        $('#delete-id').val(deleteid);
    })
    
    //×ボタン、削除ボタンの再度d-none
    $('#delete-modal-none').click(function() {
        
        if (!$('#delete-article').hacClass('d-none')) {
            $('#delete-article').addClass('d-none');
        } else if (!$('#delete-word').hacClass('d-none')) {
            $('#delete-word').addClass('d-none');
        }
    })
});