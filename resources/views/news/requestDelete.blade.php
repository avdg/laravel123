@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <strong>Are you sure you want to delete this article?</strong>
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
            <form method="post">
                {{ csrf_field() }}
                <input type="submit" name="submit" value="Yes! Delete this article">
            </form>
        </div>
    </div>
</div>
@endsection