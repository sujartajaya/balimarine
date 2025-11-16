@extends('layout.app')
    @section('content')
        <script>
            let editmac = false;
            let idmac = "";

            function edit(id) {
                idmac = id;
                editmac = true;
                axios
                    .get(
                        `<?php echo env('APP_URL_AXIOS'); ?>/hotspot/mac/binding/${id}`
                    )
                    .then((response) => {
                        const data = response.data;
                        const mac = data['mac'][0];

                        if (data['error'] == false) {
                            const frmmac = document.getElementById('mac');
                            const type = document.getElementById('type');
                            const comment = document.getElementById('comment');
                            const disabled = document.getElementById('disabled');
                            const frmdisable = document.getElementById('frmdisable');
                            const macSaveFooterBtn = document.getElementById('macSaveFooterBtn');
                            const macModal = document.getElementById('macModal');
                            frmdisable.classList.remove('hidden');
                            frmmac.value = mac['mac-address'];
                            type.value = mac['type'];
                            comment.value = mac['comment'];
                            disabled.value = mac['disabled'];
                            macSaveFooterBtn.innerHTML = "Update";
                            macModal.classList.remove('hidden');
                        }
                    })
                    .catch(err => {
                        console.log('Oh noooo!!');
                        console.log(err);
                    })
            }

            function confirmDelete(id) {
                const userConfirmed = confirm("Are you sure you want to delete this item?");
                if (userConfirmed) {
                    axios
                    .post(
                         `<?php echo env('APP_URL_AXIOS'); ?>/hotspot/mac/binding/${id}`,{
                            'id': id
                        })
                    .then((response) => {
                        const data = response.data;
                        console.log(data);
                        if (data['error'] == false) {
                            location.reload();
                        }
                    })
                    .catch(err => {
                        console.log('Oh noooo!!');
                        console.log(err.response.data);
                    })
                }
            }
        </script>
        <!-- mac table -->
        <div class="max-w w-full">
            <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
                <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Mac Address Bindings</h2>
                    <div class="flex flex-col px-3 py-8 mx-auto lg:py-0 mt-1 items-center justify-center">
                            <div class="w-full max-w-sm min-w-[200px] relative">
                            <div class="relative">
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
                            </div>
                            </div>
                    </div>
                    <button
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" id="openModalBtn"
                    >
                        Add Mac
                    </button>
                    </div>
                    <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200" id="data-table">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Mac Address</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Type</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Disable</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Description</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="pagination mt-3" id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end mac table -->
        <!-- Modal add mac add -->
            <div id="macModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800" id="userProfileInfo"></h2>
                    <button
                        id="userProfilecloseModalBtn"
                        class="text-gray-600 hover:text-gray-800 focus:outline-none"
                    >
                        ✖
                    </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="relative p-6 flex-auto">
                                        <form>
                                        <div class="flex flex-wrap -mx-3 mb-4">
                                                    <div class="w-full md:w-1/2 px-3">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="mac">
                                                            Mac address
                                                        </label>
                                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="mac" type="text" placeholder="00:00:00:00:00:00">
                                                    </div>
                                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="type">
                                                            Type
                                                        </label>
                                                        <select class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="type">
                                                        <option value="blocked">blocked</option>
                                                        <option value="bypassed">bypassed</option>
                                                        <option value="regular">regular</option>
                                                        </select>
                                                    </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-4">
                                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="comment">
                                                        Description
                                                        </label>
                                                        <input class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="comment" type="text" placeholder="Description">
                                                    </div>
                                                    <div class="w-full md:w-1/2 px-3 hidden" id="frmdisable">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="disabled">
                                                            Disabled
                                                        </label>
                                                        <select class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="disabled">
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                        </select>
                                                    </div>
                                        </div>
                                        </form>

                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b space-x-2">
                    <button
                        id="macCloseFooterBtn"
                        class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Close
                    </button>
                    <button id="macSaveFooterBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Save
                    </button>
                    </div>
                </div>
            </div>
        <!-- end modal add macc -->

        
        <script>
            let data = [];
            <?php if ($data['error'] == false) { ?>
            data = <?php echo json_encode($data['mac']); ?>;    
            <?php } ?>
            const rowsPerPage = 10;
            let currentPage = 1;
            let filteredData = [...data]; // Data untuk pencarian
            function renderTable(page) {
            const tableBody = document.querySelector("#data-table tbody");
            tableBody.innerHTML = "";
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageData = filteredData.slice(start, end);
            let x = 0;
            pageData.forEach((item) => {
                const row = document.createElement("tr");
                x = x + 1;
                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${x}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['mac-address']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['type']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['disabled']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['comment']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                    <div class="flex space-x-2">
                        <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400" onClick="edit('${item['.id']}')"
                            >
                            Edit
                        </button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400" onClick="confirmDelete('${item['.id']}')"
                            >
                            Delete
                        </button>
                    </div>
                    </td>
                    
                `;
                tableBody.appendChild(row);
            });
            renderPagination();
            }

            function renderPagination() {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            if (totalPages > 1) {
            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement("button");
                button.textContent = i;
                button.classList.toggle("active", i === currentPage);
                button.disabled = i === currentPage;
                button.addEventListener("click", () => {
                currentPage = i;
                renderTable(currentPage);
                });
                pagination.appendChild(button);
            }
            }
            }

            function handleSearch() {
            const searchQuery = document.getElementById("searchBox").value.toLowerCase();

            filteredData = data.filter((item) => 
                item['comment'].toLowerCase().includes(searchQuery) || 
                item['mac-address'].toString().includes(searchQuery)
            );

            currentPage = 1; // Reset ke halaman pertama
            renderTable(currentPage);
            }

            // Event listener untuk pencarian
            document.getElementById("searchBox").addEventListener("input", handleSearch);

            // Render tabel awal
            renderTable(currentPage);
            
        </script>
        <script>
            const macModal = document.getElementById('macModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const macCloseFooterBtn = document.getElementById('macCloseFooterBtn');
            const macSaveFooterBtn = document.getElementById('macSaveFooterBtn');
            const mac = document.getElementById('mac');
            const type = document.getElementById('type');
            const comment = document.getElementById('comment');
            const disabled = document.getElementById('disabled');
            const frmdisable = document.getElementById('frmdisable');

            openModalBtn.addEventListener('click', () => {
                editmac = false;
                macSaveFooterBtn.innerHTML = "Save";
                macModal.classList.remove('hidden');
                frmdisable.classList.add('hidden');
                mac.value = "";
                type.value = "blocked";
                comment.value = "";
                disabled.value = "no";
            });
            
            macCloseFooterBtn.addEventListener('click', () => {
                macModal.classList.add('hidden');
            });

            macSaveFooterBtn.addEventListener('click', () => {
                if (editmac == false) {
                    axios
                    .post(
                        "<?php echo env('APP_URL_AXIOS'); ?>/hotspot/mac/binding", {
                            'mac': mac.value,
                            'type' : type.value,
                            'comment' : comment.value,
                            'disabled' : disabled.velue
                        },{
                              headers: {
                                  'Content-Type': 'multipart/form-data'
                              }
                          }
                    )
                    .then((response) => {
                        const data = response.data;
                        if (data['error'] == false) {
                            macModal.classList.add('hidden');
                            location.reload();
                        } else {
                            swal({
                                title: 'Error Data',
                                text: data['msg'],
                                icon: 'error',
                                button: true
                            });
                        }
                    }
                    ).catch(err => {
                        console.log('Oh noooo!!');
                        console.log(err.response.data);
                    })
                } else {
                    axios
                    .patch(`<?php echo env('APP_URL_AXIOS'); ?>/hotspot/mac/binding/${idmac}`, {
                        'mac' : mac.value,
                        'type' : type.value,
                        'comment' : comment.value,
                        'disabled' : disabled.value
                    })
                    .then((response) => {
                        const data = response.data;
                        console.log(data);
                        if(data['error'] == false) {
                            macModal.classList.add('hidden');
                            location.reload();
                        } else {
                            swal({
                                title: 'Error Data',
                                text: data['msg'],
                                icon: 'error',
                                button: true
                            });
                        }
                    })
                }

            });

        </script>

    @endsection
    @section('mystyle')
        <style>
            .pagination {
            display: flex;
            justify-content: center;
            }
            .pagination button {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            cursor: pointer;
            }
            .pagination button.active {
            background-color: #007bff;
            color: #fff;
            }
            .pagination button:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
            }
            #searchBox {
            margin-bottom: 20px;
            width: 100%;
            padding: 8px;
            font-size: 16px;
            }
        </style>
    @endsection
    @section('addscript')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @endsection
    
