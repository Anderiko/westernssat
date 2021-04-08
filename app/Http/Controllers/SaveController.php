<?php

namespace App\Http\Controllers;

use App\Models\GroupSave;
use App\Models\SoloSave;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveController extends Controller
{
    public function loadSolo()
    {
        return response()->json(['save' => auth()->user()->soloSave]);
    }

    public function loadGroup()
    {
        $save = auth()->user()->groupSave;

        return response()->json([
            'save' => $save
        ]);
    }

    public function endSolo(Request $request) {
        $data = $request->validate([
            'api_token' => 'required'
        ]);

        if ($data['api_token'] === auth()->user()->api_token) {
            $save = auth()->user()->soloSave;

            if (!$save->ended_at) $save->ended_at = now();

            $save->save();
        }
    }

    public function endGroup(Request $request) {
        $data = $request->validate([
            'api_token' => 'required'
        ]);

        if ($data['api_token'] === auth()->user()->api_token) {
            $save = auth()->user()->groupSave;

            if (!$save->ended_at) $save->ended_at = now();

            $save->save();
        }
    }

    public function saveSolo(Request $request)
    {
        $data = $request->validate([
            'api_token' => 'required',
            'sceneIndex' => 'required',
            'actionIndex' => 'required'
        ]);

        if ($data['api_token'] === auth()->user()->api_token) {
            auth()->user()->api_token = null;
            auth()->user()->save();

            $save = auth()->user()->soloSave;

            $save->sceneIndex = $data['sceneIndex'];
            $save->actionIndex = $data['actionIndex'];
            $save->save();
        }
    }

    public function rebaseSolo()
    {
        $save = auth()->user()->groupSave;

        if ($save !== null) {
            $solo = auth()->user()->soloSave;

            $solo->sceneIndex = $save->sceneIndex;
            $solo->actionIndex = $save->actionIndex;
            $solo->save();

            return response()->json([
                'save' => $solo
            ]);
        } else {
            return $this->createSolo();
        }
    }

    public function saveGroup(Request $request)
    {
        $data = $request->validate([
            'api_token' => 'required',
            'sceneIndex' => 'required',
            'actionIndex' => 'required'
        ]);

        if ($data['api_token'] === auth()->user()->api_token) {
            auth()->user()->api_token = null;
            auth()->user()->save();

            $save = auth()->user()->groupSave;

            if ($save->sceneIndex < $data['sceneIndex']) {
                $save->sceneIndex = $data['sceneIndex'];
                $save->actionIndex = $data['actionIndex'];
                $save->save();
            } else if ($save->sceneIndex === $data['sceneIndex'] && $save->actionIndex < $data['actionIndex']) {
                $save->sceneIndex = $data['sceneIndex'];
                $save->actionIndex = $data['actionIndex'];
                $save->save();
            }
        }
    }

    public function createSolo()
    {
        $saves = SoloSave::where('user_id', auth()->user()->id)->get();

        foreach ($saves as $save) {
            $save->delete();
        }

        $save = SoloSave::create([
            'user_id' => auth()->user()->id,
            'sceneIndex' => 1,
            'started_at' => now()
        ]);

        return response()->json(['save' => SoloSave::find($save->id)->toArray()]);
    }

    public function createGroup()
    {
        $saves = GroupSave::where('party_id', auth()->user()->party->id)->get();

        foreach ($saves as $save) {
            $save->delete();
        }

        $save = GroupSave::create([
            'party_id' => auth()->user()->party->id,
            'user_id' => auth()->user()->party->leader->id,
            'sceneIndex' => 1,
            'started_at' => now()
        ]);

        return response()->json(['save' => GroupSave::find($save->id)->toArray()]);
    }

    public function hintUsed(Request $request)
    {
        $data = $request->validate([
            'game' => 'required',
        ]);

        DB::table('hints_used')->insert([
            'game' => $data['game'],
            'party_id' => auth()->user()->party_id,
            'user_id' => auth()->user()->id,
        ]);
    }
}
