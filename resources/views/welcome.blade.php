<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sokolis</title>

        <!-- Fonts --> 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="home_style.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
        </style>
    </head>
    
  <body
    x-data="{ page: 'home', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'b eh': darkMode === true}"
  >
    <!-- ===== Header Start ===== -->
    <header
  class="g s r vd ya cj"
  :class="{ 'hh sm _k dj bl ll' : stickyMenu }"
  @scroll.window="stickyMenu = (window.pageYOffset > 20) ? true : false"
>
  <div class="bb ze ki xn 2xl:ud-px-0 oo wf yf i">
    <div class="vd to/4 tc wf yf">
      <a href="#" @click="page = 'home'">
        <img class="om" src="images/logo-light.svg" alt="Logo Light" />
        <img class="xc nm" src="images/logo-dark.svg" alt="Logo Dark" />
      </a>

      <!-- Hamburger Toggle BTN -->
      <button class="po rc" @click="navigationOpen = !navigationOpen">
        <span class="rc i pf re pd">
          <span class="du-block h q vd yc">
            <span class="rc i r s eh um tg te rd eb ml jl dl" :class="{ 'ue el': !navigationOpen }"></span>
            <span class="rc i r s eh um tg te rd eb ml jl fl" :class="{ 'ue qr': !navigationOpen }"></span>
            <span class="rc i r s eh um tg te rd eb ml jl gl" :class="{ 'ue hl': !navigationOpen }"></span>
          </span>
          <span class="du-block h q vd yc lf">
            <span class="rc eh um tg ml jl el h na r ve yc" :class="{ 'sd dl': !navigationOpen }"></span>
            <span class="rc eh um tg ml jl qr h s pa vd rd" :class="{ 'sd rr': !navigationOpen }"></span>
          </span>
        </span>
      </button>
      <!-- Hamburger Toggle BTN -->
    </div>

    <div
      class="vd wo/4 sd qo f ho oo wf yf"
      :class="{ 'd hh rm sr td ud qg ug jc yh': navigationOpen }"
    >
    
      <nav>
        <ul class="tc _o sf yo cg ep">
          <li><a href="#o-sokolisu" class="xl" :class="{ 'mk': page === 'o-sokolisu' }" @click="page = 'o-sokolisu'">O Sokolisu</a></li>
          <li><a href="#aktivnosti" class="xl" :class="{ 'mk': page === 'aktivnosti' }" @click="page = 'aktivnosti'">Aktivnosti</a></li>
          <li><a href="#higijena" class="xl" :class="{ 'mk': page === 'higijena' }" @click="page = 'higijena'">Higijena</a></li>
          <li><a href="#obezbedjenje" class="xl" :class="{ 'mk': page === 'obezbedjenje' }" @click="page = 'obezbedjenje'">Obezbeđenje</a></li>
        </ul>
      </nav>

      <div class="tc wf ig pb no">
        <div class="pc h io pa ra" :class="navigationOpen ? '!-ud-visible' : 'd'">
          <label class="rc ab i">
            <input type="checkbox" :value="darkMode" @change="darkMode = !darkMode" class="pf vd yc uk h r za ab" />
            <!-- Icon Sun -->
            <svg :class="{ 'wn' : page === 'home', 'xh' : page === 'home' && stickyMenu }" class="th om" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z" fill=""/>
            </svg>
            <!-- Icon Sun -->
            <img class="xc nm" src="images/icon-moon.svg" alt="Moon" />
          </label>
        </div>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" :class="{ 'nk yl' : page === 'home', 'ok' : page === 'home' && stickyMenu }" class="ek pk xl">Početna</a>
            @else
                <a href="{{ route('login') }}" :class="{ 'nk yl' : page === 'home', 'ok' : page === 'home' && stickyMenu }" class="ek pk xl">Prijavi se</a>
            @endauth
        @endif
        <!-- <a href="signup.html" :class="{ 'hh/[0.15]' : page === 'home', 'sh' : page === 'home' && stickyMenu }" class="lk gh dk rg tc wf xf _l gi hi">Sign Up</a> -->
      </div>
    </div>
  </div>
