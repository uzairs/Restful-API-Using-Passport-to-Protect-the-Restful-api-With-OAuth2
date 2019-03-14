<?php

  namespace App\Http\Requests;

  use Illuminate\Foundation\Http\FormRequest; 

   class Testrequest extends FormRequest
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
        return  [
                   'text1' => 'alpha|required',
                   'text2' => 'required',
               ];
    }

     public function messages()

{
    return 

   [ 

      'text1.required' => 'Field :attribute can not be left back',
      'text2.required' => 'Field :attribute not valid'
       
   ];

 
   
}

}
