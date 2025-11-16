@extends('layout.app')
    @section('content')
    <div class="max-w w-full">
            <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
                <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Email User Lists</h2>
                        <div class="flex flex-col px-3 py-8 mx-auto lg:py-0 mt-1 items-center justify-center">
                                <div class="w-full max-w-sm min-w-[200px] relative">
                                    <div class="relative">
                                        <form action="/hotspot/email/users" method="GET">
                                        <input name="search" id="searchBox"
                                        class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                                        placeholder="Search ...."
                                        />
                                        <button
                                        class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                                        type="button"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                        </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                        <button onClick="export_data('data.csv')" type="button" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Export</button>
                    </div>
                    <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200" id="data-table">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=$emailusers->firstItem(); $dt = 0; ?>
                            @foreach ($emailusers as $email)
                                <tr>
                                    <?php $dt=$dt+1; ?>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $i++ }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $email->username }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                                        <div class="flex space-x-2">
                                            <div class="relative group">
                                            <button onClick="alert('Profile')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <div class="absolute mt-1 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-sm rounded-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                Profile {{$email->username}}
                                            </div>
                                            </div>
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 mt-4">
                        {{$emailusers->withQueryString()->links('pagination::tailwind')}}
                    </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        function export_data(filename) {
            const url_base = "{{ env('APP_URL_AXIOS')}}/test/userguest/export";
            fetch(url_base, {
            method: 'GET'
            }).then((response) => {

            response.json().then((jsonResponse) => {
                if (jsonResponse.length >= 0) {
                    if (Array.isArray(jsonResponse)) {
                        let i = 1;
                        jsonResponse.map(item => {
                        if (typeof item === 'object' && item !== null) {
                            item['no'] = i;
                            }
                            i=i+1;
                            return item;
                         });
                    }
                    const headers = Object.keys(jsonResponse[0]);
                    const rows = jsonResponse.map(obj => 
                        headers.map(header => 
                            `"${obj[header] || ''}"`
                        ).join(','));
                    const csvContent = [headers.join(','), ...rows].join('\n');
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = filename;
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            })
            
            }).catch((err) => {
            console.log(`Error: ${err}` )
            });
        }
    </script>
    @endsection
