<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\BuildingBlock;
use App\Models\Layout;

class Testing extends Component
{

    public $title;
    public $info;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $info)
    {
        $this->title = $title;
        $this->info = $info;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.testing');
    }

    public function list (){
      $BuildingBlock = BuildingBlock::all();
      return $BuildingBlock;
    }
}
