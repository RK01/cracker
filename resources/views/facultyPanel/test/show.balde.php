@extends('layouts.faculty')
@section('content')

<form action="/tests/store" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Test Title" class="form-control">
    
    @for ($i = 1; $i <= 50; $i++)
        <div class="question-block">
            <p>Question {{ $i }}</p>
            <input type="text" name="questions[{{$i}}][text]" class="form-control">
            @for ($j = 1; $j <= 4; $j++)
                <input type="text" name="questions[{{$i}}][options][{{$j}}]" placeholder="Option {{ $j }}">
                <input type="radio" name="questions[{{$i}}][correct]" value="{{$j}}"> Correct?
            @endfor
        </div>
    @endfor
    <button type="submit">Create Test</button>
</form>
@endsection