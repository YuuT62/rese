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
use App\Http\Requests\CSVImportRequest;
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
        $users=User::RoleSearch(2)->get();
        return view ('shop_edit', compact('shop', 'users'));
    }

    public function update(Request $request){
        $shop_id=$request['shop_id'];
        if($request->file('img') !== null){
                $path=Storage::disk('public')->putFile('shop-img', $request->file('img'));
                $full_path = Storage::disk('public')->url($path);
        }else{
            $full_path=null;
        }
        Shop::find($shop_id)->update([
            "shop_name" => $request['shop_name'],
            "user_id" => $request['user_id'],
            "genre_id" => $request['genre_id'],
            "area_id" => $request['area_id'],
            "overview" => $request['overview'],
            "img" => $full_path
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

    // CSVファイルインポート
    public function csvImport(CSVImportRequest $request){
        $shop_data=[
            "shop_name"=>null,
            "genre"=>null,
            "area"=>null,
            "overview"=>null,
            "url"=>null
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
                    break;
                case 'area':
                    $shop_data['area']=$data[1];
                    break;
                case 'overview':
                    $shop_data['overview']=$data[1];
                    break;
                case 'url':
                    $shop_data['url']=$data[1];
                    break;
            }
        }

        return view('csv_import',compact('shop_data'));
    }

    // 新規店舗作成（CSVファイル）
    public function csvSubmit(Request $request){

        $shop_name=$request['shop_name'];
        $genre=$request['genre'];
        $area=$request['area'];
        $overview=$request['overview'];
        $url=$request['url'];
        $url_explode=explode(".", $url);
        $url_extension=$url_explode[count($url_explode)-1];
        if($shop_name === null || $shop_name===""){
            return redirect('/management')->with('messages', '店舗名がありません');
        }elseif(mb_strlen($shop_name) > 50){
            return redirect('/management')->with('messages', '店舗名は50文字以内にしてください');
        }
        if($genre === null || $genre === ""){
            return redirect('/management')->with('messages', 'ジャンルがありません');
        }elseif($genre !== "寿司" && $genre !== "焼肉" && $genre !== "イタリアン" && $genre !== "居酒屋" && $genre !== "ラーメン"){
            return redirect('/management')->with('messages', 'ジャンルは「寿司」、「焼肉」、「イタリアン」、「居酒屋」、「ラーメン」のみ設定できます');
        }
        if($area === null || $area === ""){
            return redirect('/management')->with('messages', 'エリアがありません');
        }elseif($area !== "東京都" && $area !== "大阪府" && $area !== "福岡県"){
            return redirect('/management')->with('messages', 'エリアは「東京都」、「大阪府」、「福岡県」のみ設定できます');
        }
        if($overview === null || $overview === ""){
            return redirect('/management')->with('messages', '店舗概要がありません');
        }elseif(mb_strlen($overview) > 400){
            return redirect('/management')->with('messages', '店舗概要は400文字以内にしてください');
        }
        if($url === null || $url === ""){
            return redirect('/management')->with('messages', '店舗画像のURLがありません');
        }elseif($url_extension !== 'png' && $url_extension !== 'jpg' && $url_extension !== 'jpeg'){
            return redirect('/management')->with('messages', 'ファイル拡張子は「jpg」、「png」のみです');
        }

        switch($genre){
            case '寿司':
                $genre_id = 1;
                break;
            case '焼肉':
                $genre_id = 2;
                break;
            case 'イタリアン':
                $genre_id = 3;
                break;
            case '居酒屋':
                $genre_id = 4;
                break;
            case 'ラーメン':
                $genre_id = 5;
                break;
        }

        switch($area){
            case '東京都':
                $area_id = 1;
                break;
            case '大阪府':
                $area_id = 2;
                break;
            case '福岡県':
                $area_id = 3;
                break;
        }

        Shop::create([
            'shop_name' => $shop_name,
            'user_id' => null,
            'genre_id' => $genre_id,
            'area_id' => $area_id,
            'overview' => $overview,
            'img' => $url,
        ]);

        return view('completion');
    }
}
