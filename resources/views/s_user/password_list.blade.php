<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
<table>
  <thead>
    <tr>
      <th colspan="6">管理パスワード一覧</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($password_lists as $password_list)
                <tr><td>{{ $password_list->site_name}}</td><td>{{ $password_list->url}}</td><td>{{ $password_list->comment}}</td><td>{{ $password_list->regist_date}}</td><td></td><td><a href="/passmana?id=<?= $password_list->management_number ?>" class="btn_1">詳細</a></td></tr>
               
    @endforeach
    @foreach ($g_password_lists as $g_password_list)
                <tr><td>{{ $g_password_list->site_name}}</td><td>{{ $g_password_list->url}}</td><td>{{ $g_password_list->comment}}</td><td>{{ $g_password_list->regist_date}}</td><td></td><td><a href="/passmana?id=<?= $password_list->management_number ?>" class="btn_1">詳細</a></td></tr>
               
    @endforeach
  </tbody>
</table>
   
    <a href="/pass_add" class="btn_1">追加</a>
    @if (session('message'))
       {{ session('message') }}
   @endif
    
</body>
</x-app-layout>