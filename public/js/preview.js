$(function(){
    
    
    const ope = $('#ope').data('ope');
    
    $('#pre').click(function() {
                
        let url ='';
        
        if (ope === 'post') {
            
            url = '../markdown/view';
            
        } else if(ope === 'edit') {
            
            url = '../../markdown/view';
            
        }
        
        let origin = $('#original').val();
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            
            data: { text : origin },
            dataType: 'json',
            
            
        }).done(function (data) {
            
            
            $('#conver').html(data);
            
            
            
        }).fail(function () {
            alert('通信失敗');
        });
    });
    
    
    $('#toggle').click(function() {
        
        if ($('.preview').css('display') === 'none') {
            
            $('.preview').css('display', 'block');
            $('.original').css('display', 'none');
            
        } else {
            $('.preview').css('display', 'none');
            $('.original').css('display', 'block');
        }
        
        
    });
});