<div>
    <style>
        
    </style>
                @foreach($menus as $menu)
                    <div class="dropdownM mx-5">
                        @if($menu->origen =='link') 
                            <form action="searchM" method="get" id="{{ $menu->texto }}">
                                @csrf
                                <input type="hidden" name="words" value="{{ $menu->ruta }}">
                                <input type="hidden" name="manufacturer_id" value="{{ $manufacturer_id }}">
                                <input type="hidden" name="modelo_id" value="{{ $modelo_id }}">
                                <input type="hidden" name="motor_id" value="{{ $motor_id }}">
                                <a class="dropbtnM" onclick="sendForm('{{ $menu->texto }}')">{{ $menu->texto }}</a>
                            </form>
                        @else 
                            <a class="dropbtnM" style="top: 100px !important;" > {{ $menu->texto }} </a>
                        @endif
                        @if( $menu->origen == 'categories')
                            <div class="dropdownM-content">
                                @if($menu->subcategories() != null)
                                    @if($menu->subcategories->count() > 0)
                                        @foreach($menu->subcategories as $subcategory)
                                            <form action="searchM" method="get" id="{{ $subcategory->name }}">
                                                @csrf
                                                <!-- <a href="/searchMenu/{{ $subcategory->name }}/{{ $manufacturer_id }}/{{ $modelo_id }}/{{ $motor_id }}">{{ $subcategory->name }}</a> -->
                                                <input type="hidden" name="words" value="{{ $subcategory->name }}">
                                                <input type="hidden" name="manufacturer_id" value="{{ $manufacturer_id }}">
                                                <input type="hidden" name="modelo_id" value="{{ $modelo_id }}">
                                                <input type="hidden" name="motor_id" value="{{ $motor_id }}">
                                                <a href="#" onclick="sendForm('{{ $subcategory->name }}')">{{ $subcategory->name }}</a>
                                            </form>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach

                <script>
                    function sendForm(form)
                    {
                        let formulario = document.getElementById(form)
                        formulario.submit();
                    }
                </script>
        
</div>

