@if ($messages ?? false)
    <div class="error-messages">
        @foreach ((array) $messages as $message)
            <div class="error-message">{{ $message }}</div>
        @endforeach
    </div>
@endif
