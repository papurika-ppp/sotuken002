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
                    {{ __('グループの追加') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("新しいグループを作成します。") }}
                </p>
                <div class="mt-4">
                    <x-input-label for="group_name" :value="__('グループ名')" />
                    <x-text-input id="group_name" class="group_name" type="text" name="group_name" :value="old('group_name')" />
                </div>
                
                <div class="flex items-center gap-4 mt-4">
                    <x-primary-button>
                        作成する
                    </x-primary-button>
                </div>
                
                @if (session('message'))
                    {{ session('message') }}
                @endif
                <br>
                <a href="/groups">グループ一覧へ</a>
            </div>
            </div>
            </div>
            
    </form>
</x-app-layout>

        