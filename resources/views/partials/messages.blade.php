<div class="messages">
    @foreach (Alert::getMessages() as $type => $messages)
        @foreach ($messages as $message)
            <div class="alert alert-{{ $type }}">{{ $message }}</div>
        @endforeach
    @endforeach
</div>