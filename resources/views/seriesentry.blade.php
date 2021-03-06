<h2 class = "headline-band__title l-center">
    {{ $data['entry_title'] }}
</h2>
<h3 class="headline-band__title l-center">{{ $data['agent_name'] }}</h3>

<div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
    <div class="body-text"><p>{{ $data['entry_description'] }}</p></div>
    <section class="cta-links">
      <a href="{{ $data['uri_link'] }}" target="_blank" class="chevron-link">Read More</a>
    </section>
</div>

<div class="l-center l-content-container paragraph paragraph--type--two-up-layout paragraph--view-mode--default">
  <section class="l-two-up-50-50">
    <div class="two-up-layout--content-first">
      @include('emulation', ['emulation_data' => $data['emulation_data']])
    </div>
    <div class="two-up-layout--content-second">
      @if (empty($data['history_data']))
        @include('lab')
      @else 
        @include('oralhistory', ['history_data' => $data['history_data']])
      @endif
    </div>
  </section>
</div>