<div class="space-y-4">
    <h2 class="text-lg font-bold">{{ $notice->subject }}</h2>
    <p><strong>{{ __('models.type') }}:</strong> {{ $notice->type }}</p>
    <p><strong>{{ __('models.message') }}:</strong> {{ $notice->message }}</p>
    <p><strong>{{ __('models.date') }}:</strong> {{ $notice->date }}</p>
</div>