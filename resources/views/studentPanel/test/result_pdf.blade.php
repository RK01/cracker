<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OMR Result</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .question-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
        }

        .correct {
            background: #d4edda;
            padding: 5px;
        }

        .wrong {
            background: #f8d7da;
            padding: 5px;
        }

        .option {
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>OMR Result Sheet</h2>
        <h4>{{ $test->title }}</h4>
        <p>
            Student:
            {{ auth()->user()->name }}
        </p>
        <h3>
            Score:
            {{ $attempt->score }}
            /
            {{ $test->questions->count() }}
        </h3>
    </div>
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
    <div class="question-box">
        <strong>
            Q{{ $index + 1 }}.
            {{ $question->question_text }}
        </strong>
        <div style="margin-top:10px;">
            @foreach($question->options as $option)
            @php
            $isCorrect =
            $correctOption &&
            $correctOption->id == $option->id;

            $isSelected =
            $selectedOptionId == $option->id;
            @endphp
            <div class="
                    option
                    @if($isCorrect)
                        correct
                    @elseif($isSelected)
                        wrong
                    @endif
                ">
                @if($isSelected)
                ●
                @else
                ○
                @endif
                {{ $option->option_text }}
                @if($isCorrect)
                (Correct)
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</body>

</html>