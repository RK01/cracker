@extends('layouts.student')

@section('content')

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white" style="display: flex;justify-content: space-between;">
            <h4>OMR Result Sheet</h4>
            <div class="text-end">
                <a href="{{ route('student.tests.pdf', $test->id) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf me-2"></i>
                    Download PDF
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="row mb-4">

                <div class="col-md-6">
                    <h5>{{ auth()->user()->name }}</h5>
                    <p>{{ $test->title }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h4>
                        Score:
                        {{ $attempt->score }}
                        /
                        {{ $test->questions->count() }}
                    </h4>
                    <h5>
                        {{
                            round(
                                ($attempt->score /
                                max($test->questions->count(),1))
                                * 100,
                                2
                            )
                        }}%
                    </h5>
                </div>
            </div>
            <hr>
            @foreach($test->questions as $index => $question)
                @php
                    $response = $attempt->responses
                        ->where('question_id', $question->id)
                        ->first();

                    $selectedOptionId = $response->option_id ?? null;

                    $correctOption = $question->options
                        ->where('is_correct',1)
                        ->first();
                @endphp
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <h6>
                            Q{{ $index + 1 }}.
                            {{ $question->question_text }}
                        </h6>
                        <div class="row mt-3">
                            @foreach($question->options as $option)
                                @php
                                    $isCorrect =
                                        $correctOption &&
                                        $correctOption->id == $option->id;

                                    $isSelected =
                                        $selectedOptionId == $option->id;
                                @endphp
                                <div class="col-md-6 mb-2">
                                   <div class="p-2 border rounded
                                        @if(!$selectedOptionId)border-warning bg-warning-subtle
                                        @elseif($isCorrect)border-success bg-success-subtle
                                        @elseif($isSelected)border-danger bg-danger-subtle @endif">
                                        <div class="d-flex align-items-center">
                                            <div class=" rounded-circle border me-2 d-flex align-items-center justify-content-center"style=" width:30px; height:30px; ">
                                                @if($isSelected)●@endif
                                            </div>

                                            {{ $option->option_text }}

                                            @if($isCorrect)
                                                <span class="badge bg-success ms-2">Correct</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection