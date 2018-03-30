<?php
/**
 * Created by PhpStorm.
 * User: umaaamm
 * Date: 27/03/18
 * Time: 15.56
 */

namespace App\Http\Controllers;
use Mail;
use App\Register;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;
use PDF;

class RegisterController extends Controller
{

    public function index()
    {
        $data = Register::all();
        return response()->json($data);
    }

    public function destroy($id)
    {
        $Register = Register::find($id);

        if ($Register) {
            $Register->delete();
            return response()->json(['stats' => 'success', 'message' => 'Data has been deleted']);
        }

        return response()->json(['status' => 'error', 'message' => 'Cannot deleting data'], 400);
    }

    public function show($id)
    {
        $Register = Register::find($id);

        if ($Register) {
            return response()->json(['status' => 'success', 'data' => $Register]);
        }

        return response()->json(['status' => 'error', 'message' => 'Data not found'], 404);
    }

    public function add(Request $request)
    {

        $model = new Register();
        $model->nama = $request->input('nama');
        $model->no_telp = $request->input('no_telp');
        $model->email = $request->input('email');
        $model->keterangan = $request->input('keterangan');
        $model->save();
        return response()->json(['message' => 'ok']);
    }

    public function put(Request $request, $id)
    {
        $Registrasi = Register::find($id);

        if ($Registrasi) {
            //$Registrasi->nama = $request->input('nama');
            //$Registrasi->no_telp = $request->input('no_telp');
            //$Registrasi->email = $request->input('email');
            $Registrasi->keterangan = 'Hadir';
            $Registrasi->save();
            return response()->json(['status' => 'success', 'message' => 'Data has been updated']);
        }

        return response()->json(['status' => 'error', 'message' => 'Cannot updating data'], 400);

    }

    public function showQR()
    {
        $data = 'umam';
        $data = [
            'title' => 'umam',
            'data' => [

            ],
        ];
        return view('welcome', $data);
        //return '<img src="'.(new QRCode)->render($data).'" />';
    }

    public function home()
    {
        return view('pages/home');
    }

    public function register()
    {
        $Register = Register::all();

        return view('pages/register',compact('Register'));
    }

    public function simpan(Request $request){
        //untuk menyimpan
        $model = new Register();
        $model->nama = $request->input('nama');
        $model->no_telp = $request->input('no_telp');
        $model->email = $request->input('email');
        $model->keterangan = $request->input('keterangan');
        $status =  $model->save();
        $data=(new QRCode)->render($model->id);
        $png_url = "barcode-".time().".png";
        $path = public_path().'/asset/img/' . $png_url;
        \Image::make(file_get_contents($data))->save($path);

        //mengiriman email
        try{
            Mail::send('email',['nama' => $request->nama,
                'path' => $path],
                function ($message) use ($request, $data)
            {
                $message->subject('Terimakasih Banyak Sudah Mendaftar');
                $message->from('hambaallah.teknokrat@gmail.com','Registrasi Event');
                $message->to($request->email);
                //$message->attach(storage_path());
            });

        }catch (Exception $e){
            return Response(['status'=> false,'errors' => $e->getMessage()]);
        }
        //redirect
        if ($status)
        {
          return redirect('/register')->with(['success' => 'Data Berhasil Disimpan']);;

        }else{

          return redirect('/register')->with(['error' => 'Gagal Menyimpan']);;
        };

    }
    public function hapus($id)
    {
        $Register = Register::find($id);

        if ($Register) {
            $Register->delete();
            return redirect('/register')->with(['success' => 'Data Berhasil Dihapus']);
        }

        return redirect('/register')->with(['error' => 'Gagal Menghapus']);

    }
    public function sendEmail(Request $request){
           try{
               Mail::send('email',['nama' => $request->nama,'pesan' => $request->pesan],function ($message) use ($request)
               {
                   $message->subject($request->judul);
                   $message->from('umam.tekno@gmail.com','Copyright03');
                   $message->to($request->email);
               });
               return back()->with('alert-success','berhasil');

           }catch (Exception $e){
                  return Response(['status'=> false,'errors' => $e->getMessage()]);
           }
    }

    public function pdf(){
        $pdf = PDF::loadView('pages/home');
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download();
    }

}