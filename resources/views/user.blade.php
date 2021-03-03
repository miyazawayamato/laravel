@extends('common')

@section('title', 'ユーザーページ')
@section('stylesheet')
@endsection
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}"/>
@section('main')

<div class="row my-5 pt-5 no-gutters mypage-main">
        
  <div class="offset-md-1"></div>
    
    <div class="card col-md-3 pt-3 mr-md-2" >
      <div class="p-3">
        @if (!empty($user->iamgepass))
          <img src="{{ asset(Storage::url($user->imagepass)) }}" class="card-img-top px-2">
        @else
          <img src="{{ asset('common/no_image_yoko.jpg') }}" class="card-img-top px-2" >
        @endif
      </div>
        <div class="card-header p-0">
            <p class="m-0 text-center">ユーザーデータ</p>
        </div>
        <div class="card-body">
            <span class="card-title">{{$user->name}}</span>
            <h6 class="card-subtitle mb-2 text-muted">{{$user->account}}</h6>
            <p class="card-text">
              @if (!empty($user->prof))
                {{$user->prof}}
              @endif
            </p>
        </div>
    </div>
    
    <div class="col-md-7 border px-0 mypage-lists mt-md-0">
        
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">投稿記事</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">投稿単語</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          @foreach ($user->articles as $article)
          <div style="width: 100%; height: 50px;" class="border-bottom">
            <div>
              <span>{{$article->created_at}}</span>
            </div>
            <a class="m-0 text-truncate " href="{{route('show', [$article->id])}}" style="display: block;">{{$article->title}}</a>
          </div>
          @endforeach
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <table class="table  table-striped ">
            <thead>
              <tr>
                <th style="width: 25%;">Word</th>
                <th class="text-left" style="width: 65%;"> meaning</th>
                <th style="width: 10%;"><i class="far fa-star word"></i></th>
              </tr>
            </thead>
            <tbody id="tbodys">
              @foreach ($user->words as $word)
              <tr>
                <td class="align-middle ">{{$word->title}}</td>
                <td class="">{{$word->body}}</td>
                @guest
                <td></td>
                @endguest
                @auth
                  @if(!empty($word->like_check($word->id)))
                    <td class="align-middle text-warning"><i class="far fa-star word" data-wid="{{$word->id}}"></i></td>
                  @else
                    <td class="align-middle "><i class="far fa-star word" data-wid="{{$word->id}}"></i></td>
                  @endif
                @endauth
              </tr>
                  
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
      
    </div>
  </div>
  <div class="offset-md-1"></div>
</div>
<script src="{{ asset('js/like.js') }}"></script>

@endsection