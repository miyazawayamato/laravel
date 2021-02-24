@extends('common')

@section('title', 'プロフィール編集')
@section('stylesheet')
@endsection


@section('main')
<div class="my-5 mx-md-5">
    <div class="mx-auto " style="width: 60%;">
        <h2>ユーザー情報編集</h2>
        <div class="mb-3">
            <p style="color: red" class="pl-5 pt-3">{{$errors->first('name')}}</p>
            <form action="{{route('name.edit')}}" method="post">
                @csrf
                @method('PUT')
                <label for="Input1" class="form-label">名前</label>
                <input class="form-control form-control-lg" type="text" id="Input1" aria-label=".form-control-lg example" name="name" value="{{ old('name', $user->name) }}">
                <div class="text-end mt-3" style="text-align: right;">
                    <button  class="btn btn-secondary" >変更する</button>
                </div>
            </form>
        </div>
        <div class="mb-3">
            <p style="color: red" class="pl-5 pt-3">{{$errors->first('prof')}}</p>
            <form action="{{route('prof.edit')}}" method="POST">
                @csrf
                <label for="Textarea1" class="form-label">紹介文</label>
                <textarea class="form-control" id="Textarea1" rows="3" name="prof">{{ old('prof',$user->prof) }}</textarea>
                <div class="text-end mt-3" style="text-align: right;">
                    <button class="btn btn-secondary">変更する</button>
                </div>
            </form>
        </div>
        
        <div class="mb-3">
            <p style="color: red" class="pl-5 pt-3">{{$errors->first('imagepass')}}</p>
            <form action="{{route('image.edit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="formFile" class="form-label" >画像</label>
                <input class="form-control" type="file" id="formFile" name="imagepass">
                @if (!empty($user->imagepass))
                    <input type="hidden" name="curimage" value="{{$user->imagepass}}">
                @endif
                <div class="text-end mt-3" style="text-align: right;">
                    <button class="btn btn-secondary mr-3" formaction="{{route('image.delete')}}">削除する</button>
                    <button class="btn btn-secondary">変更する</button>
                </div>
            </form>
        </div>
        
        <div class="mb-3">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <label for="Input2" class="form-label">パスワードリセット</label>
                <input type="email" class="form-control" id="Input2" name="email" value="{{$user->email}}" disabled>
                <div class="text-end mt-3" style="text-align: right;">
                    <button class="btn btn-secondary">リセットリンクを送る</button>
                </div>
            </form>
        </div>
    </div>
        
</div>


@endsection