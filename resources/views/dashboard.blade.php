<x-app-layout>
    <!--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="{{asset('/assets/css/home.css')}}" rel="stylesheet">-->
    <title>パスマネ</title>

    <div class="flex items-center justify-center my-4">
        <div style="text-align: center">
            <x-primary-button>
                <a href="/passlis" class="btn_1">管理パスワード一覧</a>
            </x-primary-button>
       
        <div>
            <br>
            <x-primary-button>
                <a href="/profile" class="btn_1">アカウント管理</a>
            </x-primary-button>
        </div>
        <br>
        <div>
            <x-primary-button>
                <a href="/passlis" class="btn_1">グループ管理</a>
            </x-primary-button>
        </div>
        <br>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
            <x-primary-button>
                <a href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();"class="btn_1">
                
                        {{ __('Log Out') }}
                    </a>
            </x-primary-button>
            </form>
                    

                   
        </div>
    </div>
     <!--<form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>


   <div class="mt-4">
        x-primary-button
        <a href="/passlis" class="btn_1">管理パスワード一覧</a>
        <a href="" class="btn_1">アカウント管理</a>
        <a href="" class="btn_1">グループ管理</a>
        <a href="" class="btn_1 lowered">ログアウト</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>-->
</x-app-layout>
