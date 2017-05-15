<h1>Stanga words translation API</h1>
<h2> To install </h2>
<ul>
<li>php composer.phar install</li>

<li>create .env file</li>
<li>php artisan key:generate;</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>

</ul>

<h2> Use</h2>

<p>/public/admin  - Administration Panel  - use admin@gmail.com pass:stanga</p>
<p>/public/api/translate/single/{word} - GET single word from db; json response</p>
<p>/public/api/translate/all/{limit}/{order} - GET all words from db; limit and order are optional</p>