<x-app-layout>
<link href="{{asset('/assets/css/password_list.css')}}" rel="stylesheet">

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('管理パスワード') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('管理パスワード詳細') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("管理するパスワードの詳細を表示しています。") }}
        </p>
        <table>
  
  <tbody>
    <tr><th>サイト名</th><th>URL</th><th>備考</th><th>作成日</th><th>管理パスワード</th></tr>
    @foreach ($password as $pass)
    <tr><td>{{ $pass->site_name}}</td><td>{{ $pass->url}}</td><td>{{ $pass->comment}}</td><td>{{ $pass->created_at}}</td><td>{{ $depassword}}</td></tr>
    @endforeach
  </tbody>
</table>

<h1 type="password">{{ $depassword}}</h1>





        
    </div>
    </div>
    </div>
        
    
    




</x-app-layout>