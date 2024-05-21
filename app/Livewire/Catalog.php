<?php

namespace App\Livewire;

use App\Models\Product as Model;
use Illuminate\Database\Eloquent\Collection;

use Livewire\WithPagination;
use Livewire\Component;

class Catalog extends Component 
{

    use WithPagination;

    public $paginate = 10;

    public Collection $products;

    public $name;
    public $description;
    public $item;
    public $is_unit;
    public $is_box;
    public $is_wholesale;
    public $is_liquidation;
 
 
     public $mode = 'create';
 
     public $showForm = false;
 
     public $primaryId = null;
 
     public $search;
 
     public $showConfirmDeletePopup = false;

    // public function mount(){
    //     $this->products = Model::all();
    // }

   
       
    public function updatingSearch()
    {
        $this->resetPage();
    }
   
    public function render()
    {
        $model = Model::where('name', 'like', '%'.$this->search.'%')->orWhere('item', 'like', '%'.$this->search.'%')->orWhere('description', 'like', '%'.$this->search.'%')->latest()->paginate($this->paginate);
        return view('livewire.catalog', [
            'rows'=> $model
        ]);
    }

    public function create ()
    {
        $this->mode = 'create';
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($primaryId)
    {
        $this->mode = 'update';
        $this->primaryId = $primaryId;
        // $model = Model::find($primaryId);

        $this->showForm = true;
    }

    public function update(){
        $id = $this->primaryId;
        $unit = $this->is_unit;
        $wholesome = $this->is_wholesale;
        $box = $this->is_box;
        

        redirect()->route('download.product', ['id' => $id, 'unit' => $unit, 'box' => $box, 'wholesome' => $wholesome]);
    }
}
