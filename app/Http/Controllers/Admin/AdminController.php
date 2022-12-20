<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index($lang = 'en')
    {
        // if(in_array($lang, ['ar', 'en', 'fr'])) {
        //     App::setLocale($lang);
        // }
        // else {
        //     dd('اختار لغة صح ي حبيبي بكفي هبل !!!!!!!');
        // }

        return view('admin.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_store(Request $request)
    {
        $logo = settings()->get('logo');
        if($request->has('logo')) {
            $logo = $request->file('logo')->store('uploads', 'custom');
            settings()->set('logo', $logo);
        }

        settings()->save();

        return redirect()->back();
    }
}
