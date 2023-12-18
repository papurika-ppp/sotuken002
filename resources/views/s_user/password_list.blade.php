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
            {{ __('管理パスワード一覧') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("管理するパスワードの一覧を表示しています。") }}
        </p>
    <table>
  
  <tbody>
    <tr><th>サイト名</th><th>URL</th><th>備考</th><th>グループ名</th></tr>
    @foreach ($password_lists as $password_list)
                <tr data-href="/passmana?id=<?= $password_list->management_number ?>" class="trr"><td>{{ $password_list->site_name}}</td><td>{{ $password_list->url}}</td><td>{{ $password_list->comment}}</td><td>{{ $password_list->regist_date}}</td><td></td></tr>
               
    @endforeach
    @foreach ($g_password_lists as $g_password_list)
                <tr><td>{{ $g_password_list->site_name}}</td><td>{{ $g_password_list->url}}</td><td>{{ $g_password_list->comment}}</td><td>{{ $g_password_list->regist_date}}</td><td></td><td><a href="/passmana?id=<?= $password_list->management_number ?>" class="btn_1">詳細</a></td></tr>
               
    @endforeach
  </tbody>
</table>
<div class="flex items-center gap-4 mt-4">
                    <x-primary-button>
                    <a href="/pass_add" class="btn_1">追加</a>
                    </x-primary-button>
                </div>
   
    
    @if (session('message'))
       {{ session('message') }}
   @endif
    </div>
    </div>
    </div>
    <div class="flex items-center justify-center my-4">
<x-primary-button>
                <a href="/dashboard" >管理画面へ</a>
            </x-primary-button>
        </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<script>
      <!--trのhrefでリンク先に飛ぶコード-->
      jQuery(function ($) {
        $("tbody tr[data-href]")
          .addClass("clickable")
          .click(function () {
            window.location = $(this).attr("data-href");
          })
          .find("a")
          .hover(
            function () {
              $(this).parents("tr").unbind("click");
            },
            function () {
              $(this)
                .parents("tr")
                .click(function () {
                  window.location = $(this).attr("data-href");
                });
            }
          );
      });
</script>

</x-app-layout>