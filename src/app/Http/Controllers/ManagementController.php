<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CSVRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
// マネジメントページ表示
    public function management(Request $request){
        $user_id = Auth::id();
        $user = User::with('role')->find($user_id);
        if($user->role->score === 100){
            $shops = Shop::with('user')->Paginate(10);
            return view('management', compact('shops'));
        }else{
            $shops = Shop::with('user')->UserSearch($user_id)->Paginate(10);
            return view('management', compact('shops'));
        }
    }

 // 店舗代表者作成
    public function add(){
        return view ('create');
    }

    public function create(UserRequest $request)
    {
        User::create([
            'role_id' => 2,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return view('completion');
    }

// メール送信
    public function email(){
        return view ('mail.email');
    }

    public function send(Request $request){
        //メール送信に使うインスタンスを生成
        $request->validate([
            'subject' => ['required'],
            'message' => ['required'],
        ]);
        $data = $request->all();
        $send_email = new SendEmail($data);

		// メール送信
        Mail::send( $send_email );

	    // 送信成功か確認
		if (count(Mail::failures()) > 0) {
            $message = 'メール送信に失敗しました';

			// 元の画面に戻る
            return back()->withErrors($messages);
        }
        else{
            $messages = 'メールを送信しました';

            // 別のページに遷移する
            return view('completion');
        }
    }

// 店舗詳細の修正
    public function edit(Request $request){
        $shop_id=$request['shop_id'];
        $shop=Shop::find($shop_id);
        return view ('shop_edit', compact('shop'));
    }

    public function update(Request $request){
        $shop_id=$request['shop_id'];
        Shop::find($shop_id)->update([
            "shop_name" => $request['shop_name'],
            "genre_id" => $request['genre_id'],
            "area_id" => $request['area_id'],
            "overview" => $request['overview']
        ]);
        return view('completion');
    }

// 新規店舗作成
    public function addShop(){
        return view ('shop_create');
    }

    public function createShop(Request $request){
        $path=Storage::disk('public')->putFile('shop-img', $request->file('shop_img'));
        $full_path = Storage::disk('public')->url($path);
        $user_id=Auth::id();

        Shop::create([
            'shop_name' => $request['shop_name'],
            'user_id' => $user_id,
            'genre_id' => $request['genre_id'],
            'area_id' => $request['area_id'],
            'overview' => $request['overview'],
            'img' => $full_path,
        ]);

        return view('completion');
    }

// 予約一覧
    public function reservationList(Request $request){
        $shop_id=$request['shop_id'];
        $shop=Shop::find($shop_id);
        $reservations=Reservation::ShopSearch($shop_id)->VisitSearch(1)->with('user')->get();
        return view ('reservation_list', compact('shop', 'reservations'));
    }

// 予約詳細
    public function reservationDetail(Request $request){
        $reservation=Reservation::find($request['reservation_id']);
        return view('reservation_detail', compact('reservation'));
    }

// 金額請求
    public function bill(){
        return view('bill');
    }

    public function billQR(Request $request){
        $request->validate([
            'amount' => ['required','integer'],
        ]);
        $amount=$request['amount'];
        return view('bill_qrcode', compact('amount'));
    }

    public function csvImport(CSVRequest $request){
        $shop_data=[
            "shop_name"=>null,
            "genre"=>null,
            "area"=>null,
            "overview"=>null,
            "img"=>null
        ];
        // リクエストからファイルを取得
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        // ファイルを開く
        $fp = fopen($path, 'r');
        // 1行ずつ読み込む
        while (($data = fgetcsv($fp)) !== FALSE) {
            switch($data[0]){
                case 'name':
                    $shop_data['shop_name']=$data[1];
                    break;
                case 'genre':
                    $shop_data['genre']=$data[1];
                case 'area':
                    $shop_data['area']=$data[1];
                case 'overview':
                    $shop_data['overview']=$data[1];
                case 'img':
                    $shop_data['img']=$data[1];
            }
        }
        return view('csv_import',compact('shop_data'));
    }
}
