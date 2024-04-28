<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use DB, Hash, Storage, File;

class ProfileController extends Controller
{
    private $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index()
    {
        $data = $this->repo->getById(auth()->user()->id);
        return view('pages.profile.index', compact(['data']));
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        try{
            DB::beginTransaction();

            if(!$request->password) $password = auth()->user()->password;
            else $password = Hash::make($request->password);

            if(!$request->file('profile_picture')) {
                $profile = auth()->user()->profile_picture;
            } else {
                $file = $request->file('profile_picture');
                $namafile = time().'_'.$file->getClientOriginalName();
                Storage::disk('local')->put('/public/images/profile/'.$namafile, File::get($file));
                $profile = '/images/profile/'.$namafile;
            }
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'profile_picture' => $profile
            ];

            $update = $this->repo->updateData($data, auth()->user()->id);

            DB::commit();

            if($update) return back()->with('Data saved successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'server error: '.$th->getMessage()], 500);
        }
    }
}
