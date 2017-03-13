@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>

            @if (sizeof($news) > 0)
                <h3>Updates</h3>
                <div class="panel panel-default">
                    @foreach($news as $newsItem)
                    <div class="panel-body">
                        {{$newsItem->news}}
                    </div>
                    <div class="panel-footer">
                        Written on {{ $newsItem->formatDate($newsItem->created_at) }}
                    @if ($newsItem->created !== $newsItem->lastModified)
                        - Modified on {{ $newsItem->formatDate($newsItem->modified_at) }}
                    @endif
                    </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
</div>

@endsection
