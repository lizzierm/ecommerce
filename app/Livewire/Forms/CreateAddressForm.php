<?php

namespace App\Livewire\Forms;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

use function PHPSTORM_META\type;

class CreateAddressForm extends Form
{
    public $type = '';
    public $description = '';
    public $district = '';
    public $reference = '';
    public $receiver = '1';
    public $receiver_info = [];
    public $default = false;

    public function rules(){
        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'district' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array', // Sin espacio al final del nombre
            'receiver_info.name' => 'required|string', // Sin espacio al final del nombre
            'receiver_info.last_name' => 'required|string', // Sin espacio al final del nombre
            'receiver_info.document_type' => [ // Sin espacio al final del nombre
                'required',
                new Enum(TypeOfDocuments::class)
            ],
            'receiver_info.document_number' => 'required|string', // Sin espacio al final del nombre
            'receiver_info.phone' => 'required|string', // Sin espacio al final del nombre
    
        ];
    }
    
    public function validationAttributes(){
        return[
            'type' => 'tipo de dirección',
            'description' =>'dirección de destino',
            'district' => 'municipio',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre', // Sin espacio al final del nombre
            'receiver_info.last_name' => 'apellido', // Sin espacio al final del nombre
            'receiver_info.document_type' => 'tipo de documento', // Sin espacio al final del nombre
            'receiver_info.document_number' => 'número de documento', // Sin espacio al final del nombre
            'receiver_info.phone' => 'teléfono', // Sin espacio al final del nombre
    
        ];
    }
    
    public function save(){
        $this->validate();

        if (auth()->user()->addresses->count() === 0){
            $this->default = true;
        }

        Address::create([

            'user_id' => auth()->id(),
            'type' => $this->type,
            'description' => $this->description,
            'district' => $this->district,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
            
        ]);

        $this->reset();

        $this->receiver_info = [

                'name' => auth()->user()->name,
                'last_name' => auth()->user()->last_name,
                'document_type' => auth()->user()->document_type,
                'document_number' => auth()->user()->document_number,
                'phone' => auth()->user()->phone,

        ];
    }
}
