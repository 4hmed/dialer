<?php

namespace App\Http\Controllers\Api\v1;

use App\Contact;
use App\Contact_phone;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\notificationTest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class ContactController extends Controller
{
    public $user;

    function __construct(JWTAuth $user)
    {
        $this->user = $user;
        try {
            if (!$this->user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'User not found'], 404);
            }
        } catch (JWTException  $e) {
            return response()->json(['msg' => $e->getMessage()], $e->getStatusCode());
        }
        return $this->user;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), array(
            'name' => 'required',
            'email' => 'email',
            'birth_date' => 'date|date_format:Y-m-d',
            'phones' => 'numeric_array'
        ));
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);

        }
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->dob = $request->birth_date;
        $contact->user_id = $this->user->id;
        $contact->save();
        $lastContactId = $contact->id;
        if (count($request->phones) == count($request->codes)) {
            for ($i = 0; $i < count($request->phones); $i++) {
                if (!empty($request->phones[$i]) && !empty($request->codes[$i])) {
                    $contact_phone = new Contact_phone();
                    $contact_phone->phone = $request->phones[$i];
                    $contact_phone->code = $request->codes[$i];
                    $contact_phone->contact_id = $lastContactId;
                    $contact_phone->save();
                }
            }
        }
        if ($contact->save()) {
            $contact = Contact::with('phones', 'groups')->where('id', $lastContactId)->get();
            return response()->json($contact);
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);
    }

    public function update(Request $request, $id)
    {

        $contact = Contact::findOrFail($id);

        if ($contact->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }

        $validation = Validator::make($request->all(), array(
            'name' => 'required',
            'email' => 'email',
            'birth_date' => 'date|date_format:Y-m-d',
            'phones' => 'numeric_array'

        ));
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->dob = $request->birth_date;
        $contact->update();
        $contact->phones()->delete();
        if (count($request->phones) == count($request->codes)) {
            for ($i = 0; $i < count($request->phones); $i++) {
                if (!empty($request->phones[$i]) && !empty($request->codes[$i])) {
                    $contact_phone = new Contact_phone();
                    $contact_phone->phone = $request->phones[$i];
                    $contact_phone->code = $request->codes[$i];
                    $contact_phone->contact_id = $contact->id;
                    $contact_phone->save();
                }
            }
        }
        $contact = Contact::with('phones', 'groups')->where('id', $id)->get();

        return response()->json($contact);
    }

    public function updateImage(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }
        $validation = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }
        $image = $request->file('image');

        $imageName = rand() . '_' . round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/imgs/');
        $image->move($location, $imageName);
        $contact->image = $imageName;
        $contact->update();
        return response()->json(['contact' => $contact]);

    }

    public function updateGroups(Request $request, $id)
    {

        $contact = Contact::findOrFail($id);

        if ($contact->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }

        $groupsid = [];
        if ($request->groups) {
            foreach ($request->groups as $id) {
                if (Group::where('id', $id)->count()) {
                    $groupsid[] = $id;
                }
            }
        }
        $contact->groups()->sync($groupsid);
        $contact = Contact::with('phones', 'groups')->where('id', $id)->get();

        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }
        $contact->delete();
        return response()->json(['msg' => 'Contact has deleted'], 404);
    }


    public function test(FcmController $fcm)
    {
        //  $this->user->notify(new tests('f0JhGXYsKzU:APA91bG3_I2Rctrnd4Yk9EAVXbczIXcsL1Iv0qA_oRvLTPTmr-TkcKYpenyFocAq7-spxNjjDBlt6J5xAbi5hJMlzVD8x8FW4M-3kNEBJIXQwWYvh_dWksYWbk0uDbr5gKonuEFHa5nq'));
        $fcm->notification('test', 'test', 'f0JhGXYsKzU:APA91bG3_I2Rctrnd4Yk9EAVXbczIXcsL1Iv0qA_oRvLTPTmr-TkcKYpenyFocAq7-spxNjjDBlt6J5xAbi5hJMlzVD8x8FW4M-3kNEBJIXQwWYvh_dWksYWbk0uDbr5gKonuEFHa5nq');
    }

    /*    public function export(Request $request)
        {
            $users = json_decode($request->a, true);
            $groups = $users['groups'];
            $contacts = $users['contacts'];
            foreach ($groups as $group){
                $groupt = new Group();
                if (!($groupt::where('name', $group['name'])->where('user_id', $this->user->id)->count())) {
                    $groupt->name = $group['name'];
                    $groupt->user_id = $this->user->id;
                    $groupt->save();

                }
            }
            foreach ($contacts as $contact){
                $groupt = new Group();
                $contactt = new Contact();
                $contactt->name = $contact['name'];
                $contactt->email = $contact['email'];
                $contactt->dob = $contact['name'];
                $contactt->user_id = $this->user->id;
                $contactt->save();
                $c_id = $contactt->id;

                $groups = $contact['groups'];
                foreach ($groups as $group){
                    $groupt = new Group();
                    if (!($groupt::where('name', $group['name'])->where('user_id', $this->user->id)->count())) {
                        $groupt->name = $group['name'];
                        $groupt->user_id = $this->user->id;
                        $groupt->save();
                        $contact->groups()->sync($groupsid);
                    }
                }
            }
            return 'ok';
        }*/

}
