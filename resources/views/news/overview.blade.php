@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Overview</h3>
            <a href="/news/create">Create a new article</a>
            @if (sizeof($news) > 0)
            @foreach($news as $newsItem)
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ substr($newsItem->news, 0, 200) }}
                    </div>
                    <div class="panel-footer">
                        @if ($newsItem->public)
                            public -
                        @else
                            private -
                        @endif
                        <a href="/news/edit/{{$newsItem->id}}">edit</a> -
                        <a href="/news/delete/{{$newsItem->id}}">remove</a>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection