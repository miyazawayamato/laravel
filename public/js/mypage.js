$(function(){
    
    $('.sel').click(function() {
        let cur = $('.active').data('lists');
        $('.active').removeClass('active');
        $(this).addClass('active');
        
        let num = $(this).data('lists');

        
        let route = '';
        switch (num) {
            case 1:
                route = 'ajax/article';
                break;
            case 2:
                route = 'ajax/word';
                break;
            case 3: 
                route = 'ajax/like/article';
                break;
            case 4: 
                route = 'ajax/like/word';
                break;
        };
        
        //要素を空にする
        $('#lists').empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: route,
            
            data: { },
            dataType: 'json',
        }).done(function (data) {
            
            $('#lists').empty();
            let html = '';
            
            //いいねはアカウント名入れたほうがいい？
            switch (num) {
                case 1:
                    article(data);
                    break;
                case 2:
                    word(data);
                    break;
                case 3: 
                    likeArticle(data);
                    break;
                case 4: 
                    likeAword(data);
                    break;
            };
            
            $.getScript("js/like.js");
            $.getScript("js/delete.js");
            
        }).fail(function () {
            $('#lists').text('通信失敗');
        });
        
    });
    
    
    //投稿記事
    function article(data) {
        $.each(data, function(index, value) {
                
            let id = value.id;
            let title = value.title;
            let time = value.created_at;
            // <a href="delete/article/${id}"  class="ml-2">削除</a>
            
            let html = `<div style="width: 100%; height: 50px;" class="border-bottom">
            <div>
            <span>${time}</span>
            <a href="edit/article/${id}" class="ml-2">編集</a>
            <span data-toggle="modal" data-target="#deleteModal" style="cursor: pointer;" class="delete-article-modal ml-2 text-primary" data-article="${id}">削除</span>
            </div>
            <a class="m-0 text-truncate " href="show/article/${id}" style="display: block;">${title}</a>
            </div>`;
            
            $('#lists').append(html);
        });
    }
    
    
    //投稿単語
    function word(data) {
        let table = `<table class="table  table-striped ">
        <thead>
          <tr>
            <th style="width: 25%;">Word</th>
            <th class="text-left" style="width: 65%;"> meaning</th>
            <th style="width: 10%;">削除</th>
          </tr>
        </thead>
        <tbody id="tbodys"></tbody>
        </table>`;
        
        $('#lists').append(table);
        
        $.each(data, function(index, value) {
                
            let id = value.id;
            let title = value.title;
            let body = value.body;
            
            let html = `<tr>
            <td class="align-middle ">${title}</td>
            <td class="">${body}</td>
            <td class="align-middle"><span data-toggle="modal" data-target="#deleteModal" style="cursor: pointer;" class="delete-word-modal text-primary" data-word="${id}">削除</span></td>
          </tr>`;
            
            $('#tbodys').append(html);
        });

    }
    //いいね記事
    function likeArticle(data) {
        $.each(data, function(index, value) {
            let id = value[0].id;
            let title = value[0].title;
            let time = value[0].created_at;
            
            console.log(value);
            
            let html = `<div style="width: 100%;" class="border-bottom">
                <span>${time}</span>
                <i class="far fa-star m-3 text-warning article" data-aid="${id}"  style="cursor: pointer"></i>
                <a class="m-0 text-truncate " href="show/article/${id}" style="display: block;">${title}</a>
            </div>`;
            
            $('#lists').append(html);
        });
        
    }
    
    
    //いいね単語
    function likeAword(data) {
        
        console.log(data);
        let table = `<table class="table  table-striped ">
        <thead>
          <tr>
            <th style="width: 25%;">Word</th>
            <th class="text-left" style="width: 65%;"> meaning</th>
            <th style="width: 10%;"><i class="far fa-star"></i></th>
          </tr>
        </thead>
        <tbody id="tbodys"></tbody>
        </table>`;
        
        $('#lists').append(table);
        
        $.each(data, function(index, value) {
                
            let id = value[0].id;
            let title = value[0].title;
            let body = value[0].body;
            
            let html = `<tr>
            <td class="align-middle ">${title}</td>
            <td class="">${body}</td>
            <td class="align-middle text-warning"><i class="far fa-star word" data-wid="${id}"  style="cursor: pointer"></i></td>
          </tr>`;
            
            $('#tbodys').append(html);
        });
        
    }
    
    
});