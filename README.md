<!-- HEADER -->
<h1 align="center">🚀 LKS Backend API</h1>
<p align="center">
  Backend API untuk LKS menggunakan <b>Laravel 11</b> + <b>Sanctum</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red">
  <img src="https://img.shields.io/badge/PHP-8.3-blue">
  <img src="https://img.shields.io/badge/API-REST-green">
</p>

<hr>

<h2>🛠️ Tech Stack</h2>
<ul>
  <li>Laravel 11</li>
  <li>PHP 8.3+</li>
  <li>MySQL</li>
  <li>Laravel Sanctum</li>
</ul>

<hr>

<h2>⚙️ Installation</h2>

<pre>
git clone https://github.com/username/lks-backend.git
cd lks-backend
composer install
cp .env.example .env
php artisan key:generate
</pre>

<h3>📌 Setup Database (.env)</h3>

<pre>
DB_DATABASE=lks_backend
DB_USERNAME=root
DB_PASSWORD=
</pre>

<h3>📌 Migration & Seeder</h3>

<pre>
php artisan migrate:fresh --seed
</pre>

<h3>📌 Run Server</h3>

<pre>
php artisan serve
</pre>

<hr>

<h2>🔐 A1 - Authentication</h2>

<h3>Login</h3>
<pre>
POST /api/v1/auth/login
</pre>

<b>Body:</b>
<pre>
{
  "id_card_number": "1234567890",
  "password": "password"
}
</pre>

<b>Response:</b>
<pre>
{
  "name": "Doni Rianto",
  "token": "1|xxxx",
  "regional": {
    "province": "DKI Jakarta"
  }
}
</pre>

<h3>Logout</h3>
<pre>
POST /api/v1/auth/logout
Authorization: Bearer TOKEN
</pre>

<hr>

<h2>🧾 A2 - Validation</h2>

<h3>Request Validation</h3>
<pre>
POST /api/v1/validation
</pre>

<pre>
{
  "job": "Programmer",
  "job_description": "Backend Developer",
  "income": 10000000,
  "reason_accepted": "Stable income"
}
</pre>

<h3>Get Validation</h3>
<pre>
GET /api/v1/validation
</pre>

<hr>

<h2>🚗 A3 - Instalment Cars</h2>

<h3>Get Cars</h3>
<pre>
GET /api/v1/instalment_cars
</pre>

<h3>Detail Car</h3>
<pre>
GET /api/v1/instalment_cars/{id}
</pre>

<hr>

<h2>📝 A4 - Applications</h2>

<h3>Apply</h3>
<pre>
POST /api/v1/applications
</pre>

<pre>
{
  "instalment_id": 1,
  "months": 12,
  "notes": "I want this car"
}
</pre>

<h3>Get Applications</h3>
<pre>
GET /api/v1/applications
</pre>

<hr>

<h2>🧪 Dummy Account</h2>

<pre>
ID Card Number : 1234567890
Password       : password
</pre>

<hr>

<h2>⚠️ Notes</h2>
<ul>
  <li>Gunakan <code>migrate:fresh --seed</code> untuk reset database</li>
  <li>Validation harus <b>accepted</b> sebelum apply instalment</li>
  <li>Apply hanya bisa <b>1 kali</b></li>
</ul>

<hr>

<h2>👨‍💻 Author</h2>
<p>Fikri Bahtiar</p>