</header>

    <!-- ===== Header End ===== -->

    <main>
      <!-- ===== Hero Start ===== -->
      <section class="gj do ir hj sp jr i pg">
        <!-- Hero Images -->
        <div class="xc fn zd/2 2xl:ud-w-187.5 bd 2xl:ud-h-171.5 h q r">
          <!-- <img src="images/shape-01.svg" alt="shape" class="xc 2xl:ud-block h t -ud-left-[10%] ua" /> -->
          <!-- <img src="images/shape-02.svg" alt="shape" class="xc 2xl:ud-block h u p va" /> -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16" stroke-width="0.75" stroke="currentColor" class="svgcolor-green svghghwdh xc 2xl:ud-block h u p wa" ><g id="clean-broom-wipe"><path id="Rectangle 21" stroke-linecap="square" d="M1.5110625 10.537C1.78075 9.354625 2.8323125 8.5159375 4.0450625 8.5159375H4.0450625C5.4805625000000004 8.5159375 6.64425 9.679625 6.64425 11.115124999999999V11.46825C6.64425 12.0765 6.8464375 12.6675625 7.2190625 13.1483125L8.072312499999999 14.2491875H0.66425L1.5110625 10.537Z"></path><path id="Vector 2098" stroke-linecap="square" d="M4.3445 8.421375L7.132562500000001 0.7508125"></path><path id="Vector 2097" stroke-linecap="square" d="M11.085812500000001 14.2489375H14.33575"></path><path id="Vector 2099" stroke-linecap="square" d="M9.982 11.7543125H13.232"></path><path id="Vector 2100" stroke-linecap="square" d="M8.602375 9.12725H11.8523125"></path></g></svg>
         <!--  <img src="images/shape-03.svg" alt="shape" class="xc 2xl:ud-block h v w va" /> -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="svgcolor-yelow svghghwdh xc 2xl:ud-block h v w wa"><path  stroke-linecap="round" stroke-linejoin="round" d="M19.5001 14.562h1.5l0.45 -2.7h1.8l-1.35 -4.04999c-0.45 -1.35 -1.007 -2.25 -2.25 -2.25s-1.8 0.9 -2.25 2.25l-0.267 0.8"  ></path><path  stroke-linecap="round" stroke-linejoin="round" d="M17.85 2.86201c0 0.23638 0.0465 0.47045 0.137 0.68883 0.0905 0.21839 0.223 0.41682 0.3902 0.58396 0.1671 0.16715 0.3656 0.29974 0.5839 0.3902 0.2184 0.09045 0.4525 0.13701 0.6889 0.13701 0.2364 0 0.4704 -0.04656 0.6888 -0.13701 0.2184 -0.09046 0.4168 -0.22305 0.584 -0.3902 0.1671 -0.16714 0.2997 -0.36557 0.3902 -0.58396 0.0904 -0.21838 0.137 -0.45245 0.137 -0.68883 0 -0.23638 -0.0466 -0.47044 -0.137 -0.68883 -0.0905 -0.21838 -0.2231 -0.41681 -0.3902 -0.58396 -0.1672 -0.16715 -0.3656 -0.29973 -0.584 -0.39019 -0.2184 -0.09046 -0.4524 -0.13702 -0.6888 -0.13702 -0.2364 0 -0.4705 0.04656 -0.6889 0.13702 -0.2183 0.09046 -0.4168 0.22304 -0.5839 0.39019 -0.1672 0.16715 -0.2997 0.36558 -0.3902 0.58396 -0.0905 0.21839 -0.137 0.45245 -0.137 0.68883Z"  ></path><path  stroke-linecap="round" stroke-linejoin="round" d="M4.5 14.562H3l-0.45 -2.7H0.75L2.1 7.81201c0.45 -1.35 1.007 -2.25 2.25 -2.25s1.8 0.9 2.25 2.25l0.267 0.8"  ></path><path  stroke-linecap="round" stroke-linejoin="round" d="M2.55005 2.86201c0 0.23638 0.04656 0.47045 0.13702 0.68883 0.09045 0.21839 0.22304 0.41682 0.39019 0.58396 0.16714 0.16715 0.36557 0.29974 0.58396 0.3902 0.21838 0.09045 0.45245 0.13701 0.68883 0.13701 0.23638 0 0.47044 -0.04656 0.68883 -0.13701 0.21839 -0.09046 0.41682 -0.22305 0.58396 -0.3902 0.16715 -0.16714 0.29973 -0.36557 0.39019 -0.58396 0.09046 -0.21838 0.13702 -0.45245 0.13702 -0.68883 0 -0.47739 -0.18964 -0.93523 -0.52721 -1.27279 -0.33756 -0.33757 -0.7954 -0.52721 -1.27279 -0.52721 -0.47739 0 -0.93523 0.18964 -1.27279 0.52721 -0.33757 0.33756 -0.52721 0.7954 -0.52721 1.27279Z"  ></path><path  stroke-linecap="round" stroke-linejoin="round" d="M9.36304 5.7952c0 0.69938 0.27782 1.37011 0.77236 1.86464 0.4945 0.49454 1.1653 0.77236 1.8646 0.77236 0.6994 0 1.3701 -0.27782 1.8647 -0.77236 0.4945 -0.49453 0.7723 -1.16526 0.7723 -1.86464 0 -0.69937 -0.2778 -1.3701 -0.7723 -1.86464 -0.4946 -0.49453 -1.1653 -0.77236 -1.8647 -0.77236 -0.6993 0 -1.3701 0.27783 -1.8646 0.77236 -0.49454 0.49454 -0.77236 1.16527 -0.77236 1.86464Z"  ></path><path  stroke-linecap="round" stroke-linejoin="round" d="M16.615 14.367c0 -1.224 -0.4862 -2.3979 -1.3517 -3.2633 -0.8655 -0.8655 -2.0393 -1.35175 -3.2633 -1.35175 -1.224 0 -2.39781 0.48625 -3.26329 1.35175 -0.86548 0.8654 -1.3517 2.0393 -1.3517 3.2633v1.978h1.978l0.65899 6.593h3.956l0.659 -6.593h1.978v-1.978Z"></path></svg>
          <img src="images/shape-04.svg" alt="shape" class="h q r" />
          <img src="images/hero.png" alt="Sokolis" class="h q r ua" />
          <img src="images/shape-19.svg" alt="shape" class="h q r va" /> 
        </div>

        <!-- Hero Content -->
        <div class="bb ze ki xn 2xl:ud-px-0">
          <div class="tc _o">
            <div class="animate_left jn/2">
              <h2 class="vj">Dobrodošli</h2>
              <h1 class="fk vj zp or kk-green wm wb">SOKOLIS</h1>
              <div class="tc tf yo zf mb">
                <a href="https://sokolis.rs/" target="_blank" class="ek jk lk gh gi hi rg ml il vc _d _l">Prodaja dostupnih stanova i lokala</a>
              </div>
              <p class="tj jb">
                Portal za stanare kondominijuma sa svim informacijama vezanim za stanovanje i servise.
              </p>

              <div class="tc tf yo zf mb">               

                <span class="tc sf">
                  <a href="#" class="inline-block ek xj kk wm"> Pozovite nas (+381) 64 186 27 87 </a>
                  <span class="inline-block">Za sve informacije</span>
                </span>
              </div>
            </div>
          </div>
        </div>
    </section>
      <!-- ===== Hero End ===== -->

      <!-- ===== Small Features Start ===== -->
    <!-- <section>
        <div style="margin-bottom: 70px; padding-bottom: 70px;" class="bb ze ki yn 2xl:ud-px-12.5">
          <div class="tc uf zo xf ap zf bp mq">
           
            <div class="animate_top kn to/3 tc cg oq">
              <div class="tc wf xf cf ae cd rg mh">
                <img src="images/icon-01.svg" alt="Icon" />
              </div>
              <div>
                <h4 class="ek yj go kk wm xb">Podrška 24/7</h4>
                <p>Obezbeđenje, video nadzor, recepcija. </p>
              </div>
            </div>

            <div class="animate_top kn to/3 tc cg oq">
              <div class="tc wf xf cf ae cd rg nh">
                <img src="images/icon-02.svg" alt="Icon" />
              </div>
              <div>
                <h4 class="ek yj go kk wm xb">Zelena oaza</h4>
                <p>Pažljivo projektovan vrt sa sadržajima za decu i odrasle.</p>
              </div>
            </div>

            <div class="animate_top kn to/3 tc cg oq">
              <div class="tc wf xf cf ae cd rg oh">
                <img src="images/icon-03.svg" alt="Icon" />
              </div>
              <div>
                <h4 class="ek yj go kk wm xb">Aktivnosti</h4>
                <p>Zajedničke celine projektovane za niz različitih aktivnosti.</p>
              </div>
            </div>
          </div>
        </div>
    </section> -->
      <!-- ===== Small Features End ===== -->


      <!-- ===== Team Start ===== -->
    <section id="o-sokolisu" class="i pg ji gp uq">
        <!-- Bg Shapes -->
        <span class="rc h s r vd fd/6 fh rm"></span>
        <img src="images/shape-08.svg" alt="Shape Bg" class="h q r" />
        <!-- <img src="images/shape-09.svg" alt="Shape" style="width: 50px;" class="of h y z/2" /> -->
        <!-- <img src="images/shape-10.svg" alt="Shape" class="h _ aa" /> -->
       <!--  <img src="images/shape-11.svg" alt="Shape" style="width: 70px;" class="of h m ba" /> -->

        <!-- Section Title Start -->
        <div
          x-data="{ sectionTitle: `Kondominijum Sokolis`, sectionTitleText: `Kompleks „Sokolis“ odlikuje najsavremeniji koncept stanova, prilagođen zahtevima moderne porodice. Kondominijum je pozicioniran u Staroj radničkoj koloniji, mirnom i zelenom naselju Kragujevca, tačno prekoputa Sokolane. Lokacija obezbeđuje blizinu svih potrebnih sadržaja za savremen život, uz posebne pogodnosti za relaksaciju i rekreaciju. „Sokolis“ je okružen poslovnim centrima, kulturno-istorijskim znamenitostima i gustim zelenilom. Ovo mesto, poznato kao „zeleni grad“, pre 100 godina postalo je prva planski izgrađena radnička kolonija u Srbiji. Savršeni spoj gradskog i prirodnog okruženja čini ga idealnim za život, blizu centra.`}"
        >
          <div class="animate_top bb ze rj ki xn vq">
                <h2
                    x-text="sectionTitle"
                    class="fk vj pr kk-green wm on/5 gq/2 bb _b">
                </h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>
        </div>
        <!-- Section Title End -->

        <div class="bb ze i va ki xn xq jb jo">
          <div class="wc qf pn xo gg cp">
            <!-- Team Item -->
            <div class="animate_top rj">
              <div class="c i pg z-1">
                <img class="vd" src="images/team-01.png" alt="Dvoriste" />

                <div class="ef im nl il">
                  <span class="h -ud-left-5 -ud-bottom-21 rc de gd gh if wa"></span>
                  <span class="h s p rc vd hd mh va"></span>
                  <div class="h s p vd ij jj xa">
                    <ul class="tc xf wf gg">
                      <li>
                        <a href="https://www.facebook.com/sokoliskg/">
                        <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                        </a>
                      </li>
                      <li>
                        <a href="https://www.instagram.com/sokolis.kragujevac/">
                        <svg class="uh vllhow ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/></svg>
                        </a>
                      </li>
                      <li>
                        <a href="https://www.youtube.com/@gradingrs">
                        <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/></svg>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <h4 class="yj go kk wm ob zb">Prostrano dvorište</h4>
              <p>Sa zelenilom i igralištima</p>
            </div>

            <!-- Team Item -->
            <div class="animate_top rj">
              <div class="c i pg z-1">
                <img class="vd" src="images/team-02.png" alt="Okolina" />

                <div class="ef im nl il">
                  <span class="h -ud-left-5 -ud-bottom-21 rc de gd gh if wa"></span>
                  <span class="h s p rc vd hd mh va"></span>
                  <div class="h s p vd ij jj xa">
                    <ul class="tc xf wf gg">
                      <li>
                          <a href="https://www.facebook.com/sokoliskg/">
                          <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                          </a>
                        </li>
                        <li>
                          <a href="https://www.instagram.com/sokolis.kragujevac/">
                          <svg class="uh vllhow ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/></svg>
                          </a>
                        </li>
                        <li>
                          <a href="https://www.youtube.com/@gradingrs">
                          <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/></svg>
                          </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <h4 class="yj go kk wm ob zb">Prijatna okolina</h4>
              <p>Oaza udobnosti i mira - blizina spomen parka Šumarice</p>
            </div>

            <!-- Team Item -->
            <div class="animate_top rj">
              <div class="c i pg z-1">
                <img class="vd" src="images/team-03.png" alt="Stanovi" />

                <div class="ef im nl il">
                  <span class="h -ud-left-5 -ud-bottom-21 rc de gd gh if wa"></span>
                  <span class="h s p rc vd hd mh va"></span>
                  <div class="h s p vd ij jj xa">
                    <ul class="tc xf wf gg">
                        <li>
                          <a href="https://www.facebook.com/sokoliskg/">
                          <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                          </a>
                        </li>
                        <li>
                          <a href="https://www.instagram.com/sokolis.kragujevac/">
                          <svg class="uh vllhow ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/></svg>
                          </a>
                        </li>
                        <li>
                          <a href="https://www.youtube.com/@gradingrs">
                          <svg class="uh vl ml il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/></svg>
                          </a>
                        </li>
                    </ul>
                  </div>
                </div>
              </div>

              <h4 class="yj go kk wm ob zb">Savremeni stanovi</h4>
              <p>Zajedničke prostorije i uređena bašta. <br /> Stil, Komfor i Pristupačnost</p>
            </div>
          </div>
        </div>
      </section>
      <!-- ===== Team End ===== -->

      <!-- ===== Services Start ===== -->
      <section id="aktivnosti" class="lj tp kr ej">
        <!-- Section Title Start -->
        <div 
            x-data="{ sectionTitle: `Aktivnosti`, sectionTitleText: `U okviru kondominijuma, zajedničke površine pružaju stanarima raznovrsne mogućnosti za aktivnosti. Od rekreacije i opuštanja do druženja, svaki stanar može pronaći nešto za sebe.`}"
        >
            <div class="animate_top bb ze rj ki xn vq">
                <h2
                x-text="sectionTitle"
                class="fk vj pr kk-green wm on/5 gq/2 bb _b"
                ></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>


        </div>
        <!-- Section Title End -->

        <div class="bb ze ki xn yq mb en">
          <div class="wc qf pn xo ng">
            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/aktivnosti_1.jpg" alt="Igralista" />
              <h4 class="ek zj kk wm nb _b">Dečija igrališta</h4>
              <p>Uživajte u sigurnom i stimulativnom okruženju koje podstiče igru i kreativnost.</p>
            </div>

            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/aktivnosti_2.jpg" alt="Vrt" />
              <h4 class="ek zj kk wm nb _b">Vrt</h4>
              <p>Pažljivo projektovan vrt obogaćuje unutrašnji prostor.</p>
            </div>

            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/aktivnosti_3.jpg" alt="Zajedničke prostorije" />
              <h4 class="ek zj kk wm nb _b">Rekreacija</h4>
              <p>Zdrav i aktivan način života u sklopu kompleksa.</p>
            </div>

          </div>
        </div>
      </section>
      <!-- ===== Services End ===== -->

      <!-- ===== Pricing Table Start ===== -->
      <section id="higijena" x-data="setup()" class="i pg fh rm ji gp uq">
        <!-- Bg Shapes -->
        <!-- <img src="images/shape-06.svg" alt="Shape" class="h aa y" /> -->
        <!-- <img src="images/shape-03.svg" alt="Shape" class="h ca u" /> -->
        <!-- <img src="images/shape-07.svg" alt="Shape" class="h w da ee" /> -->
        <img src="images/shape-12.svg" alt="Shape" class="h p s ua" />
        <img src="images/shape-13.svg" alt="Shape" class="h r q ua" />

        <!-- Section Title Start -->
        <div x-data="{ sectionTitle: `Higijena`, sectionTitleText: `Redovno čišćenje se izvodi prema rasporedu koji je prikazan na nedeljnom nivou.`}"
            >
          <div class="animate_top bb ze rj ki xn vq">
                <h2
                    x-text="sectionTitle"
                    class="fk vj pr kk-green wm on/5 gq/2 bb _b"
                ></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
           </div>
        </div>
        <!-- Section Title End -->
        <div class="animate_top bb ze i ki li xn br rj">
            <h2 class="ek bk _p kk-green wm hc">&nbsp;</h2>
        </div>
        <div class="animate_top bb ze i ki li xn br rj">
            <h2 class="ek bk _p kk-green wm hc">Raspored čišćenja</h2>
        </div>
        <div class="bb ze i ki li xn br">
          <div class="tc uf tn xf gg">
            <div class="animate_top me/6 ln rj">
              <h2 class="ek bk _p kk wm hc xe/3">Lamela 2</h2>
              <p class="ek bk aq">Ponedeljak 14:00 </p>
              <p class="ek bk aq">Četvrtak 16:00 </p>
            </div>
            <div class="animate_top me/6 ln rj">
              <h2 class="ek bk _p kk wm hc xe/3">Lamela 3</h2>
              <p class="ek bk aq">Ponedeljak 16:00 </p>
              <p class="ek bk aq">Četvrtak 18:00 </p>
            </div>
            <div class="animate_top me/6 ln rj">
              <h2 class="ek bk _p kk wm hc xe/3">Lamela 4</h2>
              <p class="ek bk aq">Utorak 14:00 </p>
              <p class="ek bk aq">Petak 12:00 </p>
            </div>
            <div class="animate_top me/6 ln rj">
              <h2 class="ek bk _p kk wm hc xe/3">Garaža</h2>
              <p class="ek bk aq">Sreda 12:00 </p>
              <p class="ek bk aq">Subota 12:00 </p>
            </div>
            <div class="animate_top me/6 ln rj">
              <h2 class="ek bk _p kk wm hc xe/3">Dvorište</h2>
              <p class="ek bk aq">Ponedeljak 14:00 </p>
              <p class="ek bk aq">Četvrtak 16:00 </p>
            </div>
          </div>
        </div>


        

      </section>
      <!-- ===== Pricing Table End ===== -->

      <!-- ===== Projects Start ===== -->
      <section id="obezbedjenje" class="pg pj vp mr oj wp nr i">
        <img src="images/shape-01.svg" alt="Shape" style="width: 70px;" class="of h m z/2" />
        <img src="images/shape-02.svg" alt="Shape" style="width: 50px;" class="of h y" />
        <!-- Section Title Start -->
        <div
          x-data="{ sectionTitle: `Obezbedjenje - Bezbednost`, sectionTitleText: `Kondominijum „Sokolis“ nudi sigurnost za svoje stanare. Kupovinom nekretnine birate dom u zaštićenoj zoni sa kontrolom pristupa, 24/7 nadzorom, kartičnim pristupom, video-nadzorom, savremenim protivpožarnim sistemima, privatnim parkom kao oazom mira i podzemnim garažama.`}"
        >
          <div class="animate_top bb ze rj ki xn vq">
                <h2
                        x-text="sectionTitle"
                        class="fk vj pr kk-green wm on/5 gq/2 bb _b"
                >
                </h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>


        </div>
        <!-- Section Title End -->
        <div class="bb ze ki xn yq mb en">
          <div class="wc qf pn xo ng">
            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/obezb_2.jpg" alt="Obezbedjenje" />
              <h4 class="ek zj kk wm nb _b">Video nadzor</h4>
              <p>Naš savremeni sistem video nadzora obezbeđuje 24/7 praćenje zajedničkih prostora, čime se omogućava bezbednost svih stanara i poslovnih korisnika. Uz najnovije tehnologije, svi aspekti kompleksa su pod stalnim nadzorom, što stvara sigurno i ugodno okruženje za život i rad.</p>
            </div>

            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/obezb_1.jpg" alt="Obezbedjenje" />
              <h4 class="ek zj kk wm nb _b">Kontrola pristupa</h4>
              <p>U kompleksu Sokolis, bezbednost je prioritet. Implementirali smo napredne sisteme kontrole pristupa koji osiguravaju da samo ovlašćeni posetioci mogu ući u naše prostore.</p>
            </div>

            <!-- Service Item -->
            <div class="animate_top sg oi pi zq ml il am cn _m">
              <img src="images/obezb_3.jpg" alt="Protivpožarni sistem" />
              <h4 class="ek zj kk wm nb _b">Protivpožarni sistem</h4>
              <p>Sistem uključuje detektore dima, automatske sprinkler sisteme i jasno označene evakuacione puteve.</p>
            </div>

          </div>
        </div>
       
      </section>
      <!-- ===== Projects End ===== -->

      <!-- ===== Counter Start ===== -->
      <section class="i pg qh rm ji hp">
        <img src="images/shape-15.svg" alt="Shape" class="h q p" />

        <div class="bb ze i va ki xn br">
          <div class="tc uf sn tn xf un gg">
            <div class="animate_top me/5 ln rj">
              <h2 class="gk vj zp or kk wm hc">628</h2>
              <p class="ek bk aq">Stanova</p>
            </div>
            <div class="animate_top me/5 ln rj">
              <h2 class="gk vj zp or kk wm hc">12</h2>
              <p class="ek bk aq">Lamema</p>
            </div>
            <div class="animate_top me/5 ln rj">
              <h2 class="gk vj zp or kk wm hc">14</h2>
              <p class="ek bk aq">Poslovnih prostora</p>
            </div>
            <div class="animate_top me/5 ln rj">
              <h2 class="gk vj zp or kk wm hc">679</h2>
              <p class="ek bk aq">Parking mesta</p>
            </div>
          </div>
        </div>
      </section>
      <!-- ===== Counter End ===== -->

      
