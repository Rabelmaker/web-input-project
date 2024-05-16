<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Contract\Database;
use function Laravel\Prompts\select;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('admin')->check()) {
            return view('ui.dashboard.index');
        } else {
            return view('auth.login');
        }

    }

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('dashboard'));
        } else {
            return view('auth.login');
        }

    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect(route('login'));
    }

    public function post_login(Request $request)
    {
        $admin = DB::table('admin_tb')
            ->where('username', $request->username)
            ->where('password', $this->md5Pass($request->password))
            ->get();

        if (count($admin) > 0) {
            Auth::guard('admin')->LoginUsingId($admin[0]->id);
            return redirect(route('dashboard'));
        } else {
            return redirect(route('login'))->with('error', "Username / Password salah");
        }
    }

    //------------------------------------------------------------------------------------------------------------------

    public function karyawan()
    {
        $data = DB::table('karyawan_tb')->get();
        return view('ui.karyawan.index', ['datas' => $data]);
    }

    public function add_karyawan()
    {
        return view('ui.karyawan.add');
    }

    public function edit_karyawan($id)
    {
        $data = DB::table('karyawan_tb')->where('id', $id)->first();
        return view('ui.karyawan.edit', ['data' => $data]);
    }

    public function post_karyawan(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'posisi' => $request->posisi,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('karyawan_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('karyawan_tb')->where('id', $id)->update($data);
        }

        if ($request->has('gambar')) {

            request()->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('gambar');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('karyawan_tb')
                ->where('id', $id)
                ->update(['gambar' => "$tujuan/$nama"]);
        }

        return redirect(route('karyawan'))->with('sukses', 'karyawan telah di perbarui');
    }

    public function delete_karyawan($id)
    {
        DB::table('karyawan_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('karyawan'))->with('sukses', 'karyawan telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function project()
    {
        $data = DB::table('project_tb')
            ->leftJoin('karyawan_tb', 'project_tb.id_pj', '=', 'karyawan_tb.id')
            ->select('project_tb.*', 'karyawan_tb.nama as nama_karyawan')
            ->get();

        return view('ui.project.index', ['datas' => $data]);
    }
    public function add_project()
    {
        $data = DB::table('karyawan_tb')
            ->select('nama','id')
            ->get();

        return view('ui.project.add', ['datas' => $data]);
    }

    public function edit_project($id)
    {
        $data = DB::table('project_tb')
            ->leftJoin('karyawan_tb', 'project_tb.id_pj', '=', 'karyawan_tb.id')
            ->select('project_tb.*', 'karyawan_tb.nama as nama_karyawan')
            ->where('project_tb.id', $id)
            ->first();

        $karyawan = DB::table('karyawan_tb')
            ->get();

        return view('ui.project.edit', ['data' => $data, 'karyawans' => $karyawan]);
    }

    public function post_project(Request $request)
    {
        $data = [
            'id_pj' => $request->id_pj,
            'nama_project' => $request->nama_project,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('project_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('project_tb')->where('id', $id)->update($data);
        }

        if ($request->has('gambar')) {

            request()->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('gambar');
            $tujuan = "img/lampiran";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('project_tb')
                ->where('id', $id)
                ->update(['gambar' => "$tujuan/$nama"]);
        }

        return redirect(route('project'))->with('sukses', 'project telah di perbarui');
    }
    public function delete_project($id)
    {
        DB::table('project_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('project'))->with('sukses', 'project telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function uangMasuk()
    {
        $data = DB::table('transaksi_tb')
            ->leftJoin('project_tb', 'transaksi_tb.id_project', '=', 'project_tb.id')
            ->where('transaksi_tb.jenis_transaksi','=','uang keluar/masuk')
            ->get();

        return view('ui.uang_masuk.index', ['datas' => $data]);
    }
    public function add_uangMasuk()
    {
        $laporan = DB::table('laporan_tb')
            ->select('nama_laporan','id')
            ->get();

        $data = DB::table('project_tb')
            ->select('nama_project','id')
            ->get();

        return view('ui.uang_masuk.add', ['datas' => $data],['laporans' => $laporan]);
    }
    public function edit_uangMasuk($id)
    {
        $data = DB::table('transaksi_tb')
            ->where('transaksi_tb.id', $id)
            ->first();

        $project = DB::table('project_tb')
            ->get();

        return view('ui.uang_masuk.edit', ['data' => $data, 'projects' => $project]);
    }
    public function post_uangMasuk(Request $request)
    {


        $data = [
            'id_project' => $request->id_project,
            'id_laporan' => $request->id_laporan,
            'total' => $request->total,
            'uraian' => $request->isMasuk == 1 ? "Uang Masuk" : "Uang Keluar",
            'adm_bank' => $request->adm_bank,
            'tgl' => $request->tgl,
            'ket' => $request->ket,
            'jenis_transaksi' => 'uang keluar/masuk',
            'isMasuk' => $request->isMasuk,
            'saldo_akhir' => $this->saldoAkhir($request->total, $request->isMasuk,$request->id_laporan)
        ];


        if ($request->mode === 'add') {
            $id = DB::table('transaksi_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('transaksi_tb')->where('id', $id)->update($data);
        }

        if ($request->has('lampiran')) {

            request()->validate([
                'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('lampiran');
            $tujuan = "img/lampiran";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('transaksi_tb')
                ->where('id', $id)
                ->update(['lampiran' => "$tujuan/$nama"]);
        }

        return redirect(route('uangMasuk'))->with('sukses', 'Uang masuk telah di perbarui');
    }
    public function delete_uangMasuk($id)
    {
        DB::table('transaksi_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('uangMasuk'))->with('sukses', 'Uang masuk telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function material()
    {
        $data = DB::table('transaksi_tb')
            ->leftJoin('project_tb', 'transaksi_tb.id_project', '=', 'project_tb.id')
            ->where('transaksi_tb.jenis_transaksi','=','material')
            ->get();

        return view('ui.material.index', ['datas' => $data]);
    }
    public function add_material()
    {
        $laporan = DB::table('laporan_tb')
            ->select('nama_laporan','id')
            ->get();

        $data = DB::table('project_tb')
            ->select('nama_project','id')
            ->get();

        return view('ui.material.add', ['datas' => $data],['laporans' => $laporan]);
    }
    public function edit_material($id)
    {
        $data = DB::table('transaksi_tb')
            ->where('transaksi_tb.id', $id)
            ->first();

        $project = DB::table('project_tb')
            ->get();

        return view('ui.material.edit', ['data' => $data, 'projects' => $project]);
    }
    public function post_material(Request $request)
    {
        $jumlah = $request->jumlah;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $adm_bank = $request->adm_bank;
        $data = [
            'id_project' => $request->id_project,
            'id_laporan' => $request->id_laporan,
            'tgl' => $request->tgl,
            'uraian' => $request->uraian,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'harga' => $harga,
            'adm_bank' => $adm_bank,
            'total' => ($jumlah*$harga)+$adm_bank,
            'ket' => $request->ket,
            'jenis_transaksi' => 'material',
            'isMasuk' => 0,
            'saldo_akhir' => $this->saldoAkhir(($jumlah*$harga)+$adm_bank,0,$request->id_laporan)
        ];

        if ($request->mode === 'add') {
            $id = DB::table('transaksi_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('transaksi_tb')->where('id', $id)->update($data);
        }

        if ($request->has('lampiran')) {

            request()->validate([
                'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('lampiran');
            $tujuan = "img/lampiran";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('transaksi_tb')
                ->where('id', $id)
                ->update(['lampiran' => "$tujuan/$nama"]);
        }

        return redirect(route('material'))->with('sukses', 'Material telah di perbarui');
    }
    public function delete_material($id)
    {
        DB::table('transaksi_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('material'))->with('sukses', 'Material telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function jasa()
    {
        $data = DB::table('transaksi_tb')
            ->leftJoin('project_tb', 'transaksi_tb.id_project', '=', 'project_tb.id')
            ->where('transaksi_tb.jenis_transaksi','=','jasa')
            ->get();

        return view('ui.jasa.index', ['datas' => $data]);
    }
    public function add_jasa()
    {
        $laporan = DB::table('laporan_tb')
            ->select('nama_laporan','id')
            ->get();

        $data = DB::table('project_tb')
            ->select('nama_project','id')
            ->get();

        return view('ui.jasa.add', ['datas' => $data],['laporans' => $laporan]);
    }
    public function edit_jasa($id)
    {
        $data = DB::table('transaksi_tb')
            ->where('transaksi_tb.id', $id)
            ->first();

        $project = DB::table('project_tb')
            ->get();

        return view('ui.jasa.edit', ['data' => $data, 'projects' => $project]);
    }
    public function post_jasa(Request $request)
    {
        $jumlah = $request->jumlah;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $adm_bank = $request->adm_bank;
        $data = [
            'id_project' => $request->id_project,
            'id_laporan' => $request->id_laporan,
            'tgl' => $request->tgl,
            'tgl_end'=> $request->tgl_end,
            'uraian' => $request->uraian,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'harga' => $harga,
            'adm_bank' => $adm_bank,
            'total' => $jumlah*$harga,
            'ket' => $request->ket,
            'jenis_transaksi' => 'jasa',
            'isMasuk' => 0,
            'saldo_akhir' => $this->saldoAkhir($request->total,0,$request->id_laporan)
        ];

        if ($request->mode === 'add') {
            $id = DB::table('transaksi_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('transaksi_tb')->where('id', $id)->update($data);
        }

        if ($request->has('lampiran')) {

            request()->validate([
                'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('lampiran');
            $tujuan = "img/lampiran";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('transaksi_tb')
                ->where('id', $id)
                ->update(['lampiran' => "$tujuan/$nama"]);
        }

        dd($data);

        return redirect(route('jasa'))->with('sukses', 'Jasa telah di perbarui');
    }
    public function delete_jasa($id)
    {
        DB::table('transaksi_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('jasa'))->with('sukses', 'Jasa telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function pinjaman()
    {
        $data = DB::table('transaksi_tb')
            ->leftJoin('project_tb', 'transaksi_tb.id_project', '=', 'project_tb.id')
            ->where('transaksi_tb.jenis_transaksi','=','pinjaman')
            ->get();

        return view('ui.pinjaman.index', ['datas' => $data]);
    }
    public function add_pinjaman()
    {
        $laporan = DB::table('laporan_tb')
            ->select('nama_laporan','id')
            ->get();

        $data = DB::table('project_tb')
            ->select('nama_project','id')
            ->get();

        return view('ui.pinjaman.add', ['datas' => $data],['laporans' => $laporan]);
    }
    public function edit_pinjaman($id)
    {
        $data = DB::table('transaksi_tb')
            ->where('transaksi_tb.id', $id)
            ->first();

        $project = DB::table('project_tb')
            ->get();

        return view('ui.pinjaman.edit', ['data' => $data, 'projects' => $project]);
    }
    public function post_pinjaman(Request $request)
    {
        $data = [
            'id_project' => $request->id_project,
            'id_laporan' => $request->id_laporan,
            'total' => $request->total,
            'uraian' => "Pinjaman",
            'tgl' => $request->tgl,
            'ket' => $request->ket,
            'jenis_transaksi' => 'pinjaman',
            'isMasuk' => 0,
            'saldo_akhir' => $this->saldoAkhir($request->total,0,$request->id_laporan)
        ];

        if ($request->mode === 'add') {
            $id = DB::table('transaksi_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('transaksi_tb')->where('id', $id)->update($data);
        }

        if ($request->has('lampiran')) {

            request()->validate([
                'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('lampiran');
            $tujuan = "img/lampiran";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('transaksi_tb')
                ->where('id', $id)
                ->update(['lampiran' => "$tujuan/$nama"]);
        }

        return redirect(route('pinjaman'))->with('sukses', 'Pinjaman telah di perbarui');
    }
    public function delete_pinjaman($id)
    {
        DB::table('transaksi_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('pinjaman'))->with('sukses', 'Pinjaman telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------

    public function grupLap()
    {
        $data = DB::table('laporan_tb')->get();
        return view('ui.grupLap.index', ['datas' => $data]);
    }

    public function add_grupLap()
    {
        return view('ui.grupLap.add');
    }

    public function edit_grupLap($id)
    {
        $data = DB::table('laporan_tb')->where('id', $id)->first();
        return view('ui.grupLap.edit', ['data' => $data]);
    }

    public function post_grupLap(Request $request)
    {
        $data = [
            'nama_laporan' => $request->nama_laporan,
            'ket' => $request->ket,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('laporan_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('laporan_tb')->where('id', $id)->update($data);
        }

        if ($request->has('gambar')) {

            request()->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('gambar');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('laporan_tb')
                ->where('id', $id)
                ->update(['gambar' => "$tujuan/$nama"]);
        }

        return redirect(route('grupLap'))->with('sukses', 'Laporan telah di perbarui');
    }

    public function delete_grupLap($id)
    {
        DB::table('laporan_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('grupLap'))->with('sukses', 'Laporan telah di hapus');
    }

    //------------------------------------------------------------------------------------------------------------------
    public function laporan()
    {
        $data = DB::table('laporan_tb')
            ->get();

        return view('ui.laporan.index', ['datas' => $data]);
    }
    public function detail_laporan($id)
    {
        $data = DB::table('transaksi_tb')
            ->leftJoin('laporan_tb', 'transaksi_tb.id_laporan', '=', 'laporan_tb.id')
            ->leftJoin('project_tb', 'transaksi_tb.id_project', '=', 'project_tb.id')
            ->where('laporan_tb.id', $id)
            ->get();

        return view('ui.laporan.detail', ['datas' => $data]);
    }
    //------------------------------------------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------------------------------------

    function idAdmin()
    {
        return Auth::guard('admin')->user()->id;
    }

    function saldoAkhir($jumlah,$isMasuk,$id_laporan){
        $x = DB::table('transaksi_tb')
            ->where('id_laporan',$id_laporan)
            ->orderBy('id','desc')
            ->get();

        if (count($x)>0){
            $saldoLama = $x[0]->saldo_akhir;
        }else{
            $saldoLama = 0;
        }

        if ($isMasuk){
            $saldoBaru = $saldoLama+$jumlah;
        }else{
            $saldoBaru = $saldoLama-$jumlah;
        }
        return $saldoBaru;
    }

    public function md5Pass($pass)
    {
        return md5("$pass@inputproject");
    }
}

