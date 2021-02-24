@extends('common')

@section('title', '単語検索')
@section('stylesheet')
@endsection


@section('main')

<div class="my-5 mx-auto top-main" style="width: 70%">
    <div>
        <span>{{$keyword}}：の検索結果</span><span>:合計{{$count}}件</span>
        <form action="{{route('a.search')}}" method="get">
            <input type="hidden" value="{{$keyword}}" name="keyword">
            <button class="btn btn-success" type="submit">記事検索</button>
        </form>
    </div>
    <div class="mt-3 overflow-scroll" style="max-height: 80%">
        @if ($count > 0))
        <table class="table  table-striped " >
            <thead>
                <tr>
                    <th style="width: 25%;">Word</th>
                    <th class="text-left" style="width: 65%;"> meaning</th>
                    <th class="align-middle "style="width: 10%;">いいね</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($words as $word)
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
                        <td class="align-middle "><i class="far fa-star word " data-wid="{{$word->id}}"></i></td>
                    @endif
                @endauth
                </tr>
                @endforeach
            </tbody>
          </table>
        @else
        <p>該当なし</p>
        @endif
    </div>
</div>

@endsection