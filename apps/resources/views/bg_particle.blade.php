@php
    $css = [];
    foreach ([
        'position' => 'fixed',
        'top' => 0,
        'left' => '0',
        'z-index' => '0',
        'width' => '100vw',
        'height' => '100vh',
        'background-color' => '#eff6ff',
        'background-image' => "url('/assets/img/bg.png')"
    ] as $key => $value) {
        $css[] = $key . ':' . $value;
    }
@endphp
<div id="particles-bg" class="particles-container particles-bg" style="{{ implode(';', $css) }}"></div>
