<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Cairo', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

.container {
    width: 90%;
    margin: auto;
    max-width: 1200px;
}

/* Header */
.header {
    background-color: #d32f2f;
    padding: 20px 0;
    color: #fff;
    text-align: center;
}

.navbar {
    margin-top: 10px;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
}

.navbar a:hover {
    text-decoration: underline;
}

/* Hero Section */
.hero {
    background-image:"../../../public/images/blood-donation.jpeg";
    background-size: cover;
    background-position: center;
    color: #d32f2f;
    padding: 100px 0;
    text-align: center;
}

.hero h2 {
    font-size: 3em;
    margin-bottom: 10px;
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #d32f2f;
    color: #fff;
    padding: 10px 30px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2em;
}

.btn-primary:hover {
    background-color: #b71c1c;
}

/* Features Section */
.features {
    padding: 50px 0;
    background-color: #fff;
    text-align: center;
}

.features h3 {
    font-size: 2.5em;
    margin-bottom: 40px;
}

.feature-list {
    display: flex;
    justify-content: space-between;
}

.feature {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    width: 30%;
}

.feature h4 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.feature p {
    font-size: 1em;
    color: #777;
}

/* Footer */
.footer {
    background-color: #d32f2f;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    margin-top: 20px;
}

.footer p {
    margin: 0;
}
.login-section {
    padding: 50px 0;
    text-align: center;
}

.login-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    margin: auto;
}

.login-form h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

.form-group label {
    display: block;
    font-size: 1em;
    margin-bottom: 5px;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn-primary {
    background-color: #d32f2f;
    color: #fff;
    padding: 10px 30px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
    display: block;
    width: 100%;
    text-align: center;
}

.btn-primary:hover {
    background-color: #b71c1c;
}
.role-selection {
    padding: 50px 0;
    text-align: center;
}

.role-selection h2 {
    margin-bottom: 30px;
    font-size: 2.5em;
}

.role-options {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.role-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 300px;
    margin: 10px;
    text-decoration: none;
    color: #333;
    transition: transform 0.3s;
}

.role-card h3 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

.role-card p {
    font-size: 1em;
    color: #777;
}

.role-card:hover {
    transform: scale(1.05);
}

.role-card:hover h3 {
    color: #d32f2f;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.register-section {
    padding: 50px 0;
    text-align: center;
}

.register-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    margin: auto;
}

.register-form h2 {
    margin-bottom: 20px;
}

/* القسم الخاص بصفحة حولنا */
.about-section {
    padding: 50px 0;
    background-color: #f9f9f9;
    direction: rtl; /* دعم اتجاه النص من اليمين إلى اليسار */
    text-align: right; /* محاذاة النص إلى اليمين */
}

.container {
    width: 85%;
    margin: 0 auto;
}

h1, h2, h3 {
    color: #ff3b3f; /* اللون الأحمر الدموي */
}

p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

.statistics {
    display: flex;
    justify-content: space-between;
    margin: 30px 0;
    flex-wrap: wrap;
}

.stat-item {
    flex: 1;
    min-width: 150px;
    margin: 10px;
    text-align: center;
}

.stat-item h3 {
    font-size: 36px;
    color: #ff3b3f;
}

.stat-item p {
    font-size: 18px;
    color: #333;
}

.headertitle{
        color: #fff; /* اللون الأحمر الدموي */

}

.team-members {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
    flex-wrap: wrap;
}

.team-member {
    flex: 1;
    min-width: 150px;
    margin: 10px;
    text-align: center;
}

.team-member h3 {
    font-size: 22px;
    color: #333;
}

.contact a {
    color: #ff3b3f;
    text-decoration: none;
}

@media (max-width: 768px) {
    .statistics, .team-members {
        flex-direction: column;
        align-items: center;
    }

    .stat-item, .team-member {
        min-width: 100%;
    }
}


    </style>
</head>
<body>
    @include('layouts.header')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>
</html>
