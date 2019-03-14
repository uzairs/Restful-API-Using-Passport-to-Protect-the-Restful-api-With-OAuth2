<?php
namespace App\Http\Controllers\User;
use App\User;
use App\Mail\userCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;
use App\Transformers\UserTransformer;
class UserController extends ApiContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function __construct()
         {

          
            $this->middleware('client.credentials')->only(['store', 'resend']);

            $this->middleware('auth:api')->except(['store','verify', 'resend']);
          
           $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);

           $this->middleware('scope:manage-account')->only(['show','update']);            


         }    
 

       public function index()
    
    {
        
                
        $users = User::all();

//        return response()->json(['data'=> $users], 200);
         return $this->showAll($users);




    }

    /**
     * Show the form for creating a new resource.
     *
     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
              'name' => 'required',
               'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed', 


       ];

       $this->validate($request, $rules);

        $data   = $request->all();
        $data['password'] = bcrypt($request->password);
        $data ['verified'] = User::UNVERIFIED_USER;
        $data ['verification_Token'] = User::generateVerificationCode();
        $data ['admin'] = User::REGULAR_USER;   
    
      $user = User::create($data);

        
         return $this->showOne($user, 201);
 

    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //optend a User.

         return  $this->showOne($user);
         
            

    }

    /**
     * Show the form for editing the specified resource.
     *
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
           
         
            $rules = [

                  'email' => 'email|unique:users,email,' . $user->id,
                  'password' => 'min:6|confirmed',
                  'admin' => 'in:'. User::ADMIN_USER  .   ','  . User::REGULAR_USER,    
            ];

       if ($request->has('name')) {
           
           $user->name = $request->name;


       }

if ($request->has('email')&& $user->email != $request->email) {
     $user->verified = User::UNVERIFIED_USER;
      $user->verification_Token = User::generateVerificationCode();
   
    $user->email = $request->email;
}   

if ($request->has('password')) {
   
    $user->password = bcrypt($request->password);
}

  if ($request->has('admin')) {

 if (!$user->isVerified()) {
    
      return $this->errorResponse( 'only varified users can modify the admin field' , 409);

}
  $user->admin =  $request->admin;    

}
 
 if (!$user->isDirty()) {

       return $this->errorResponse( 'you need a spacify a different value to update' ,  422);

 }

       $user->save();

       return $this->showOne($user);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
          
        $user->delete();

        return  $this->showOne($user);

    }

    public function verify($token)
    {
         
   $user = User::where('verification_token', $token)->firstOrFail();
    
  $user->verified  = User::VERIFIED_USER;
  $user->verification_token = null;
 
  $user->save();

    return $this->showmessage('The Account has been verified succesfully');

    }

public function resend(User $user){

   if ($user->isVerified()) {
     return $this->errorResponse('The user is already verified', 409);
   }

    retry(5, function() use($user) {


     Mail::to($user)->send(new userCreated($user));
    }, 100);
      return $this->showmessage('The verification email has been resend');


}

}




