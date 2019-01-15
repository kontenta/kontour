<button aria-expanded="true" hidden>Menu</button>
<ul data-kontour-widget="menu">
@foreach($links as $heading => $headingLinks)
  @if(count($headingLinks))
    <li>
      <small>{{ $heading }}</small>
      <ul>
      @foreach($headingLinks as $link)
        <li{!! preg_match('#'.$link->getUrl().'#', url()->full()) ? ' aria-current="true"' : '' !!}>{{ $link }}</li>
      @endforeach
      </ul>
    </li>
  @endif
@endforeach
</ul>

<script>
var navButton = document.querySelector('nav button');

navButton.addEventListener('click', function() {
  let wasExpanded = this.getAttribute('aria-expanded') === 'true' || false;
  this.setAttribute('aria-expanded', !wasExpanded);
  this.hidden = false;
  let menu = this.nextElementSibling;
  menu.hidden = wasExpanded;
});

navButton.click();
</script>
