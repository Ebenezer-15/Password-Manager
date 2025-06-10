 <h1>🔐 Password Vault</h1>

  <p>
    A lightweight and secure password manager built with <strong>Laravel</strong>, featuring auto-website scraping, password generation, and a clean UI.
    Store and manage your credentials with ease — all encrypted and tied to your user account.
  </p>

  <h2>✨ Features</h2>
  <ul>
    <li>🔑 <strong>Save and manage passwords</strong></li>
    <li>🌐 <strong>Auto-fetch website metadata</strong> (title and favicon)</li>
    <li>🔒 <strong>Generate strong random passwords</strong></li>
    <li>👤 <strong>User-specific password storage</strong></li>
    <li>📱 <strong>Responsive UI</strong> with Tailwind CSS</li>
    <li>⚙️ <strong>Built using Laravel & Blade</strong></li>
  </ul>

  <h2>🖼️ Screenshots</h2>
  <p><em>(Include screenshots or gifs of the UI here — dashboard, create form, etc.)</em></p>

  <h2>🚀 Getting Started</h2>

  <h3>Prerequisites</h3>
  <ul>
    <li>PHP &gt;= 8.1</li>
    <li>Composer</li>
    <li>Laravel 10+</li>
    <li>Node.js & NPM</li>
    <li>MySQL or SQLite</li>
  </ul>

  <h3>Installation</h3>
  <pre><code>git clone https://github.com/Ebenezer-15/password-vault.git
cd password-vault
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install &amp;&amp; npm run dev
php artisan serve</code></pre>

  <blockquote>
    Visit <code>http://127.0.0.1:8000</code> to start using the app.
  </blockquote>

  <h3>Seed Demo User (Optional)</h3>
  <pre><code>php artisan tinker
&gt;&gt;&gt; \App\Models\User::factory()-&gt;create(['email' =&gt; 'test@example.com', 'password' =&gt; bcrypt('password')])</code></pre>

  <h2>🛠️ Tech Stack</h2>
  <ul>
    <li><strong>Backend:</strong> Laravel</li>
    <li><strong>Frontend:</strong> Blade + Tailwind CSS</li>
    <li><strong>Scraping:</strong> Custom WebScraperService</li>
    <li><strong>Authentication:</strong> Laravel Breeze / Sanctum (depending on setup)</li>
  </ul>

  <h2>🔐 Security</h2>
  <ul>
    <li>Passwords are encrypted before storage</li>
    <li>Routes are protected by authentication middleware</li>
    <li>Only the logged-in user can access their credentials</li>
  </ul>

  <h2>📁 Folder Structure Highlights</h2>
  <pre><code>app/
├── Http/Controllers/PasswordController.php
├── Models/Password.php
├── Services/WebScraperService.php
resources/views/
└── password/create.blade.php
routes/web.php</code></pre>

  <h2>💡 Future Improvements</h2>
  <ul>
    <li>🔐 Two-Factor Authentication (2FA)</li>
    <li>🧾 Export/Import functionality</li>
    <li>📱 Progressive Web App support</li>
    <li>🧠 AI-generated password suggestions</li>
  </ul>

  <h2>🤝 Contributing</h2>
  <p>Feel free to fork and improve the app. Pull Requests are welcome!</p>

  <h2>📄 License</h2>
  <p>MIT License — <a href="https://github.com/your-username" target="_blank">your-name</a></p>
