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
        
        <ul>
            @foreach ($password as $pass)
                <li>{{ $pass->site_name}}・{{ $pass->url}}・{{ $pass->comment}}・{{ $pass->created_at}}・{{ $pass->management_account_password}}</li>
               
            @endforeach
        </ul>
        
        
    </main>
    
</body>
</html>