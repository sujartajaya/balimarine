<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bali Marine Park</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/tsi/md5.js"></script>
	<link href="/medialink1.png" rel="icon" type="image/x-icon" />
</head>
<body class="bg-white flex justify-center items-center min-h-screen p-2">
    <div class="max-w-sm w-full bg-red-400 p-6 rounded-lg text-center text-white shadow-lg">
        <div class="my-2 flex justify-center">
            <img src="{{ route('root') }}/logo_tsi.png" alt="Bali Marine Park">
        </div>

        <p class="text-sm font-semibold">FREE INTERNET ACCESS</p>
        <p class="text-xs mt-2 px-2" id="welcomeinfo" ><?php if ($guest) { ?>  <b>Welcome back {{ $guest['email'] }}</b><?php } else {?>By clicking the "Sigin" button, you consent to receive marketing, promotional messages and information about Bali Marine and Bali Safari Park. You may opt out of communications at any time. All data obtained is subject to the Privacy Policy.<?php } ?></p>
	<input type="email" class="rounded-lg text-gray-800 mt-4 w-full px-6 py-2 <?php if($guest) { echo "hidden"; } ?>" name="email" required autofocus id="login_email" placeholder="Input your email" />
        <input type="hidden" id="mac" value="<?php if (isset($data['mac'])) { echo $data['mac']; } ?>" >
	<button id="submitBtn" class="bg-teal-400 text-indigo-900 font-bold px-6 py-2 rounded-lg mt-4 w-full <?php if ($guest) { echo "hidden"; } ?>">Sigin</button>
        <button id="siginForm" class="bg-teal-400 text-indigo-900 font-bold px-6 py-2 rounded-lg mt-4 w-full <?php if (!$guest) { echo "hidden"; } ?>">Login</button>

        <div class="mt-6 text-sm">
            <p id="errorInfo" class="font-bold text-red-800"><?php if(isset($data['error'])) { echo $data['error']; } ?></p>
        </div>
        <div class="mt-6 text-sm">
            <p class="font-bold">Jalan Bypass Prof. Dr. Ida Bagus Mantra</p>
            <p>Km. 19,8 Kec. Gianyar, Bali</p>
            <p>80551 - Indonesia</p>
        </div>

        <div class="mt-4 space-y-2 text-sm flex flex-col text-left">
            <p>☎  (+62) 361 950 000</p>
            <p>📷 tamansafaribali</p>
            <p>🌐 tamansafari.com/marine-safari-bali/marine-life/</p>
        </div>
    </div>


    <form name="loginweb" action="<?php if (isset($data['link-login-only'])) { echo $data['link-login-only']; } ?>" method="POST">
        <input type="hidden" name="username" value="<?php if($guest) { echo $guest['username']; }?>" />
        <input type="hidden" name="password" value="<?php if($guest) { echo $guest['password']; }?>" />
        <input type="hidden" name="dst" value="https://tamansafari.com/marine-safari-bali/marine-life/" />
        <input type="hidden" name="popup" value="true" />
    </form>

    <script>
        const submitBtn = document.getElementById('submitBtn');
        const siginForm = document.getElementById('siginForm');
        const welcomeinfo = document.getElementById('welcomeinfo');
        const mac_add = document.getElementById('mac');
        const errorInfo = document.getElementById('errorInfo');

        let email = document.getElementById('login_email');


        submitBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            const country_id = 96;
            const post_url = "<?php echo route('webloginv4'); ?>/store";
            try {

                const response = await fetch(post_url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({name:email.value, email:email.value, country_id:country_id, mac_add:mac_add.value})
                })
                const result = await response.json();


                document.loginweb.username.value = result.msg.username;
                document.loginweb.password.value = result.msg.password;

                if (result.error === true) {
                    let errmsg = "";

                    if (typeof result.msg.name !== "undefined") {
                        errmsg = `<b>${result.msg.name[0]}</b><br>`;
                    }
                    if (typeof result.msg.email !== "undefined") {
                        errmsg = errmsg + `<b>${result.msg.email[0]}</b>`;
                    }

                    errorInfo.innerHTML = errmsg;
                } else {

                    submitBtn.classList.add('hidden');
		    email.classList.add('hidden');
                    siginForm.classList.remove('hidden');

		    errorInfo.innerHTML = '';
                    if (result.exist === false) {
                        welcomeinfo.innerHTML = `<b>Welcome ${result.msg.name}</b>`
                    } else {
                        welcomeinfo.innerHTML = `<b>Welcome back ${result.msg.name}</b>`
                    }
                }


            } catch (error) {
                console.log(error);
            }
        });

        siginForm.addEventListener('click', () => {
                    <?php if (isset($data['chap-d'])) { if(strlen($data['chap-id']) < 1)  { ?>
                        document.loginweb.submit(); <?php } ?>
                        return false;
                    <?php }  else { ?>
                        document.loginweb.password.value = hexMD5('<?php if (isset($data['chap-id'])) { echo $data['chap-id']; } ?>' + document.loginweb.password.value + '<?php if (isset($data['chap-challenge'])) { echo $data['chap-challenge']; } ?>');
                        document.loginweb.submit();
                        return false;
                  <?php } ?>
        })
    </script>
</body>
</html>
