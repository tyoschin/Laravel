<?php

namespace App\Http\Controllers\LangConstructor;

use App\Http\Controllers\Controller;
use App\Models\Construction;
use App\Models\ConstructionType;
use Illuminate\Http\Request;

class LangConstructorController extends Controller
{
    public function index()
    {
        /** @var Construction $langConstructor */
        $langConstructor = Construction::All();

        return view('lang-constructor.lang-constructor.index',['langConstructor' => $langConstructor]);
    }

    public function edit($id = null)
    {

        /** @var Construction $langConstructor */
        $langConstructor = Construction::findOrNew($id);

        /** @var ConstructionType  $langConstructorTypes */
        $langConstructorTypes = ConstructionType::All();
        $langConstructorTypes = $langConstructorTypes->mapWithKeys(function ($item){
            return [$item->code => $item->name];
        });


        $parameters  = [
            'langConstructor' => $langConstructor,
            'langConstructorTypes' => $langConstructorTypes
        ];

        return view('lang-constructor.lang-constructor.edit',$parameters);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:constructions|max:255',
            'hard' => 'required|integer|between:0,100',
            'type_code' => 'required',
            'description' => 'required|string'
        ]);


        $request->request->add(['created_account_id' => '1']);
        $langConstructor  = Construction::create($request->except(['_token']));

        return redirect(route('lang-constructor-edit', ['id' => $langConstructor->id]))->with('status',__('system.saved'));

    }

    public function delete($id)
    {
        /** @var Construction $langConstructor */
        $langConstructor = Construction::find($id);
        $langConstructor->delete();

        return redirect(route('lang-constructor-index'))->with('status',__('system.deleted'));
    }
}
