@extends('common')

@section('title', '最新投稿一覧')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/top.css') }}"/>
@endsection


@section('main')
  <div class="my-5 mx-auto top-main">
    
    <div class="d-md-flex">
      <div class="left" >
        <h3 class="mb-2 bg-info py-2" >最新記事</h3>
        
        @foreach ($articles as $article)
        <div class="border-bottom d-flex" style="width: 100%;">
          <div style="width: 100%;">
            <div>
              <a href="{{route('user', [$article->user->account])}}" class="link-success" style="cursor: pointer">{{$article->user->name}}</a>
              <span>{{$article->created_at}}</span>
            </div>
            <a class=" text-truncate" href="{{route('show', [$article->id])}}" style="display: block;">{{$article->title}}</a>
          </div>
        </div>
        @endforeach
      </div>
      
      
      <div class="border-left right">
        <h3 class="mb-2 bg-primary py-2">最新単語</h3>
        <table class="table  table-striped " >
          <thead>
            <tr>
              <th style="width: 30%;">Word</th>
              <th class="text-left" style="width: 70%;"> meaning</th>
              {{-- <th style="width: 10%;"><i class="far fa-star word"></i></th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($words as $word)
            <tr>
              <td class="align-middle ">{{$word->title}}</td>
              <td class="">{{$word->body}}</td>
              {{-- @if(in_array($word->id, $word_like))
                <td class="align-middle text-warning"><i class="far fa-star word" data-wid="{{$word->id}}"></i></td>
              @else
                <td class="align-middle "><i class="far fa-star word" data-wid="{{$word->id}}"></i></td>
              @endif --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/like.js') }}"></script>
  
  
@endsection