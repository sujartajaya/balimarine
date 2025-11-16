@extends('layout.app')
    @section('content')
    <div class="flex flex-col items-center justify-center mx-auto">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">User Guest Profile &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h1>
            <form action="#" method="POST" class="space-y-4">
            <input type="hidden" name="_method" value="patch">
            <div>
                <label for="expire" class="block text-sm font-medium text-gray-600">Expire time (Minutes) per-day</label>
                <input 
                type="number" 
                id="expire" 
                name="expire" 
                value="{{$expire}}"
                placeholder="Enter your full name" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required autofocus>
            </div>
            <div>
                <label for="rate_limit" class="block text-sm font-medium text-gray-600">Rate Limit</label>
                <input 
                type="text" 
                id="rate_limit" 
                name="rate_limit" 
                value="{{$radgroupreply->value}}"
                placeholder="1M/1M 2M/2M 1M/1M 40/40" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                required>
            </div>
            <div>
                <button 
                type="button" 
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300" id="btnsave">
                Save
                </button>
            </div>
            </form>
        </div>
    </div>
    <script>
        const url_base = "{{ env('APP_URL_AXIOS')}}:9080/hotspot/user/email/profile";
        const expire = document.getElementById('expire');
        const rate_limit = document.getElementById('rate_limit');
        const btnsave = document.getElementById('btnsave');
        btnsave.addEventListener('click', () => {
            axios
                .patch(
                    `<?php echo env('APP_URL_AXIOS'); ?>/hotspot/user/email/profile/{{$radgroupreply->id}}`,
                    {
                        'expire':expire.value,
                        'rate_limit':rate_limit.value,
                    }
                )
                .then( (response) => {
                    const data = response.data;
                    swal({title: 'Guest user profile',text:data['msg'],icon: 'info',button: true,});
                }

                )
            
        });
    </script>
    @endsection
    @section('addscript')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @endsection
