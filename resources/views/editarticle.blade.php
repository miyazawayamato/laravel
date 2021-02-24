@extends('common')

@section('title', '記事投稿')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/newarticle.css') }}"/>
@endsection

@section('main')
<form action="{{route('updata')}}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{$article->id}}" required maxlength="50">
    <div class="px-5 mt-5" style="width: 100%;">
        <input type="text" name="title" class="form-control" style="width:100%; height: 45px;" value="{{$article->title}}">
    </div>
    @if ($errors->has('title'))
    <p style="color: red" class="pl-5 pt-3">{{$errors->first('title')}}</p>
    @endif
    
    <div class="">
        <button type="button" class="btn btn-primary ml-5 mt-3" id="pre">プレビュー
        </button>
        <button  type="button" class="btn btn-primary mt-3 ml-2" id="toggle">切り替え</button>
    </div>
  
    <div class="d-md-flex mx-md-5 my-3">
        
        <div class="overflow-auto original" style="height: 600px;">
            <textarea name="body" class="form-control" style="width: 100%; height: 600px;" required maxlength="10000" id="original">{{ $article->body }}</textarea>
        </div>
        
        <div class="preview none bg-white" style="height: 600px;" id="conver">
            
        </div>
    </div>
    @if ($errors->has('body'))
    <p style="color: red" class="pl-5">{{$errors->first('body')}}</p>
    @endif
    
    
    
    <div class="m-5">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtagModal" id="addmodal">
        記事にタグを追加
        </button>
        <button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#newtagModal" id="newtag-modal-btn">
            新タグ生成
        </button>
    </div>
    
    {{-- タグ生成 --}}
    <div class="modal fade" id="newtagModal" tabindex="-1" aria-labelledby="newtagModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newtagModalLabel">新タグ生成</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="newtag-messe" class="text-danger"></p>
                    <label for="newtag">新しいタグ</label>
                    <input type="text" class="form-control" id="newtag" placeholder="タグ名" maxlength="10">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="newtag-btn">生成する</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- タグ追加 --}}
    <div class="modal fade" id="addtagModal" tabindex="-1" aria-labelledby="addtagModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addtagModalLabel">記事にタグを追加</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p id="tag-max" class="text-danger"></p>
                    <div class="overflow-auto" style="max-height: 300px;" id="tag-lists">
                        
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addtag-btn">追加する</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="select-tags" class="mx-5" >
        @if (!empty($article->tags))
            @foreach ($article->tags as $tag)
                <div class="select-tag bg-info d-inline rounded-pill p-2" >
                    <span>{{$tag->tag_name}}</span>
                    <span aria-hidden="true" class="erase" style="cursor: pointer">&times;</span>
                    <input type="hidden" value="{{$tag->id}}" name="selecttag[]">
                </div>
            @endforeach
        @endif
    </div>
    
    <div class="m-5 text-right">
        <button class="btn btn-primary btn-lg" data-ope="edit" id="ope">投稿する</button>
    </div>
</form>

<script src="{{ asset('js/tag.js') }}"></script>
<script src="{{ asset('js/preview.js') }}"></script>
@endsection