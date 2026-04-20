@extends('layout.app')
    @section('content')
        <div class="max-w-sm mx-auto grid gap-6 lg:grid-cols-3 items-start lg:max-w-none mt-20">
            <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
                    <div class="font-bold text-center text-blue-600">
                        <h1>HOTSPOT USER LIST</h1>
                    </div>
                    <div class="text-gray-600">
                        <div class="text-gray-900 font-medium mb-3">Description:</div>
                        <ul class="list-outside list-disc ml-6">
                            <li>Display hotspot user list</li>
                            <li>Add new user</li>
                            <li>Edit user and change password</li>
                            <li>Update user profile</li>
                        </ul>
                    </div>
                    <footer>
                        <a href="/hotspot/users" class="flex-1 rounded-full border-2 bg-blue-600 border-gray-400 dark:border-blue-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-blue-800 text-center">Open</a>
                    </footer>
            </div>
            <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
                    <div class="font-bold text-center text-blue-600">
                        <h1>HOTSPO USER PROFILE</h1>
                    </div>
                    <div class="text-gray-600">
                        <div class="text-gray-900 font-medium mb-3">Description:</div>
                        <ul class="list-outside list-disc ml-6">
                            <li>Display hotspot user profile</li>
                            <li>Add new user profile</li>
                            <li>Update user profile</li>
                        </ul>
                    </div>
                    <footer>
                        <a href="http://localhost:3000/loketv1"  class="flex-1 rounded-full border-2 bg-blue-600 border-gray-400 dark:border-blue-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-blue-800 text-center">Open</a>
                    </footer>
            </div>
            <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
                    <div class="font-bold text-center text-blue-600">
                        <h1>DAFTAR MEMBER</h1>
                    </div>
                    <div class="text-gray-600">
                        <div class="text-gray-900 font-medium mb-3">Keterangan:</div>
                        <ul class="list-outside list-disc ml-6">
                            <li>Menampilkan daftar user hotspot</li>
                            <li>Menambah user baru</li>
                            <li>Mengedit user dan password</li>
                            <li>Merubah profile user</li>
                        </ul>
                    </div>
                    <footer>
                        <a href="http://localhost:3000/loketv1" target="_blank" class="flex-1 rounded-full border-2 bg-blue-600 border-gray-400 dark:border-blue-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-blue-800 text-center">Buka</a>
                    </footer>
            </div>
        </div>
    @endsection
