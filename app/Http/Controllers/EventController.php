<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Mail\NewUserWelcome;
use Carbon\Carbon;
use App\Department;
use App\Location;
use App\Feedback;
use App\Message;
use App\Event;
use App\User;
use Validator;
use Auth;
use Hash;
use Mail;

class EventController extends Controller
{
    public function home(Request $request){
        if(count($request->search)!=0){
            $event1 = Event::where('name','like','%'.$request->search.'%')->get();
        } else {
            $event1 = "null";
        }
        $eventcal = Event::whereDate('date', '>=', Carbon::today()->toDateString())->get();
        $event = Event::whereDate('date', '>=', Carbon::today()->toDateString())->orderBy('created_at','DESC')->paginate(2);
        $pasteventcal = Event::whereDate('date', '<', Carbon::today()->toDateString())->get();
        $pastevent = Event::whereDate('date', '<', Carbon::today()->toDateString())->orderBy('created_at','DESC')->paginate(2);
    	return view('welcome',['event' => $event, 'event2' => $event, 'pastevent' => $pastevent, 'pastevent2' => $pastevent, 'search'=>$event1, 'eventcal' => $eventcal, 'pasteventcal' => $pasteventcal]);
    }

    public function login(){
        if(Auth::check()){
            if(Auth::user()->type=="admin"){
                return redirect('/admin');
            } else {
                return redirect('/create');  
            }
        }
    	return view('login');
    }

    public function allevent(){
        $event = Event::whereDate('date', '>=', Carbon::today()->toDateString())->orderBy('created_at','DESC')->get();
    	return view('allevent',['event' => $event]);
    }

    public function pastevent(){
        $pastevent = Event::whereDate('date', '<', Carbon::today()->toDateString())->orderBy('created_at','DESC')->get();
        return view('pastevent',['pastevent' => $pastevent, 'pastevent2' => $pastevent]);
    }

    public function event($id){
        $event = Event::where('id', $id)->first();
        return view('event',['event' => $event]);
    }

    public function create(){
        $loc = Location::all();
    	return view('create',['loc' => $loc]);
    }

