<div>
    <link rel="stylesheet" href="/css/star.css">
    
    <div class="row">
        <div class="col-md-12">
            <div class="cardStar cardStarV">
                <span wire:click.prevent="valorar1(1)" star = "1" class= "starV {{ ($state['ca_valoracion'] >= 1)? $state['class']:''}} " product="{{ $state['product_id'] }}">★</span>
                <span wire:click.prevent="valorar1(2)" star = "2" class= "starV {{ ($state['ca_valoracion'] >= 2)? $state['class']:''}} " product="{{ $state['product_id'] }}">★</span>
                <span wire:click.prevent="valorar1(3)" star = "3" class= "starV {{ ($state['ca_valoracion'] >= 3)? $state['class']:''}} " product="{{ $state['product_id'] }}">★</span>
                <span wire:click.prevent="valorar1(4)" star = "4" class= "starV {{ ($state['ca_valoracion'] >= 4)? $state['class']:''}} " product="{{ $state['product_id'] }}">★</span>
                <span wire:click.prevent="valorar1(5)" star = "5" class= "starV {{ ($state['ca_valoracion'] >= 5)? $state['class']:''}} " product="{{ $state['product_id'] }}">★</span>
                <h5 class="output" output="{{ $state['product_id'] }}">
                    Puntuación: {{ $state['ca_valoracion'] }}/5
                </h5>
            </div>
        </div>
    </div>

    <script src="/js/star.js"></script>

</div>
