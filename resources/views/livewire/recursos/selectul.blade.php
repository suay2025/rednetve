<div>
<style>
    .btn-cart-drop {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown-cart-drop {
        position: relative;
        display: inline-block;
    }

    .dropdown-content-cart-drop {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 350px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content-cart-drop a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content-cart-drop a:hover {background-color: #ddd;}

    .dropdown-cart-drop:hover .dropdown-content-cart-drop {display: block;}

    .dropdown-cart-drop:hover .btn-cart-drop {background-color: #3e8e41;}
</style>

<h2>Hoverable Dropdown</h2>
<p>Move the mouse over the button to open the dropdown menu.</p>

<div class="dropdown-cart-drop">
  <button class="btn-cart-drop">Dropdown</button>
  <div class="dropdown-content-cart-drop">
    @include('livewire.carrito.cart-drop')    
  </div>
</div>

</div>


