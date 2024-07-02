<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search = '';
   
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usersQuery = User::query();

        if ($this->search) {
            $usersQuery->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $users = $usersQuery->orderBy('id', 'desc')->paginate(10);
        
        return view('livewire.admin.users-index', compact('users'));
    }
    
}
