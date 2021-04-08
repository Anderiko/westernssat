<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        return view('members.index', [
            'members' => Member::orderBy('show_order', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'show_order' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'bg' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data['photo_path'] = 'img_'.strtolower(Str::slug($data['name'])).'.'.$request->photo->extension();
        $data['bg_path'] = 'bg_'.strtolower(Str::slug($data['name'])).'.'.$request->bg->extension();

        $request->photo->move(public_path('images/members'), $data['photo_path']);
        $request->bg->move(public_path('images/backgrounds'), $data['bg_path']);

        unset($data['photo'], $data['bg']);

        Member::create($data);

        return redirect()->route('members.index')->with([
            'message' => [
                'title' => 'Membre',
                'message' => 'Un membre a bien été ajouté'
            ]
        ]);
    }

    public function edit(Member $member)
    {
        return view('members.edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'show_order' => 'required',
            'description' => 'required',
            'photo' => 'mimes:png,jpg,jpeg|max:2048',
            'bg' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->photo !== null)
        {
            $data['photo_path'] = 'img_'.strtolower(Str::slug($data['name'])).'.'.$request->photo->extension();

            $request->photo->move(public_path('images/members'), $data['photo_path']);

            unset($data['photo']);
        }

        if ($request->bg !== null)
        {
            $data['bg_path'] = 'bg_'.strtolower(Str::slug($data['name'])).'.'.$request->bg->extension();

            $request->bg->move(public_path('images/backgrounds'), $data['bg_path']);

            unset($data['bg']);
        }

        $member->update($data);

        return redirect()->route('members.index')->with([
            'message' => [
                'title' => 'Membre',
                'message' => 'Un membre a bien été modifié'
            ]
        ]);
    }

    public function delete(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with([
            'message' => [
                'title' => 'Membre',
                'message' => 'Un membre a bien été supprimé définitevement'
            ]
        ]);
    }
}
