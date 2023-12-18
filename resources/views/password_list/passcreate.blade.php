<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('管理パスワード') }}
        </h2>
    </x-slot>
    
<form method="POST" action="store">
            @csrf
            
            <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
               
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('管理パスワード追加') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("管理するパスワードの追加が出来ます。") }}
        </p>
                <div class="mt-4">
                    <x-input-label for="site_name" :value="__('サイト名')" />
                    <x-text-input id="site_name" class="site_name" type="text" name="site_name" :value="old('site_name')" />
                    
                </div>
                <div class="mt-4">
                    <x-input-label for="url" :value="__('url')" />
                    <x-text-input id="url" type="url" name="url" :value="old('url')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="management_account" :value="__('アカウント名')" />
                    <x-text-input id="management_account" type="text" name="management_account" :value="old('management_account')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="management_account_password" :value="__('パスワード')" />
                    <x-text-input id="management_account_password" type="password" name="management_account_password" :value="old('management_account_password')" />
                </div>

                <div class="mt-4">
                    <x-input-label for="comment" :value="__('備考')" />
                    <x-text-input id="comment" type="text" name="comment" :value="old('comment')" />
                </div>
                
                <div class="flex items-center gap-4 mt-4">
                    <x-primary-button>
                        編集を完了する
                    </x-primary-button>
                </div>
                
                @if (session('message'))
       {{ session('message') }}
   @endif
            </div>
            </div>
            </div>
</form>
<div class="flex items-center justify-center my-4">
<x-primary-button>
                <a href="/passlis" >管理パスワード一覧</a>
            </x-primary-button>
        </div>

</x-app-layout>


        