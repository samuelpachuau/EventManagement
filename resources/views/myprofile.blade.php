<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f9;
        }

        .header {
            background-color: #5c2d91;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .tabs {
            display: flex;
            justify-content: center;
            background: #eee;
            padding: 10px 0;
        }

.tab {
    text-decoration: none;
    color: #333;
    margin: 0 15px;
    padding: 10px 20px;
    background: white;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
}
.tab.active {
    background-color: #5c2d91;
    color: white;
}


        .container {
            background: white;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome, {{ $user->name }}</h1>
    </div>

 <div class="tabs">
    <a href="{{ route('myprofile') }}" class="tab {{ request()->routeIs('myprofile') ? 'active' : '' }}">Profile</a>
    <a href="{{ route('profile.edit') }}" class="tab {{ request()->routeIs('profile.edit') ? 'active' : '' }}">Edit Profile</a>
    
</div>

    <div class="container">
        <div class="info-row">
            <div class="label">Name:</div>
            <div class="value">{{ $user->name }}</div>
        </div>
        <div class="info-row">
            <div class="label">Email:</div>
            <div class="value">{{ $user->email }}</div>
        </div>
        <div class="info-row">
            <div class="label">Member Since:</div>
            <div class="value">{{ $user->created_at->format('d M Y') }}</div>
        </div>
    </div>
</body>
</html>
