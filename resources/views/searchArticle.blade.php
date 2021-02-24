@extends('common')

@section('title', '記事検索')
@section('stylesheet')
@endsection


@section('main')

<div class="my-5 mx-auto top-main" style="width: 70%">
    <div>
        <span>{{$keyword}}：の検索結果</span><span>:合計{{$count}}件</span>
        <form action="{{route('w.search')}}" method="get">
            <input type="hidden" value="{{$keyword}}" name="keyword">
            <button class="btn btn-success" type="submit" >単語検索</button>
        </form>
    </div>
    <div class="mt-3">
        @if ($count > 0)
            @foreach ($articles as $article)
            <div class="border" style="width: 100%;">
                <div style="width: 100%;">
                    <div>
                    <a href="{{route('user', [$article->user->account])}}" class="link-success" style="cursor: pointer">{{$article->user->name}}</a>
                    <span>{{$article->created_at}}</span>
                    </div>
                    <a class="text-truncate" href="{{route('show', [$article->id])}}" style="display: block;">{{$article->title}}</a>
                </div>
            </div>
            @endforeach
            <div class="mt-5">
                {{ $articles->links() }}
            </div>
        @else
        <p>該当なし</p>
        @endif
    </div>
</div>

@endsection