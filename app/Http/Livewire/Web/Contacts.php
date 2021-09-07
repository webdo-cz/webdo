<?php

namespace App\Http\Livewire\Web;

use App\Models\Contact;

use Livewire\Component;

class Contacts extends Component
{
    public function render()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(25);
        return view('livewire.web.contacts')->with('contacts', $contacts);
    }
}
