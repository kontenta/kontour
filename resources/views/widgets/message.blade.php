<section data-kontour-widget="message">
  <ol role="list">
    @foreach($messages as $message)
      <li
        data-kontour-message-level="{{ $message['level'] }}"
        role="{{ in_array($message['level'], ['info', 'notice', 'status']) ? 'status' : 'alert' }}"
      >{{ $message['message'] }}</li>
    @endforeach
  </ol>
</section>
