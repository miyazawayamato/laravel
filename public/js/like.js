$(function(){
    
    // data-aid 記事ID
    // data-wid 単語ID
    
    
    $('i').click(function() {
        
        
        
        let it = $(this);
        
        if (it.hasClass('article')) {
            
            num = it.data('aid');
            
            url = '../../like/article ';
            
        } else if (it.hasClass('word')) {
            
            num = it.data('wid');
            url = '../like/word ';
        } else {
            return false;
        }
        
        
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            
            data: { id: num },
            dataType: 'json',
            
        }).done(function (data) {
            
            $(it).toggleClass('text-warning');
            console.log(data);
        }).fail(function () {
            
            alert('通信失敗');
        });
        
        
    });
    
});