<div>  
  <div class="l-content-container paragraph paragraph--type--headline-band paragraph--view-mode--default">
  <section class="headline-band  h2 headline-band__underline">
    <div class="headline-band__inner">
      <h2 class="headline-band__title h2">
        Digitized Media Gallery
      </h2>
    </div>
  </section>
  </div>
</div>
<div>  
  <div class="l-center l-content-container paragraph paragraph--type--two-up-layout paragraph--view-mode--default">
    <section class="l-two-up">
        <div class="two-up-layout--content-first">
          <h4 class="headline-band__title h4">
            {{ $data[1]['title'] }}
          </h4>
          {!! $data[1]['media_url'] !!}
          <h4 class="headline-band__title h4">
            {{ $data[2]['title'] }}
          </h4>
          {!! $data[2]['media_url'] !!}
        </div>
        <div class="two-up-layout--content-second">
          <h4 class="headline-band__title h4">
            {{ $data[3]['title'] }}
          </h4>
          {!! $data[3]['media_url'] !!}
          <h4 class="headline-band__title h4">
            {{ $data[4]['title'] }}
          </h4>
          {!! $data[4]['media_url'] !!}
        </div>
      </section>
  </div>
</div>