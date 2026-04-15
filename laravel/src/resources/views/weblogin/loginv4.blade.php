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
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            min-height: 100dvh; 
            background-image: url('/img/bg.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #login_email {
            color: #000000 !important;
            background-color: white;
        }

        #login_email::placeholder {
            color: #6b7280;
        }
    </style>
</head>
<body class="p-4">
    <div class="max-w-sm w-full bg-red-600/80 p-8 rounded-3xl text-center text-white shadow-2xl backdrop-blur-md">
        
        <p class="text-sm px-2" id="welcomeinfo">
            <?php if ($guest) { ?> 
                <b>Welcome back {{ $guest['email'] }}</b>
            <?php } else { ?>
                Please enter your email to access the internet.
            <?php } ?>
        </p>

        <input type="email" 
               class="rounded-xl text-gray-800 mt-6 w-full px-6 py-3 border-none focus:ring-2 focus:ring-teal-300 <?php if($guest) { echo "hidden"; } ?>" 
               name="email" 
               required 
               autofocus 
               id="login_email" 
               placeholder="Input your email" />
        
        <input type="hidden" id="mac" value="<?php if (isset($data['mac'])) { echo $data['mac']; } ?>" >
        
        <button id="submitBtn" class="bg-teal-400 text-indigo-950 font-black px-6 py-3 rounded-xl mt-4 w-full tracking-wide uppercase <?php if ($guest) { echo "hidden"; } ?>">
            Sign In
        </button>
        
        <button id="siginForm" class="bg-teal-400 text-indigo-950 font-black px-6 py-3 rounded-xl mt-4 w-full tracking-wide uppercase <?php if (!$guest) { echo "hidden"; } ?>">
            Login
        </button>

        <div class="mt-4">
            <p id="errorInfo" class="font-bold text-yellow-300 text-xs"></p>
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
                    if (typeof result.msg.name !== "undefined") { errmsg = `<b>${result.msg.name[0]}</b><br>`; }
                    if (typeof result.msg.email !== "undefined") { errmsg += `<b>${result.msg.email[0]}</b>`; }
                    errorInfo.innerHTML = errmsg;
                } else {
                    submitBtn.classList.add('hidden');
                    email.classList.add('hidden');
                    siginForm.classList.remove('hidden');
                    errorInfo.innerHTML = '';
                    welcomeinfo.innerHTML = result.exist === false ? `<b>Welcome ${result.msg.name}</b>` : `<b>Welcome back ${result.msg.name}</b>`;
                }
            } catch (error) {
                console.log(error);
                errorInfo.innerHTML = "Connection Error. Please try again.";
            }
        });

        siginForm.addEventListener('click', () => {
            <?php if (isset($data['chap-d'])) { if(strlen($data['chap-id']) < 1) { ?>
                document.loginweb.submit(); <?php } ?>
                return false;
            <?php } else { ?>
                document.loginweb.password.value = hexMD5('<?php if (isset($data['chap-id'])) { echo $data['chap-id']; } ?>' + document.loginweb.password.value + '<?php if (isset($data['chap-challenge'])) { echo $data['chap-challenge']; } ?>');
                document.loginweb.submit();
                return false;
            <?php } ?>
        })
    </script>
</body>
</html>