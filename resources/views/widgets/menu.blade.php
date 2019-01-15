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
window.addEventListener('load', function () {
  let button = document.querySelector('nav > button');
  let nav = button.parentElement;
  let menu = button.nextElementSibling;

  button.addEventListener('click', function() {
    let wasExpanded = this.getAttribute('aria-expanded') === 'true' || false;
    this.setAttribute('aria-expanded', !wasExpanded);
    this.hidden = false;
    nav.setAttribute('data-kontour-expanded', !wasExpanded);
    menu.hidden = wasExpanded;
  });

  if(nav.offsetWidth >= nav.parentElement.offsetWidth) {
    button.click();
  }
}, false);
</script>
