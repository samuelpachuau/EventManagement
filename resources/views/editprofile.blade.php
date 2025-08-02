<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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

        .container {
            background: white;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #5c2d91;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #5c2d91;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #472379;
        }

        hr {
            margin: 40px 0;
            border: none;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit Profile</h1>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">

            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">

            <button type="submit">Update Profile</button>
        </form>

        <hr>

        <h2>Change Password</h2>
        <form method="POST" action="{{ route('profile.password') }}">
            @csrf
            <label>New Password:</label>
            <input type="password" name="password">

            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation">

            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
