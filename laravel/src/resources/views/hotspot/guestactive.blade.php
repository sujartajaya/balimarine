@extends('layout.app')
    @section('content')
    <div class="max-w w-full">
            <div class="flex flex-col items-center justify-center px-3 py-8 mx-auto lg:py-0 mt-1">
                <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">User Active</h2>
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
                    </div>
                    <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200" id="data-table">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">User</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Address</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Mac Address</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Uptime</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Session Time Left</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Bytes In</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Bytes Out</th>
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
    <script>
            let data = [];
            <?php if ($data['error'] == false) { ?>
            data = <?php echo json_encode($data['active_user']); ?>;    
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
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['user']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['address']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['mac-address']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['uptime']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['session-time-left']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['bytes-in']}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${item['bytes-out']}</td>
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
                item['user'].toLowerCase().includes(searchQuery) || 
                item['address'].toString().includes(searchQuery) ||
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
    @endsection
