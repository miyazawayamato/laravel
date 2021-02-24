$(function(){
    
    
    const ope = $('#ope').data('ope');
    
    
    $('#newtag-modal-btn').click(function() {
        $('#newtag-messe').empty();
    });
    
    
    //タグ生成
    $('#newtag-btn').click(function() {
        
        let newtag = $('#newtag').val();
        
        let url ='';
        
        
        
        if (ope === 'post') {
            url = '../tag/add';
        } else if(ope === 'edit') {
            url = '../../tag/add';
        }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url ,
            data: { tagname: newtag },
            dataType: 'json',
            
        }).done(function (data) {
            
            
            if (data === 2) {
                $('#newtag-messe').text(`${newtag}は既に存在します`);
            } else {
                $('#newtag-messe').text(`${data}を追加しました`);
            }
            
            $('#newtag').val('');
            
        }).fail(function () {
            
            alert('通信失敗');
        });
        
    });
    
    //タグ取得
    $('#addmodal').click(function() {
        
        //現在チェックされているものはチェック状態に
        let curtags = [];
        $('#select-tags input').each(function() {
            curtags.push($(this).val());
        });
        
        
        let url ='';
        
        if (ope === 'post') {
            
            url = '../tag/list';
            
        } else if(ope === 'edit') {
            
            url = '../../tag/list';
        };
        
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            data: { },
            dataType: 'json',
            
        }).done(function (data) {
            
            $('#tag-lists').empty();
            let lists = '';
            
            $.each(data, function(index, value) {
                
                let id = value.id;
                let name = value.tag_name;
                
                //データ型注意
                if (!curtags.includes(`${id}`)) {
                    // console.log('含まれない');
                    lists = `<div class="form-check d-inline-block" style="width: 48%;">
                        <input class="form-check-input" type="checkbox" id="tagid${id}" name="addtag" value="${id}"  data-tagname="${name}">
                        <label class="form-check-label" for="tagid${id}">
                        ${name}
                    </label>
                    </div>`;
                } else {
                    // console.log('含まれるチェック');
                    lists = `<div class="form-check d-inline-block" style="width: 48%;">
                    <input class="form-check-input" type="checkbox" id="tagid${id}" name="addtag" value="${id}"  data-tagname="${name}" checked>
                    <label class="form-check-label" for="tagid${id}">
                    ${name}
                    </label>
                    </div>`;
                }
                $('#tag-lists').append(lists);
                
            });
        }).fail(function () {
            
            alert('通信失敗');
        });
    });
    
    
    //タグ追加
    $('#addtag-btn').click(function() {
    
        //現在のタグを取得し配列に
        let curtags = [];
        $('#select-tags input').each(function() {
            curtags.push($(this).val());
        });
        
        
        //配列にtagが含まれていなければ追加、いれば追加しない
        $('input:checkbox[name="addtag"]:checked').each(function() {
            
            if ($('#select-tags input').length === 5) {
                
                $('#tag-max').text('タグは５つまでです');
                return false
            }
            
            let tagname = $(this).data('tagname');
            let tag = $(this).val();
            
            if (!curtags.includes(tag)) {
                let taglist = `<div class="select-tag bg-info d-inline rounded-pill p-2" >
                    <span>${tagname}</span>
                    <span aria-hidden="true" class="erase" style="cursor: pointer">&times;</span>
                    <input type="hidden" value="${tag}" name="selecttag[]">
                </div>`;
                    
                $('#select-tags').append(taglist);
                
            }
            
        });
        
        $('.erase').click(function() {
            
            $(this).parent().remove();
        });
        
        
    });
    
});