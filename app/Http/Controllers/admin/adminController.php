<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
     public function Hello()

    {

        return 'welcome this frist code';

    }

    public function user($name)
    {

    	 // return 'User is buzy '.$name.' job please wate sir.....';

            //  return 'Father name is recived '.$father.'Hello...';

 echo  "User is buzy  $name job please wate sir.....";
 //echo  " Father name is recived '$Father' Hello...";

  
}




}