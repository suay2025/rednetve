<div class="marcas-productos border border-1">
    <div class="d-flex justify-content-evenly">
        @foreach($manufacturers as $manufacturer )
            <form action="/searchM" method="get">
                @csrf
                <button class="border border-0" type="submit"><img src="{{ $manufacturer->avatar_url }}" style="width: 100%;" alt=""></button>
                <input type="hidden" name="words" value="{{ $manufacturer->name }}">
            </form>
        @endforeach
    </div>
</div>
