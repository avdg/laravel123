@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{$newsArticle->news}}
                </div>
                <div class="panel-footer">
                    Written on {{ $newsArticle->formatDate($newsArticle->created_at) }}
                @if ($newsArticle->created_at !== $newsArticle->updated_at)
                    - Modified on {{ $newsArticle->formatDate($newsArticle->updated_at) }}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection