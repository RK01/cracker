@extends('layouts.student')

@section('content')
<style>
.blink {
    animation: blink 1s linear infinite;
}

@keyframes blink {
    50% { opacity: 0.3; }
}
</style>
<div class="container py-4">
    <h3>{{ $test->title }}</h3>
    <div style="display: flex; justify-content: space-between; align-items: center; ">
        <div id="timerBox"  class="badge bg-success fs-6 p-3">
            Time Left: <span id="timer"></span>
        </div>
        <div class="alert alert-info">
            Duration: {{ $test->duration_minutes }} minutes
        </div>
    </div>
    <p>{{ $test->description }}</p>
    <form id="examForm" action="{{ route('student.tests.submit', $test->id) }}" method="POST">
        @csrf
        @foreach($test->questions as $index => $question)
        <div class="card mb-3 p-3">
            <h6>
                Q{{ $index + 1 }}. {{ $question->question_text }}
            </h6>
            @foreach($question->options as $option)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required>
                <label class="form-check-label">{{ $option->option_text }} </label>
            </div>
            @endforeach
        </div>
        @endforeach
        <button class="btn btn-success">Submit Test</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let totalTime = {{ $test->duration_minutes * 60 }};
    let timerBox = document.getElementById('timerBox');
    let timerText = document.getElementById('timer');
    let storageKey = "test_timer_{{ $test->id }}";
    // ⛳ Get saved time OR start fresh
    let savedTime = localStorage.getItem(storageKey);
    let timer = savedTime ? parseInt(savedTime) : totalTime;
    function formatTime(seconds) {
        let h = Math.floor(seconds / 3600);
        let m = Math.floor((seconds % 3600) / 60);
        let s = seconds % 60;
        return `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
    }
    function updateTimer() {
        timerText.innerHTML = formatTime(timer);
        // ⚠ last 10 min warning
        if (timer <= 600) {
            timerBox.classList.remove('bg-success');
            timerBox.classList.add('bg-danger','text-white','blink');
        }
        // ⛔ auto submit
        if (timer <= 0) {
            localStorage.removeItem(storageKey);
            document.getElementById('examForm').submit();
            return;
        }
        // 💾 SAVE EVERY SECOND
        localStorage.setItem(storageKey, timer);
        timer--;
    }

    updateTimer();
    let timerInterval = setInterval(updateTimer, 1000);

    // 🧹 Clear timer on submit
    document.getElementById('examForm').addEventListener('submit', function () {
        localStorage.removeItem(storageKey);
    });

});
</script>
@endsection