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
    <section class="l-two-up-50-50">
      <div class="two-up-layout--content-first">
        {!! $data[1]['media_url'] !!}
      </div>
      <div class="two-up-layout--content-second">
        {!! $data[2]['media_url'] !!}
      </div>
    </section>
    <section class="l-two-up-50-50 body-text">
      <div class="two-up-layout--content-first">
        <h3 class="headline-band__title">
          {{ $data[1]['title'] }}
        </h3>
        Description 1
      </div>
      <div class="two-up-layout--content-second">
        <h3 class="headline-band__title">
          {{ $data[2]['title'] }}
        </h3>
        Description 2
      </div>
    </section>
    <br>
    <section class="l-two-up-50-50">
      <div class="two-up-layout--content-first">
        {!! $data[3]['media_url'] !!}
      </div>
      <div class="two-up-layout--content-second">
        {!! $data[4]['media_url'] !!}
      </div>
    </section>
    <section class="l-two-up-50-50 body-text">
      <div class="two-up-layout--content-first">
        <h3 class="headline-band__title">
          {{ $data[3]['title'] }}
        </h3>
        Description 3
      </div>
      <div class="two-up-layout--content-second">
        <h3 class="headline-band__title">
          {{ $data[4]['title'] }}
        </h3>
        Description 4
      </div>
    </section>
  </div>
</div>