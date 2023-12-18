<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('グループ管理') }}
        </h2>
    </x-slot>
    <p>グループ一覧</p>
    @foreach ($team_lists as $team_list)
                <a href="groups/manage?id=<?= $team_list->group_id ?>"><?= $team_list->group_name ?></a>
                <br>
    @endforeach

    @if (session('message'))
        {{ session('message') }}
    @endif
        
        <div class="c">           
        <a href="groups/create" class="btn_1">ああああ</a>           
    </div>
    <div class="c">
        <a href="groups/join" class="btn_1">参加</a>
    </div>
    <div class="c">           
        <a href="groups/create" class="btn_1">新規</a>           
    </div>
</x-default-layout>
