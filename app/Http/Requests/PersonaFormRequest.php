<?php

namespace pizzagallo\Http\Requests;

use pizzagallo\Http\Requests\Request;
use pizzagallo\Persona;
use Illuminate\Support\Facades\Redirect;
use pizzagallo\Http\Requests\PersonaFormRequest;

class PersonaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'nombre'=>'required|max:100',
			'tipo_documento'=>'required|max:20',
			'num_documento'=>'required|max:15',
			'direccion'=>'max:70',
			'telefono'=>'max:15',
			'email'=>'max:50',
			'fecha_nacimiento'=>'date'
        ];
    }
}
