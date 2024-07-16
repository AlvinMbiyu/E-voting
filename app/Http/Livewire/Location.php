<?php

namespace App\Http\Livewire;

use App\Models\County;
use App\Models\Subcounty;
use App\Models\Town;
use Livewire\Component;

class Location extends Component
{
    public $selectedCounty = null;
    public $selectedSubCounty = null;
    public $subcounties = null;
    public $selectedTown = null;
    public $towns = null;

    public function render()
    {
        $counties = County::all();

        return view('livewire.location', [
            'counties' => $counties,
            'subcounties' => $this->subcounties,
            'towns' => $this->towns
        ]);
    }

    public function updatedSelectedCounty($county_id)
    {
        $this->subcounties = Subcounty::where('county_id', $county_id)->get();
        $this->reset(['selectedSubCounty', 'selectedTown', 'towns']);
    }

    public function updatedSelectedSubcounty($subcounty_id)
    {
        $this->towns = Town::where('sc_id', $subcounty_id)->get();
        $this->reset('selectedTown');
    }
}
