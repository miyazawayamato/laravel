@extends('common')

@section('title', '記事')
@section('stylesheet')
@endsection

@section('main')
<div class="mx-auto my-5 p-5 border" style="width: 80%;">
  <a href="{{route('user', [$article->user->account])}}" class="link-success" style="cursor: pointer">{{$article->user->name}}</a>
  <span>{{$article->created_at}}</span>
  @auth
    @if(!empty($article->like_check($article->id)))
      <i class="far fa-star text-warning article" data-aid="{{$article->id}}"></i>
    @else
      <i class="far fa-star article" data-aid="{{$article->id}}"></i>
    @endif
  @endauth
  <h3 class="py-3 fw-bolder ">{{$article->title}}</h3>
  <div class="tags">
      <p>タグ</p>
      <form action="" method="get">
        @csrf
        @foreach ($article->tags as $tag)
          <button class="bg-info rounded p-2" formaction="{{route('t.search', [$tag->id])}}">{{$tag->tag_name}}</button>
        @endforeach
      </form>
    </div>
    <div class="body text-break mt-4 pt-5 border-top">{{ Illuminate\Mail\Markdown::parse(e($article->body)) }}</div>
  
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection