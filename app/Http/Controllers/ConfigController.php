<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Session;
use Config;
use File;

class ConfigController extends Controller
{
    public function changeConfigs(Request $request)
    {
        $array = Config::get('services');
        
        $array['catalog']['tax_rate'] =  $request->tax_rate;
        $array['catalog']['tax_flag'] =  $request->tax_flag;
        $array['catalog']['discount'] =  $request->discount;
        $array['catalog']['discount_p'] =  $request->discount_p;
       
        $data = var_export($array, 1);
        if(File::put(app_path() . '\..\config\services.php', "<?php\n return $data ;")) {
            Session::flash('message', 'Successfully updated parameters!');
            return Redirect::back();
        }
        Session::flash('message', 'Something went wrong. Please repeat!');
        return Redirect::back();
    }
}