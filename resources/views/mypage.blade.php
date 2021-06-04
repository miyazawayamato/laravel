@extends('common')

@section('title', 'ユーザーホーム')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}"/>
@endsection

@section('main')
<div class="row my-md-5 pt-5 no-gutters mypage-main">
        
  <div class="offset-md-1"></div>
  
  <div class="card col-md-3 pt-3 mr-md-2" >
    <div class="p-3">
      @if (empty($user->imagepass))
        <img src="{{ asset('common/no_image_yoko.jpg') }}" class="card-img-top px-2">
      @else 
        <img src="{{ asset(Storage::disk('s3')->url($user->imagepass)) }}" class="card-img-top px-2">
      @endif
    </div>
      <div class="card-header p-0">
          <p class="m-0 text-center">ユーザーデータ</p>
      </div>
      <div class="card-body">
          <h5 class="card-title">{{$user->name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{$user->account}}</h6>
          <div class="cadtext">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-info">ログアウト</button>
            </form>
          </div>
          <p class="card-text">
            @if (!empty($user->prof))
              {{$user->prof}}
            @endif
          </p>
          <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="{{route('p.edit')}}">ユーザー情報編集</a></li>
              <li class="list-group-item"><a href="{{route('create')}}">記事投稿</a></li>
              <li class="list-group-item border-bottom"><a href="#" data-toggle="modal" data-target="#exampleModal">単語投稿</a></li>
          </ul>
      </div>
  </div>
  
  <div class="col-md-7 border px-0 mypage-lists mt-md-0">
      
      <ul class="nav nav-tabs">
          <li class="nav-item lists-navi">
            <span class="nav-link sel" data-lists="1" style="cursor: pointer">投稿記事</span>
          </li>
          <li class="nav-item lists-navi">
            <span class="nav-link sel"  data-lists="2" style="cursor: pointer">投稿単語</span>
          </li>
          <li class="nav-item lists-navi">
            <span class="nav-link sel"  data-lists="3" style="cursor: pointer">いいね記事</span>
          </li>
          <li class="nav-item lists-navi">
            <span class="nav-link sel"  data-lists="4" style="cursor: pointer">いいね単語</span>
          </li>
      </ul>
      
      
      <div class="tab-content" id="myTabContent">
        
        <div id="lists">
          <p>選択してください</p>
        </div>
          
      </div>
  </div>
  <div class="offset-md-1"></div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">投稿の削除</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="delete-modal-none">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          @method('DELETE')
          @csrf
          <input type="hidden" name="delete_id" value="" id="delete-id">
          <p>本当に削除しますか?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary d-none" id="delete-article" formaction="{{route('a.delete')}}">削除します</button>
          <button class="btn btn-info d-none" id="delete-word" formaction="{{route('w.delete')}}">削除します</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/mypage.js') }}"></script>

@endsection