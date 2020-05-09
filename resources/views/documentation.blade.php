<div>  
  <div class="l-content-container paragraph paragraph--type--headline-band paragraph--view-mode--default">
  <section class="headline-band  h2 headline-band__underline">
    <div class="headline-band__inner">
      <h2 class="headline-band__title h2">
        {{ $documentation_data['title'] }}
      </h2>
    </div>
  </section>
  </div>
</div>
<div>  
  <div class="l-center l-content-container paragraph paragraph--type--two-up-layout paragraph--view-mode--default">
    <section class="l-two-up-50-50">
      <div class="two-up-layout--content-first">
        <img src="{!! $documentation_data['media_url'] !!}">
      </div>
      <div class="two-up-layout--content-second">
        <div class="l-center l-content-container paragraph paragraph--type--text paragraph--view-mode--default">
          <h3>{{ $documentation_data['date'] }}</h3>
        <div class="body-text"><p>{{ $documentation_data['description'] }}</p></div>
        <section class="cta-links">
          <a href="{{ $documentation_data['uri_link'] }}" target="_blank" class="chevron-link">Read More</a>
        </section>
    </div>
      </div>
    </section>
  </div>
</div>