</main>
    <!-- ===== Footer Start ===== -->
<footer>
  <div class="bb ze ki xn 2xl:ud-px-0">
    <!-- Footer Top -->
    <div class="ji gp">
      <div class="tc uf ap gg fp">
        <div class="animate_top zd/2 to/4">
          <a href="index.html">
            <img src="images/logo-footer-light.svg" alt="Logo" class="om" style="height: 150px;" />
            <img src="images/logo-footer-dark.svg" alt="Logo" class="xc nm" style="height: 150px;" />
          </a>

          <p class="lc fb">Jedinstven spoj gradskog i prirodnog okruženja. Lokacija idealna za život, a veoma blizu centra.</p>

          <ul class="tc wf cg">
            <li>
              <a href="https://www.facebook.com/sokoliskg/">
                <svg class="vh ul cl il" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_48_1499)">
                    <path d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47 14 5.5 16 5.5H17.5V2.14C17.174 2.097 15.943 2 14.643 2C11.928 2 10 3.657 10 6.7V9.5H7V13.5H10V22H14V13.5Z" fill="" />
                  </g>
                  <defs>
                    <clipPath id="clip0_48_1499">
                      <rect width="24" height="24" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/sokolis.kragujevac/">
                <!-- Insta -->
                <a href="https://www.instagram.com/sokolis.kragujevac/">
                <svg class="vhinsta cl il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/></svg>
              </a>
            </li>
            <li>
              <a href="https://www.youtube.com/@gradingrs">
              <svg class="vh ul cl il" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/></svg>
              </a>
            </li>
          </ul>
        </div>



        <div class="vd so tc sf rn un gg vn">

          <div class="animate_top">
            <h4 class="kk wm tj ec">::</h4>
             
            <ul>
              <li><a href="#" class="sc xl vb" @click="page = 'o-sokolisu'">O Sokolisu</a></li>
              <li><a href="#aktivnosti" class="sc xl vb"  @click="page = 'aktivnosti'">Aktivnosti</a></li>
              <li><a href="#higijena" class="sc xl vb" @click="page = 'higijena'">Higijena</a></li>
              <li><a href="#obezbedjenje" class="sc xl vb" @click="page = 'obezbedjenje'">Obezbeđenje</a></li>
            </ul>
          </div>

          
        </div>
      </div>
    </div>
    <!-- Footer Top -->

    <!-- Footer Bottom -->
    <div class="bh ch pm tc uf sf yo wf xf ap cg fp bj">
      <div class="animate_top">
        <ul class="tc wf gg">
          <li><a href="#" class="xl">Politika privatnosti</a></li>
          <li><a href="#" class="xl">Korišćenje kolačića</a></li>
        </ul>
      </div>

      <div class="animate_top">
        <p>&copy; 2024 Grading Sva prava zadržana.</p>
      </div>
    </div>
    <!-- Footer Bottom -->
  </div>
