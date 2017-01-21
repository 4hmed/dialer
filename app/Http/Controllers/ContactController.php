<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Contact_phone;
use App\Group;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function create()
    {
        return view('newContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Contact|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'email',
            'birth_date' => 'date|date_format:Y-m-d',
            'phones' => 'numeric_array',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ));
        $user = Auth::user();
        $image = $request->file('image');

        $imageName = rand() . '_' . round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/images/');
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->dob = $request->birth_date;
        $contact->user_id = $user->id;
        $contact->image = $imageName;
        if ($contact->save()){
            $image->move($location, $imageName);
        }
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
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $user = Auth::user();
        if ($contact->user_id != $user->id || $user->cant(['edit-user-contact'])) {
            $user = User::findOrFail($contact->user_id);
            return redirect()->back()->with('user', $user);
        }
        return view('editContact')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function updateDetails(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $user = Auth::user();
        if ($contact->user_id != $user->id || $user->cant(['update-user-contact'])) {
            $user = User::findOrFail($contact->user_id);

            return redirect()->back()->with('contact', $contact);
        }

        $this->validate($request, array(
            'name' => 'required',
            'email' => 'email',
            'birth_date' => 'date|date_format:Y-m-d',
            'phones' => 'numeric_array'

        ));

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

        return redirect()->back()->with('contact', $contact);
    }
    public function updateImage(Request $request, $id)
    {

        $contact = Contact::findOrFail($id);
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');

        $imageName = rand() . '_' . round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/images/');
        $image->move($location, $imageName);
        $contact->image = $imageName;
        $contact->update();
        return redirect()->back()->with('contact', $contact);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGroups(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $user = Auth::user();
        if ($contact->user_id != $user->id || $user->cant(['update-contact-groups'])) {
            return redirect()->back()->with('contact', $contact);
        }
        $groupsid = [];
        if ($request->groups) {
            foreach ($request->groups as $id) {
                if (Group::where('id', $id)->where('user_id', $contact->user_id)->count()) {
                    $groupsid [] = $id;
                }
            }
        }
        $contact->groups()->sync($groupsid);
        return redirect()->back()->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $user = Auth::user();
        if ($contact->user_id != $user->id || $user->cant(['delete-user-contact'])) {
            $user = User::findOrFail($contact->user_id);
            return redirect()->back()->with('user', $user);
        }
        $contact->delete($id);
        $user = User::findOrFail($contact->user_id);
        return redirect()->back()->with('user', $user);
    }
}
