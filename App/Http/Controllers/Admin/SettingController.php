<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
//use App\Http\Controllers\Admin\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /*public function __invoke()
    {
        $this->middleware('auth');
    }
    */
    public function index() {
        $settings = [];

        /*$settings = DB::select('SELECT * FROM settings WHERE active= ?', [1]);
        $dbsettings= Setting::get();

        foreach($dbsettings as $dbsetting) {
            $settings [ $settings['name']] = $dbsetting ['content'];
        }
        */

        return view('admin.setting.index', [
            'settings' => $settings
        ]);
    }
    
    public function save(Request $request) {
        
        $data = $request->only([
            'title', 'subtitle', 'email', 'backgraundcolor', 'textcolot'
        ]);
        $validator = $this->validator($data);

        if($validator->fails()) {
            return redirect()->route('settings')
            ->withErrors($validator);
        }

        foreach($data as $item =>$value) {
            Setting::where('name', $item)->update([
                'content'=> $value
            ]);
        }

        return redirect()->route('settings');
    }

    protected function validator($data) {
        return validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'backgraundcolor' => ['string', 'regex:/#[A-Z0-9]/i'],
            'textcolot' => ['string', 'regex:/#[A-Z0-9]/i']
        ]);
    }
}