</footer>

    <!-- ===== Footer End ===== -->

    <!-- ====== Back To Top Start ===== -->
    <button
  class="xc wf xf ie ld vg sr gh tr g sa ta _a"
  @click="window.scrollTo({top: 0, behavior: 'smooth'})"
  @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false"
  :class="{ 'uc' : scrollTop }"
>
  <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
  </svg>
</button>

    <!-- ====== Back To Top End ===== -->

    <script>
      //  Pricing Table
      const setup = () => {
        return {
          isNavOpen: false,

          billPlan: 'monthly',

          plans: [
            {
              name: 'Starter',
              price: {
                monthly: 29,
                annually: 29 * 12 - 199,
              },
              features: ['400 GB Storaget', 'Unlimited Photos & Videos', 'Exclusive Support'],
            },
            {
              name: 'Growth Plan',
              price: {
                monthly: 59,
                annually: 59 * 12 - 100,
              },
              features: ['400 GB Storaget', 'Unlimited Photos & Videos', 'Exclusive Support'],
            },
            {
              name: 'Business',
              price: {
                monthly: 139,
                annually: 139 * 12 - 100,
              },
              features: ['400 GB Storaget', 'Unlimited Photos & Videos', 'Exclusive Support'],
            },
          ],
        };
      };
    </script>
  <script defer src="bundle.js"></script>
</body>
</html>
