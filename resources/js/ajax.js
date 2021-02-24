$(function(){
    
    
    $('.sel').click(function() {
        $('.active').removeClass('active');
        $(this).addClass('active');
        
        let num = $(this).data('lists');
        
        let url = '';
        switch (num) {
            case 1:
                let url = 'ajax/article';
                break;
            case 2:
                let url = 'ajax/word';
                break;
            case 3:
                let url = 'ajax/like/article';
                break;
            case 4:
                let url = 'ajax/like/word';
                break;
        };
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            //ユーザーid?
            data: { key: 1 },
            dataType: 'json',
        }).done(function (data) {
            let html = '';
            $.each(data, function(index, value) {
                
                let id = value.id;
                let title = value.title;
                let time = value.created_at;
                
                console.table(value);
                
                let html =  `<a href="${id}" class="border-bottom m-0" style="height: 50px; display: inline-block; width: 100%;">
                <div>
                  <span>${time}</span>
                  <p class="m-0 text-truncate">${title}</p>
                </div>
                </a>`
                
                $('#lists').append(html);
            });
        }).fail(function () {
            $('#lists').text('通信失敗');
        });
        
    });
    
    
    
    
});