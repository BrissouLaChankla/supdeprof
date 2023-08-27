<div class="text-center mt-4">

<h1 class="ml1">
    <span class="text-wrapper">
        <span class="line line1"></span>
        <span class="letters">{{ $text }}</span>
        <span class="line line2"></span>
    </span>
</h1>
</div>
<style>
    .ml1 {
        font-weight: 900;
        font-size: 3em;
    }

    .ml1 .letter {
        display: inline-block;
        line-height: 1em;
    }

    .ml1 .text-wrapper {
        position: relative;
        display: inline-block;
        padding-top: 0.1em;
        padding-right: 0.05em;
        padding-bottom: 0.15em;
    }

    .ml1 .line {
        opacity: 0;
        position: absolute;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: black;
        transform-origin: 0 0;
    }

    .ml1 .line1 {
        top: 0;
    }

    .ml1 .line2 {
        bottom: 0;
    }
</style>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        var textWrapper = document.querySelector('.ml1 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({
                loop: false
            })
            .add({
                targets: '.ml1 .letter',
                scale: [0.3, 1],
                opacity: [0, 1],
                translateZ: 0,
                easing: "easeOutExpo",
                duration: 600,
                delay: (el, i) => 70 * (i + 1)
            }).add({
                targets: '.ml1 .line',
                scaleX: [0, 1],
                opacity: [0.5, 1],
                easing: "easeOutExpo",
                duration: 700,
                offset: '-=875',
                delay: (el, i, l) => 80 * (l - i)
            });
    </script>
@endpush
