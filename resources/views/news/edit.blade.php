@push("styles")
    <style>
        #news {
            width: 100%;
            min-height: 200px;
        }
    </style>
@endpush

@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>{{ $title }}</h3>
            <form method="post">
                {{ csrf_field() }}
                @if ($errors->has('news'))
                    <span class="help-block">
                        <strong>{{$errors->first('news')}}</strong>
                    </span>
                @endif
                <textarea id="news" name="news">{{ $news }}</textarea>

                <input type="submit" name="submit" value="Add new article">
                <label><input type="checkbox" name="public"<?php if ($postPublic) echo " checked" ?>> Make post public</label>
            </form>
        </div>
    </div>
</div>
@endsection