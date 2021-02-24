<!DOCTYPE html>
<html lang="ja">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- アイコン --}}
    <script src="https://kit.fontawesome.com/0e958c0ed0.js" crossorigin="anonymous"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    {{-- markdowncss --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">
    
    @yield('stylesheet')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    
    <title>@yield('title')</title>
    
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info px-5">
            <a class="navbar-brand" href="{{route('top')}}">ポートフォリオ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item ml-3">
                                    <a href="{{ route('home') }}" class="nav-link">マイページ</a>
                                </li>
                            @else
                                <li class="nav-item ml-3">
                                    <a href="{{ route('login') }}" class="nav-link">ログイン</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item ml-3">
                                    <a href="{{ route('register') }}" class="nav-link">新規登録</a>
                                </li>
                                @endif
                            @endauth
                        @endif
                    
                    <li class="nav-item dropdown ml-3">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        投稿する
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('create')}}">記事投稿</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">単語投稿</a>
                        </div>
                    </li>
                    
                </ul>
                
                <form class="form-inline my-2 my-lg-0" action="{{route('a.search')}}" method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" required>
                <button class="btn btn-success my-2 my-sm-0" type="submit">検索</button>
                </form>
            </div>  
    </header>
    
        <!-- モーダル単語 -->
        <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">単語追加</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('w.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">単語</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ old('title') }}" maxlength="20">
                            </div>
                            @if ($errors->has('title'))
                            <p style="color: red">{{$errors->first('title')}}</p>
                            @endif
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">意味</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body" maxlength="250">{{ old('body') }}</textarea>
                            </div>
                            @if ($errors->has('body'))
                            <p style="color: red">{{$errors->first('body')}}</p>
                            @endif
                            
                            <div class="modal-footer">
                                <button class="btn btn-primary">保存する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
          <!-- モーダル単語 -->
    
    
    <div style="min-height: 750px;">
        @yield('main')
    </div>
    
    <footer class="footer bg-info">
        <div class="container">
            <p class="text-muted ">Place sticky footer content here.</p>
            <p class="m-0">korehahutta-desu</p>
        </div>
    </footer>
</body>
</html>