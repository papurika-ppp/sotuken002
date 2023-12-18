<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('グループ管理') }}
        </h2>
    </x-slot>
    @if (session('message'))
        {{ session('message') }}
    @endif
        <div>
            <p>グループ名:
                {{$teamInfo->group_name}}
            
            </p>
        </div>
        <div>
            <a href="/groups/manage/"></a>
        </div>
        <div>
            <a href="/groups/manage/leave?id=<?= $teamInfo->group_id ?>">退会</a>
        </div>
        <div>
            <a href="/groups/manage/delete?id=<?= $teamInfo->group_id ?>">削除</a>
        </div>
</x-default-layout>