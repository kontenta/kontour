<section data-kontour-widget="message">
  <ol>
    @foreach($messages as $message)
      <li data-kontour-message-level="{{ $message['level'] }}">{{ $message['message'] }}</li>
    @endforeach
  </ol>
</section>
