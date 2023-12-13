<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスマネ</title>
</head>
<body>
    <main>
        <h1>テスト</h1>
        <form action="/s_users" method="POST">
            @csrf
            <input type="text" name="user_name">
            <input type="submit" value="登録">
        </form>
        <ul>
            @foreach ($s_users as $s_user)
                <li>{{ $s_user->user_id}}</li>
                <li>{{ $s_user->user_name}}</li>
            @endforeach
        </ul>
    </main>
    
</body>
</html>