    public function post_login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/admin');
        } else {
            return redirect()->back()->with('error','Email and password doesn\'t match');
        }
    }

    public function message(Request $request){
        $message = New Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();
        return redirect()->back()->with('msg_success','Your message has been sent successfully!');
    }

    public function feedback(Request $request){
        $feedback = New Feedback;
        $feedback->event_id = $request->event_id;
        $feedback->from = $request->option;
        $feedback->attending = $request->attend;
        $feedback->recommend = $request->recom;
        $feedback->date = $request->date;
        $feedback->location = $request->loc;
        $feedback->interest = $request->interest;
        $feedback->relevant = $request->relevant;
        $feedback->inspiring = $request->inspiring;
        $feedback->message = $request->message;
        $feedback->email = $request->email;
        $feedback->save();
        return redirect()->back()->with('fdb_success','Your feedback has been sent successfully, Thank you for your valuable feedback, we\'ll try to improve!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function admin(){
        $feedback = Feedback::all();
        $loc = Location::orderBy('created_at','DESC')->get();
        $dept = Department::orderBy('created_at','DESC')->get();
        $event = Event::orderBy('created_at','DESC')->get();
        $user = User::orderBy('created_at','DESC')->get();
        $message = Message::orderBy('created_at','DESC')->get();
        return view('admin.admin',['message' => $message, 'message2' => $message, 'user' => $user, 'user2' => $user, 'event' => $event, 'event2' => $event, 'feedback' => $feedback, 'dept' => $dept, 'dept2' => $dept, 'loc' => $loc, 'loc2' => $loc]);
    }

    public function events(){
        $event = Event::all();
        return view('admin.events',['event' => $event, 'event2' => $event]);
    }

    public function all_message(){
        $message = Message::all();
        return view('admin.message',['message' => $message, 'message2' => $message]);
    }

    public function manage(){
        $dept = Department::all();
        $user = User::all();
        return view('admin.manage',['user' => $user, 'user2' => $user, 'dept2' => $dept]);
    }

    public function add_fac(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ]);
        if($validator->fails()){
            return back()->with('fac_error','Email already exist!');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return back()->with('error','Password should be atleast 6 characters!');
        }
        $user = New User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->department_id = $request->department;
        $user->type = "user";
        View::share('password',$request->password);
        if($user->save()){
            return back()->with('fac_add','Faculty added successfully.');
        }
    }

    public function del_msg(Request $request){
        $message = Message::find($request->get('del_msg'))->delete();
        return back()->with('msg_del','Message deleted successfully!');
    }

    public function del_fac(Request $request){
        $user = User::find($request->get('delfac'))->delete();
        return back()->with('del_fac','Faculty deleted successfully.');
    }

    public function del_event(Request $request){
        $event = Event::find($request->get('del_event'))->delete();
        return back()->with('del_evn','Event deleted successfully!');
    }

    public function update_user(Request $request){
        User::where('id',$request->id)->update(['name' => $request->name, 'department_id' => $request->dept]);
        return redirect()->back()->with('fac_up','User Details changed successfully!');
    }

    public function change_password(Request $request){
        if(!Hash::check($request->oldpassword, Auth::user()->password)){
            return back()->with('psw_error','Please enter your current password correctly!');
        }else{
            if($request->confirm_password == $request->newpassword){
                $request->user()->fill([
                    'password' => Hash::make($request->newpassword)
                ])->save();
                return back()->with('psw_success','Password updated successfully!');
            } else {
                return back()->with('psw_error2','Please enter same password!');
            }
        }
    }

    public function create_event(Request $request){
        $event = New Event;
        $path = Storage::disk('uploads')->put('/eventImage',$request->image);
        $event->image = $path;
        $event->name = strtoupper($request->name);
        $event->location_id = $request->loc;
        $event->user_id = $request->user_id;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->save();
        return back()->with('success','Event created successfully.');
    }

    public function allfeedback(){
        $event = Event::all();
        $feedback = Feedback::all();
        return view('admin.feedback', ['event' => $event, 'feedback' => $feedback, 'feedback2' => $feedback]);
    }

    public function resetpassword(){
        return view('auth.passwords.email');
    }

    public function myevent(){
        $event = Event::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('myevent',['event' => $event, 'event2' => $event]);
    }

    public function myfeedback(){
        $feedback = Feedback::all();
        return view('myfeedback',['feedback' => $feedback, 'feedback2' => $feedback]);
    }

    public function del_feed(Request $request){
        $feedback = Feedback::find($request->get('del_feed'))->delete();
        return back()->with('del_feed','Feedback deleted successfully.');
    }

    public function add_dept(Request $request){
        $dept = New Department;
        $validate = 'SELECT * FROM Department WHERE name = $request->name';
        if(count($validate) == 0){
            $dept->name = $request->name;
            $dept->save();
            return back()->with('dept_success','Department added successfully!'); 
        } else{
            return back()->with('dept_err','Department name already exist!');
        }
    }

    public function department(){
        $dept = Department::all();
        return view('admin.department',['dept' => $dept, 'dept2' => $dept]);
    }

    public function add_loc(Request $request){
        $loc = new Location;
        $validate = 'SELECT * FROM Location WHERE name = $request->name';
        if(count($validate) == 0){
            $loc->name = $request->name;
            $loc->save();
            return back()->with('loc_success','Location Added Successfully!');
        } else {
            return back()->with('loc_err','Location already exist!');
        }
    }

    public function update_dept(Request $request){
        Department::where('id',$request->id)->update(['name'=>$request->name]);
        return redirect()->back()->with('dept_update','Department changed successfully!');
    }

    public function del_dept(Request $request){
        $dept = Department::find($request->get('deldept'))->delete();
        return back()->with('del_dept','Department deleted successfully!');
    }

    public function update_loc(Request $request){
        Location::where('id',$request->id)->update(['name'=>$request->name]);
        return redirect()->back()->with('loc_update','Location changed successfully!');
    }

    public function del_loc(Request $request){
        $dept = Location::find($request->get('delloc'))->delete();
        return back()->with('del_loc','Location deleted successfully!');
    }

    public function location(){
        $loc = Location::all();
        return view('admin.location',['loc' => $loc, 'loc2' => $loc]);
    }
}