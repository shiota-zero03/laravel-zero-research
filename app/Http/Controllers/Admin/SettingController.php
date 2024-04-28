<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use DB, Storage, File;

class SettingController extends Controller
{
    protected $repo;
    public function __construct(SettingRepository $repo){
        $this->repo = $repo;
    }
    public function index()
    {
        $data = $this->repo->getData();
        return view('pages.setting.index', compact(['data']));
    }
    public function save(Request $request)
    {
        $request->validate([
            'app_name' => ['required', 'string']
        ]);

        try {
            DB::beginTransaction();

            $set = $this->repo->getData();

            if(!$request->file('maks_logo')) {
                $maks_logo = $set->maks_logo;
            } else {
                $file = $request->file('maks_logo');
                $namafile = time().'_'.$file->getClientOriginalName();
                Storage::disk('local')->put('/public/images/setting/'.$namafile, File::get($file));
                $maks_logo = '/images/setting/'.$namafile;
            }

            if(!$request->file('min_logo')) {
                $min_logo = $set->min_logo;
            } else {
                $file = $request->file('min_logo');
                $namafile = time().'_'.$file->getClientOriginalName();
                Storage::disk('local')->put('/public/images/setting/'.$namafile, File::get($file));
                $min_logo = '/images/setting/'.$namafile;
            }

            if(!$request->file('shortcut')) {
                $shortcut = $set->shortcut;
            } else {
                $file = $request->file('shortcut');
                $namafile = time().'_'.$file->getClientOriginalName();
                Storage::disk('local')->put('/public/images/setting/'.$namafile, File::get($file));
                $shortcut = '/images/setting/'.$namafile;
            }

            $data = [
                'app_name' => $request->app_name,
                'maks_logo' => $maks_logo,
                'min_logo' => $min_logo,
                'shortcut' => $shortcut
            ];
            $update = $this->repo->saveData($data,$set->id);

            DB::commit();

            if($update) return back()->with('Data saved successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
}
