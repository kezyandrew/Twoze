<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Language;
use Gate;
use App;

class LanguageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $languages = Language::orderBy('created_at','DESC')
        ->get();

        return view('admin.language.languageTable', compact('languages'));
    }

    public function show($lang)
    {
        $icon = Language::where('name',$lang)->first();
        App::setLocale($lang);
        session()->put('locale', $lang);
        if($icon){
            session()->put('direction', $icon->direction);
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:language',
            'language_file' => 'bail|required',
            'image' => 'bail|required',
            'direction' => 'bail|required',
        ]);

        $language = new Language();
        if($request->hasFile('language_file'))
        {
            $json = $request->file('language_file');
            $name = $request->name.'.'. $json->getClientOriginalExtension();
            $destinationPath = resource_path('/lang');
            $json->move($destinationPath, $name);
            $language->file = $name;
        }
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = $request->name.'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/language');
            $image->move($destinationPath, $name);
            $language->image = $name;
        }
        $language->name = $request->name;
        $language->direction = $request->direction;
        $language->save();
        return response()->json(['success' => true,'data' => $language, 'msg' => 'Language create'], 200);
    }
    public function edit($id)
    {
        abort_if(Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['language'] = Language::find($id);
        return response()->json(['success' => true,'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'direction' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $language = Language::find($id);
        
        if($request->hasFile('language_file_edit'))
        {
            $json = $request->file('language_file_edit');
            $name = $request->name.'.'. $json->getClientOriginalExtension();
            $destinationPath = resource_path('/lang');
            $json->move($destinationPath, $name);
            $language->file = $name;
        }
        if($request->hasFile('image_edit'))
        {
            $image = $request->file('image_edit');
            $name = $request->name.'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/language');
            $image->move($destinationPath, $name);
            $language->image = $name;
        }
        $language->direction = $request->direction;
        $language->status = $request->status;
        $language->save();

        return response()->json(['success' => true,'data' => $language, 'msg' => 'Language edited successfully..!!'], 200); 
    }
}
