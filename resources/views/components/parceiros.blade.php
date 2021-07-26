<div class="parceiros">
    <h2>Conheça os nossos parceiros</h2>

    <div class="parceiros-slider swiper-container">
        <div class="swiper-wrapper">
            @for($i = 0; $i < 5; $i++)
            <div class="swiper-slide">
                <img src="https://picsum.photos/1920/1080" alt="">
            </div>
            @endfor
        </div>

        <div class="swiper-button-prev parceiros-prev"></div>
        <div class="swiper-button-next parceiros-next"></div>
    </div>
</div>
