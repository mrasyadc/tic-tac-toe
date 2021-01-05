<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getPlayerProfile(Request $request) {
        $id = $request->session()->get('id')[0];
        $users = DB::table('users')->where('id', $request->session()->get('id'))->get();
        $win = DB::table('match')->where('winner', $request->session()->get('id'))->count();
        $lose = DB::table('match')->whereRaw("`status`='finish' AND `winner`!='$id' AND (`user_id_1` = $id OR `user_id_2` = $id)")->count();
        $draw = DB::table('match')->whereRaw("`status`='finish' AND `winner`IS NULL AND (`user_id_1` = $id OR `user_id_2` = $id)")->count();
        return view('profile',['users' => $users, "win" => $win, "lose"=>$lose, "draw"=>$draw]);
    }

    public function editPlayerProfile(Request $request) {
        $user = DB::table('users')->where('id', $request->session()->get('id'))->get();

        return view('edit', ['user' => $user]);
    }

    public function prosesUpdate(Request $request) {
        $user = DB::table('users')->where('id', $request->session()->get('id'))->get();
            if(!Hash::check($request->oldPassword, $user[0]->password)) return redirect('..');
        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'password' => Hash::Make($request->newPassword)
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/profile');
    }

    public function prosesUpdateFile(Request $request) {
            $this->validate($request, [
                'file' => 'required',
                'keterangan' => 'required',
            ]);

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'data_file';

            // upload file
            $file->move($tujuan_upload,$file->getClientOriginalName());
        }
}
