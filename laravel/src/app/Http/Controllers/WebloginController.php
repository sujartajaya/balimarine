<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Radcheck;
use DateTime;
use App\Models\Guest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class WebloginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weblogin.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('weblogin.adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datareq = $request->all();
        $data = [];
        $datareq['os_client'] = $this->getOS();
        $datareq['browser_client'] = $this->getBrowser();

        $guest = Guest::where('email',$datareq['email'])->first();
        if ($guest) {
            $data['error'] = false;
            $data['exist'] = true;
            $data['msg'] = $guest;
            $guest->mac_add = $datareq['mac_add'];
            $guest->os_client = $this->getOS();
            $guest->browser_client = $this->getBrowser();
            $guest->update();
            return response()->json($data,200);
        }

        $datareq['username'] = Str::random(10);
        $datareq['password'] = Str::password(8);


        $validator = Validator::make($datareq, [
                'name' => ['required'],
                'email' => ['required','email:rfc,dns','unique:guests'],
                'username' => ['required','unique:guests'],
                'password' => ['required'],
                'mac_add' => ['required'],
                'country_id' => ['required']
        ]);

        if ($validator)
        {
            if ($validator->fails())
            {
                $data['error'] = true;
                $data['exist'] = false;
                $data['msg'] = $validator->messages();
                return response()->json($data,200);
            } else {
                $data['error'] = false;
                $data['exist'] = false;
                $guest = Guest::create($datareq);
                $data['msg'] = $guest;

                $userlogin['username'] = $datareq['username'];
                $userlogin['op'] = ":=";
                $userlogin['attribute'] = "Cleartext-Password";
                $userlogin['value'] = $datareq['password'];

                $radcheck = Radcheck::create($userlogin);

                return response()->json($data,201);
            }
        }
    }


    /** store data loginv4 */
    public function storev4(Request $request)
    {
        $datareq = $request->all();

        // ========================
        // 🔥 BASIC VALIDATION (tanpa DNS)
        // ========================
        $basicValidator = Validator::make($datareq, [
            'email' => ['required'],
            'mac_add' => ['required'],
            'country_id' => ['required']
        ]);

        if ($basicValidator->fails()) {
            return response()->json([
                'error' => true,
                'exist' => false,
                'msg'   => $basicValidator->messages()
            ], 200);
        }

        // ========================
        // 🔥 VALIDASI EMAIL VIA PYTHON API
        // ========================
        $validatorApi = Http::timeout(5)
            ->retry(2, 100)
            ->post('http://email-validator:9090/validate', [
                'email' => $datareq['email'],
                'mac'   => $datareq['mac_add']
            ]);

        if (!$validatorApi->ok()) {
            return response()->json([
                'error' => true,
                'exist' => false,
                'msg'   => 'Validator service error'
            ], 500);
        }

        $validation = $validatorApi->json();

        // 🚫 BLOCKED (rate limit dari Redis Python)
        if (!empty($validation['blocked']) && $validation['blocked'] === true) {
            return response()->json([
                'error' => true,
                'exist' => false,
                'msg'   => $validation['message'] ?? 'Too many attempts',
                'retry_after' => $validation['retry_after'] ?? null
            ], 200);
        }

        // ❌ INVALID EMAIL
        if (empty($validation['is_valid']) || $validation['is_valid'] !== true) {
            return response()->json([
                'error' => true,
                'exist' => false,
                'msg'   => 'Email tidak valid',
                'detail'=> $validation
            ], 200);
        }

        // ========================
        // 🔥 PREPARE DATA
        // ========================
        $datareq['os_client'] = $this->getOS();
        $datareq['browser_client'] = $this->getBrowser();

        // generate name dari email (user@domain → "User")
        $name = explode("@", $datareq['email']);
        $datanm = explode(".", $name[0]);
        $nama = "";
        foreach ($datanm as $i => $val) {
            $nama .= $i === 0 ? $val : " ".$val;
        }
        $datareq['name'] = ucwords($nama);

        // ========================
        // 🔥 CEK USER EXIST
        // ========================
        $guest = Guest::where('email', $datareq['email'])->first();

        if ($guest) {
            $guest->update([
                'mac_add'        => $datareq['mac_add'],
                'os_client'      => $datareq['os_client'],
                'browser_client' => $datareq['browser_client'],
            ]);

            // pastikan ada di radcheck
            $userlogin = Radcheck::where('username', $guest->username)->first();

            if (!$userlogin) {
                Radcheck::create([
                    'username'  => $guest->username,
                    'attribute' => 'Cleartext-Password',
                    'op'        => ':=',
                    'value'     => $guest->password
                ]);
            }

            return response()->json([
                'error' => false,
                'exist' => true,
                'msg'   => $guest
            ], 200);
        }

        // ========================
        // 🔥 CREATE USER BARU
        // ========================
        $datareq['username'] = Str::random(10);
        $datareq['password'] = Str::password(8);

        // VALIDASI DB (tanpa email:rfc,dns)
        $validator = Validator::make($datareq, [
            'name'     => ['required'],
            'email'    => ['required', 'unique:guests,email'],
            'username' => ['required', 'unique:guests,username'],
            'password' => ['required'],
            'mac_add'  => ['required'],
            'country_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'exist' => false,
                'msg'   => $validator->messages()
            ], 200);
        }

        $guest = Guest::create($datareq);

        Radcheck::create([
            'username'  => $datareq['username'],
            'attribute' => 'Cleartext-Password',
            'op'        => ':=',
            'value'     => $datareq['password']
        ]);

        return response()->json([
            'error' => false,
            'exist' => false,
            'msg'   => $guest
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function showUser(string $username)
    {
        $users = Radcheck::select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.username',$username)->where('radcheck.attribute','Cleartext-Password')->get();
        return json_encode($users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function reqlogin(Request $request) {
        $data = $request->all();
        //dd(($data));
        //return view('weblogin.login',compact('data'));
        return view('weblogin.emailv1',compact('data'));
    }

    /** API for check login email */
    public function loginemail(Request $request) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $email = $request->email;
        $pesan = [];
        $waktu = new DateTime();
        $time_expire = "+".env('USER_PROFILE_EXPIRE')." minutes";
        $waktu1 = $waktu->modify($time_expire);
        $expiration = $waktu1->format('d M Y H:i:s');
        /** cek format email */
        if (preg_match($pattern, $email)) {
            /** cek domain email */
            $emailArray = explode("@", $email);
            if (checkdnsrr(array_pop($emailArray), "MX")) {
                $emaildb = DB::table('radcheck')->where('username',$email)->orderBy('id','asc')->get();
                if (($emaildb->count() == 0)) {
                    $data = [
                        "username" => $email,
                        "attribute" => "Cleartext-Password",
                        "op" => ":=",
                        "value" => $email
                    ];
                    $addemail = DB::table('radcheck')->insert($data);
                    $data = [
                        "username" => $email,
                        "attribute" => "Expiration",
                        "op" => ":=",
                        "value" => $expiration
                    ];
                    $addemail = DB::table('radcheck')->insert($data);

                    $usergroup = DB::table('radusergroup')->insert([
                        "username" => $email,
                        "groupname" => "GUEST",
                        "priority" => 10
                    ]);

                    if ($addemail) {
                        $pesan['error'] = false;
                        $pesan['data'] = "New email add!";
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    } else {
                        $pesan['error'] = true;
                        $pesan['data'] = 'Database error!';
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    }
                }  else {
                    if ($emaildb->count() > 1) {
                        $expire = $emaildb[1]->value;
                        /** check if date expire == today */
                        $today = new DateTime();

                        $check_expire = new DateTime($expire);    
                        $check_expire = $check_expire->format('Y-m-d');
                        $check_today = $today->format('Y-m-d');

                        $tgl = $today->format('d M Y H:i:s');
                        $tgl_expire = strtotime($expire);
                        $tgl_sekarang = strtotime($tgl);

                        if (($tgl_expire < $tgl_sekarang) && ($check_expire == $check_today)) {
                            $pesan['data'] = 'Your internet usage time has run out, please try again tomorrow!';
                            $pesan['error'] = true;
                            $pesan['email'] = $emaildb;
                            return json_encode($pesan);
                        }
                        if (($check_expire != $check_today) && ($tgl_expire < $tgl_sekarang)) {
                            /** reset expire */
                            $radcheck = DB::table('radcheck')->where('username',$email)->where('attribute','Expiration')->update(['value' => $expiration]);

                            $pesan['data'] = 'Your email can still login!';
                            $pesan['error'] = false;
                        } else {
                            $pesan['data'] = 'Your email can still login!';
                            $pesan['error'] = false;
                        }

                        $pesan['email'] = $emaildb;

                        return json_encode($pesan);
                    } else {
                        $pesan['data'] = 'Email khusus member!';
                        $pesan['error'] = false;
                        $pesan['email'] = $emaildb;

                        return json_encode($pesan);
                    }
                }
            } else {
                $pesan['error'] = true;
                $pesan['data'] = "Your email not valid!";
                $pesan['email'] = $email;
                return json_encode($pesan);
            }
        } else {
            $pesan['error'] = true;
            $pesan['data'] = "Your email not valid!";
            $pesan['email'] = $email;
            return json_encode($pesan);
        }
    }

    public function testlogin() {
        return view('weblogin.loginv1');
    }

    public function testloginmail() 
    {
        return view('weblogin.email');
    }

    /** API for req chcek member */
    public function checkMember(Request $request)
    {
        $data =  $request->all();
        $member = Member::where('email',$request->email)->first();
        $res = [];

        if ($member) {
            $res['error'] = false;
            $res['data'] = $member;
            return json_encode($res);
        } else {
            $datamem = Member::create($data);

            if ($datamem)
            {
                $res['error'] = false;
                $res['data'] = $datamem;
                return json_encode($res);
            } else {
                $res['error'] = true;
                $res['data'] = "Ada error saat simpasan data member";
                return json_encode($res);
            }
        }
    }

    public function getAllUsers(Request $request)
    {
        //$users = DB::table('radcheck','')->where('attribute','Cleartext-Password')->orderBy('id','asc')->paginate(5);

        //$users =  DB::table('radcheck')->select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.attribute','Cleartext-Password')->paginate(5);

       $users = Radcheck::search($request->search)->select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.attribute','Cleartext-Password')->paginate(2);

        //return json_encode($users);

        //$users = Radcheck::search($request->search)->where('attribute','Cleartext-Password')->paginate(5);


        //return json_encode($users);

        return view('weblogin.users',compact('users'));
    }

    public function viewModal()
    {
        return view('weblogin.modal');
    }


    /** Request login v3 input name, email, country **/
    public function reqloginv3(Request $request)
    {
        $data = $request->all();
	if (isset($data['mac'])) {
            $mac_add = $data['mac'];
	} else $mac_add = "";
        $guest = Guest::where('mac_add',$mac_add)->first();
        if ($guest) {
            $guest->os_client = $this->getOS();
            $guest->browser_client = $this->getBrowser();
            $guest->update();
        }
        return view('weblogin.loginv3',compact('data','guest'));
    }


    /** Request login v4 input name, email, country **/
    public function reqloginv4(Request $request)
    {
        $data = $request->all();
        if (isset($data['mac'])) {
            $mac_add = $data['mac'];
        } else $mac_add = "";
        $guest = Guest::where('mac_add',$mac_add)->first();
        if ($guest) {
            $guest->os_client = $this->getOS();
            $guest->browser_client = $this->getBrowser();
            $guest->update();
        }
        return view('weblogin.loginv4',compact('data','guest'));
    }



    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_array = [
            '/windows nt 10/i'     => 'Windows 10',
            '/windows nt 6.3/i'     => 'Windows 8.1',
            '/windows nt 6.2/i'     => 'Windows 8',
            '/windows nt 6.1/i'     => 'Windows 7',
            '/windows nt 6.0/i'     => 'Windows Vista',
            '/windows nt 5.1/i'     => 'Windows XP',
            '/macintosh|mac os x/i' => 'Mac OS',
            '/linux/i'              => 'Linux',
            '/ubuntu/i'             => 'Ubuntu',
            '/iphone/i'             => 'iPhone',
            '/ipad/i'               => 'iPad',
            '/android/i'            => 'Android',
        ];
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                return $value;
            }
        }
        return 'Unknown OS';
    }


    private function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser_array = [
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
        ];
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                return $value;
            }
        }
        return 'Unknown Browser';
    }

}
