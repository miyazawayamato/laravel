$(function(){
    
    // data-aid 記事ID
    // data-wid 単語ID
    
    
    $('i').click(function() {
        
        
        
        let it = $(this);
        
        if (it.hasClass('article')) {
            
            num = it.data('aid');
            
            // url = 'http://localhost/my-laravel/project/public/like/article ';
            url = 'http://35.72.100.242/site/laravel/public/like/article ';
            
        } else if (it.hasClass('word')) {
            
            num = it.data('wid');
            // url = 'http://localhost/my-laravel/project/public/like/word ';
            url = 'http://35.72.100.242/site/laravel/public/like/word ';
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