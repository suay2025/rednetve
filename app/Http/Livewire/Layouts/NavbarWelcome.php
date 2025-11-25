<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use App\Models\Category;

class NavbarWelcome extends Component
{

    public $categories;

    protected $listeners = ['sendCategories' => 'sendCategories'];

    public function mount($comercioId=1){

        $this->categories = Category::where('comercio_id', $comercioId)
                                    ->where('itemMenu', 1)
                                    ->get();

    }

    public function render()
    {
        return view('livewire.layouts.navbar-welcome');
    }

    public function sendCategories ($postId=0)
    {
       $this->dispatchBrowserEvent('sendCategories', ['categories' => $this->categories, 'message' => 'variables enviadas satisfactoriamente!']);
    }
}
