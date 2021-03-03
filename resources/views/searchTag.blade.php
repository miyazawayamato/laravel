@extends('common')

@section('title', 'タグ検索')
@section('stylesheet')
@endsection


@section('main')

<div class="my-5 mx-auto top-main" style="width: 70%">
    <div>
        <span>{{$tag->tag_name}}：の検索結果</span><span>:合計{{$count}}件</span>
        <button type="button" data-toggle="modal" data-target="#searchTagModal" class="btn btn-primary ml-2" >他のタグ</button>
    </div>
    <div class="mt-3">
        @if ($count > 0)
            @foreach ($articles as $article)
            <div class="border" style="width: 100%;">
                <div style="width: 100%;">
                    <div>
                    <a href="{{route('user', [$article->user($article->user_id)->account])}}" class="link-success" style="cursor: pointer">{{$article->user($article->user_id)->name}}</a>
                    <span>{{$article->created_at}}</span>
                    </div>
                    <a class="text-truncate" href="{{route('show', [$article->id])}}" style="display: block;">{{$article->title}}</a>
                </div>
            </div>
            @endforeach
        @else
        <p>該当なし</p>
        @endif
    </div>
    <div class="mt-5">
        {{ $articles->links() }}
    </div>
</div>

<div class="modal fade" id="searchTagModal" tabindex="-1" aria-labelledby="searchTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">タグ一覧</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="delete-modal-none">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <form action="" method="get">
                @csrf
                @foreach ($tags as $tag)
                  <button class="bg-info rounded p-2" formaction="{{route('t.search', [$tag->id])}}">{{$tag->tag_name}}</button>
                @endforeach
            </form>
        </div>
      </div>
    </div>
</div>
<script src="{{ asset('js/searchTag.js') }}"></script>
@endsection