<div>
  <div class="l-content-container paragraph paragraph--type--headline-band paragraph--view-mode--default">
    <section class="headline-band  h2 headline-band__underline">
      <div class="headline-band__inner">
        <h3 class="headline-band__title h3">
          Online Emulation
        </h3>
      </div>
    </section>
  </div>

  <div>
    <a href="{{ $data['emulation_url'] }}" target="_blank"><img srcset="../assets/{{ $emulation[0] }}" sizes="(min-width:880px) 50vw, 100vw." src="../assets/{{ $emulation[0] }}" alt="{{ $emulation[1] }}" typeof="foaf:Image" ></a>
  </div>

  <div class="l-center l-content-container small paragraph paragraph--type--cta-links paragraph--view-mode--default">
    <section class="cta-links">
      <a href="{{ $data['emulation_url'] }}" target="_blank" class="chevron-link">Start Emulation</a>
    </section>
  </div>
</div>