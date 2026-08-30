{{-- Full-page xerox poster collage background (mockup style) --}}
{{-- ponytail: SVG #xerox-threshold filter replaced with CSS grayscale/contrast — SVG filters force software rendering (~seconds of paint time on big images) --}}
<div class="page-collage">
    {{-- edges --}}
    <img src="{{ asset('images/poster1.webp') }}" style="top:-6%;left:-10%;width:42%;height:auto;filter:grayscale(1) contrast(3) brightness(1.15);opacity:0.8;transform:rotate(-7deg);" alt="" decoding="async" fetchpriority="low">
    <img src="{{ asset('images/poster2.webp') }}" style="top:12%;right:-8%;width:38%;height:auto;filter:grayscale(1) contrast(3) brightness(1.15);opacity:0.75;transform:rotate(6deg);" alt="" decoding="async" fetchpriority="low">
    <img src="{{ asset('images/poster3.webp') }}" style="bottom:-10%;left:26%;width:32%;height:auto;filter:grayscale(1) contrast(3) brightness(1.15);opacity:0.75;transform:rotate(-4deg);" alt="" decoding="async" fetchpriority="low">
    {{-- center fill --}}
    <img src="{{ asset('images/punk.webp') }}" style="top:26%;left:34%;width:30%;height:auto;filter:grayscale(0.6) contrast(1.1) brightness(0.85);opacity:0.55;transform:rotate(3deg);" alt="" decoding="async" fetchpriority="low">
    <img src="{{ asset('images/login-poster.webp') }}" style="top:-8%;left:32%;width:28%;height:auto;filter:grayscale(1) contrast(1.2) brightness(0.8);opacity:0.5;transform:rotate(5deg);" alt="" decoding="async" fetchpriority="low">
    <div class="page-collage-fade"></div>
    <div class="page-collage-dots"></div>
</div>
