@extends('amazeui.main')

@section('content_table')
    <article>
        <h1>HTTP Routing</h1>
        <ul>
            <li><a href="#basic-routing">Basic Routing</a></li>
            <li><a href="#route-parameters">Route Parameters</a>
                <ul>
                    <li><a href="#required-parameters">Required Parameters</a></li>
                    <li><a href="#parameters-optional-parameters">Optional Parameters</a></li>
                    <li><a href="#parameters-regular-expression-constraints">Regular Expression Constraints</a></li>
                </ul></li>
            <li><a href="#named-routes">Named Routes</a></li>
            <li><a href="#route-groups">Route Groups</a>
                <ul>
                    <li><a href="#route-group-middleware">Middleware</a></li>
                    <li><a href="#route-group-namespaces">Namespaces</a></li>
                    <li><a href="#route-group-sub-domain-routing">Sub-Domain Routing</a></li>
                    <li><a href="#route-group-prefixes">Route Prefixes</a></li>
                </ul></li>
            <li><a href="#csrf-protection">CSRF Protection</a>
                <ul>
                    <li><a href="#csrf-introduction">Introduction</a></li>
                    <li><a href="#csrf-excluding-uris">Excluding URIs</a></li>
                    <li><a href="#csrf-x-csrf-token">X-CSRF-Token</a></li>
                    <li><a href="#csrf-x-xsrf-token">X-XSRF-Token</a></li>
                </ul></li>
            <li><a href="#route-model-binding">Route Model Binding</a></li>
            <li><a href="#form-method-spoofing">Form Method Spoofing</a></li>
            <li><a href="#throwing-404-errors">Throwing 404 Errors</a></li>
        </ul>
        <p><a name="basic-routing"></a></p>
        <h2>Basic Routing</h2>
        <p>You will define most of the routes for your application in the <code>app/Http/routes.php</code> file, which is loaded by the <code>App\Providers\RouteServiceProvider</code> class. The most basic Laravel routes simply accept a URI and a <code>Closure</code>:</p>
<pre><code>Route::get('/', function () {
        return 'Hello World';
        });

        Route::post('foo/bar', function () {
        return 'Hello World';
        });

        Route::put('foo/bar', function () {
        //
        });

        Route::delete('foo/bar', function () {
        //
        });</code></pre>
        <h4>Registering A Route For Multiple Verbs</h4>
        <p>Sometimes you may need to register a route that responds to multiple HTTP verbs. You may do so using the <code>match</code> method on the <code>Route</code> <a href="/docs/5.1/facades">facade</a>:</p>
<pre><code>Route::match(['get', 'post'], '/', function () {
        return 'Hello World';
        });</code></pre>
        <p>Or, you may even register a route that responds to all HTTP verbs using the <code>any</code> method:</p>
<pre><code>Route::any('foo', function () {
        return 'Hello World';
        });</code></pre>
        <h4>Generating URLs To Routes</h4>
        <p>You may generate URLs to your application's routes using the <code>url</code> helper:</p>
        <pre><code>$url = url('foo');</code></pre>
        <p><a name="route-parameters"></a></p>
        <h2>Route Parameters</h2>
        <p><a name="required-parameters"></a></p>
        <h3>Required Parameters</h3>
        <p>Of course, sometimes you will need to capture segments of the URI within your route. For example, you may need to capture a user's ID from the URL. You may do so by defining route parameters:</p>
<pre><code>Route::get('user/{id}', function ($id) {
        return 'User '.$id;
        });</code></pre>
        <p>You may define as many route parameters as required by your route:</p>
<pre><code>Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
        //
        });</code></pre>
        <p>Route parameters are always encased within &quot;curly&quot; braces. The parameters will be passed into your route's <code>Closure</code> when the route is executed.</p>
        <blockquote>
            <p><strong>Note:</strong> Route parameters cannot contain the <code>-</code> character. Use an underscore (<code>_</code>) instead.</p>
        </blockquote>
        <p><a name="parameters-optional-parameters"></a></p>
        <h3>Optional Parameters</h3>
        <p>Occasionally you may need to specify a route parameter, but make the presence of that route parameter optional. You may do so by placing a <code>?</code> mark after the parameter name:</p>
<pre><code>Route::get('user/{name?}', function ($name = null) {
        return $name;
        });

        Route::get('user/{name?}', function ($name = 'John') {
        return $name;
        });</code></pre>
        <p><a name="parameters-regular-expression-constraints"></a></p>
        <h3>Regular Expression Constraints</h3>
        <p>You may constrain the format of your route parameters using the <code>where</code> method on a route instance. The <code>where</code> method accepts the name of the parameter and a regular expression defining how the parameter should be constrained:</p>
<pre><code>Route::get('user/{name}', function ($name) {
        //
        })
        -&gt;where('name', '[A-Za-z]+');

        Route::get('user/{id}', function ($id) {
        //
        })
        -&gt;where('id', '[0-9]+');

        Route::get('user/{id}/{name}', function ($id, $name) {
        //
        })
        -&gt;where(['id' =&gt; '[0-9]+', 'name' =&gt; '[a-z]+']);</code></pre>
        <p><a name="parameters-global-constraints"></a></p>
        <h4>Global Constraints</h4>
        <p>If you would like a route parameter to always be constrained by a given regular expression, you may use the <code>pattern</code> method. You should define these patterns in the <code>boot</code> method of your <code>RouteServiceProvider</code>:</p>
<pre><code>/**
        * Define your route model bindings, pattern filters, etc.
        *
        * @param  \Illuminate\Routing\Router  $router
        * @return void
        */
        public function boot(Router $router)
        {
        $router-&gt;pattern('id', '[0-9]+');

        parent::boot($router);
        }</code></pre>
        <p>Once the pattern has been defined, it is automatically applied to all routes using that parameter name:</p>
<pre><code>Route::get('user/{id}', function ($id) {
        // Only called if {id} is numeric.
        });</code></pre>
        <p><a name="named-routes"></a></p>
        <h2>Named Routes</h2>
        <p>Named routes allow you to conveniently generate URLs or redirects for a specific route. You may specify a name for a route using the <code>as</code> array key when defining the route:</p>
<pre><code>Route::get('user/profile', ['as' =&gt; 'profile', function () {
        //
        }]);</code></pre>
        <p>You may also specify route names for controller actions:</p>
<pre><code>Route::get('user/profile', [
        'as' =&gt; 'profile', 'uses' =&gt; 'UserController@showProfile'
        ]);</code></pre>
        <p>Instead of specifying the route name in the route array definition, you may chain the <code>name</code> method onto the end of the route definition:</p>
        <pre><code>Route::get('user/profile', 'UserController@showProfile')-&gt;name('profile');</code></pre>
        <h4>Route Groups &amp; Named Routes</h4>
        <p>If you are using <a href="#route-groups">route groups</a>, you may specify an <code>as</code> keyword in the route group attribute array, allowing you to set a common route name prefix for all routes within the group:</p>
<pre><code>Route::group(['as' =&gt; 'admin::'], function () {
        Route::get('dashboard', ['as' =&gt; 'dashboard', function () {
        // Route named "admin::dashboard"
        }]);
        });</code></pre>
        <h4>Generating URLs To Named Routes</h4>
        <p>Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via the <code>route</code> function:</p>
<pre><code>$url = route('profile');

        $redirect = redirect()-&gt;route('profile');</code></pre>
        <p>If the route defines parameters, you may pass the parameters as the second argument to the <code>route</code> method. The given parameters will automatically be inserted into the URL:</p>
<pre><code>Route::get('user/{id}/profile', ['as' =&gt; 'profile', function ($id) {
        //
        }]);

        $url = route('profile', ['id' =&gt; 1]);</code></pre>
        <p><a name="route-groups"></a></p>
        <h2>Route Groups</h2>
        <p>Route groups allow you to share route attributes, such as middleware or namespaces, across a large number of routes without needing to define those attributes on each individual route. Shared attributes are specified in an array format as the first parameter to the <code>Route::group</code> method.</p>
        <p>To learn more about route groups, we'll walk through several common use-cases for the feature.</p>
        <p><a name="route-group-middleware"></a></p>
        <h3>Middleware</h3>
        <p>To assign middleware to all routes within a group, you may use the <code>middleware</code> key in the group attribute array. Middleware will be executed in the order you define this array:</p>
<pre><code>Route::group(['middleware' =&gt; 'auth'], function () {
        Route::get('/', function ()    {
        // Uses Auth Middleware
        });

        Route::get('user/profile', function () {
        // Uses Auth Middleware
        });
        });</code></pre>
        <p><a name="route-group-namespaces"></a></p>
        <h3>Namespaces</h3>
        <p>Another common use-case for route groups is assigning the same PHP namespace to a group of controllers. You may use the <code>namespace</code> parameter in your group attribute array to specify the namespace for all controllers within the group:</p>
<pre><code>Route::group(['namespace' =&gt; 'Admin'], function()
        {
        // Controllers Within The "App\Http\Controllers\Admin" Namespace

        Route::group(['namespace' =&gt; 'User'], function()
        {
        // Controllers Within The "App\Http\Controllers\Admin\User" Namespace
        });
        });</code></pre>
        <p>Remember, by default, the <code>RouteServiceProvider</code> includes your <code>routes.php</code> file within a namespace group, allowing you to register controller routes without specifying the full <code>App\Http\Controllers</code> namespace prefix. So, we only need to specify the portion of the namespace that comes after the base <code>App\Http\Controllers</code> namespace root.</p>
        <p><a name="route-group-sub-domain-routing"></a></p>
        <h3>Sub-Domain Routing</h3>
        <p>Route groups may also be used to route wildcard sub-domains. Sub-domains may be assigned route parameters just like route URIs, allowing you to capture a portion of the sub-domain for usage in your route or controller. The sub-domain may be specified using the <code>domain</code> key on the group attribute array:</p>
<pre><code>Route::group(['domain' =&gt; '{account}.myapp.com'], function () {
        Route::get('user/{id}', function ($account, $id) {
        //
        });
        });</code></pre>
        <p><a name="route-group-prefixes"></a></p>
        <h3>Route Prefixes</h3>
        <p>The <code>prefix</code> group array attribute may be used to prefix each route in the group with a given URI. For example, you may want to prefix all route URIs within the group with <code>admin</code>:</p>
<pre><code>Route::group(['prefix' =&gt; 'admin'], function () {
        Route::get('users', function ()    {
        // Matches The "/admin/users" URL
        });
        });</code></pre>
        <p>You may also use the <code>prefix</code> parameter to specify common parameters for your grouped routes:</p>
<pre><code>Route::group(['prefix' =&gt; 'accounts/{account_id}'], function () {
        Route::get('detail', function ($account_id)    {
        // Matches The accounts/{account_id}/detail URL
        });
        });</code></pre>
        <p><a name="csrf-protection"></a></p>
        <h2>CSRF Protection</h2>
        <p><a name="csrf-introduction"></a></p>
        <h3>Introduction</h3>
        <p>Laravel makes it easy to protect your application from <a href="http://en.wikipedia.org/wiki/Cross-site_request_forgery">cross-site request forgeries</a>. Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of the authenticated user.</p>
        <p>Laravel automatically generates a CSRF &quot;token&quot; for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application. To generate a hidden input field <code>_token</code> containing the CSRF token, you may use the <code>csrf_field</code> helper function:</p>
        <pre><code>&lt;?php echo csrf_field(); ?&gt;</code></pre>
        <p>The <code>csrf_field</code> helper function generates the following HTML:</p>
        <pre><code>&lt;input type="hidden" name="_token" value="&lt;?php echo csrf_token(); ?&gt;"&gt;</code></pre>
        <p>Of course, using the Blade <a href="/docs/5.1/blade">templating engine</a>:</p>
        <pre><code>{{ csrf_field() }}</code></pre>
        <p>You do not need to manually verify the CSRF token on POST, PUT, or DELETE requests. The <code>VerifyCsrfToken</code> <a href="/docs/5.1/middleware">HTTP middleware</a> will verify that the token in the request input matches the token stored in the session.</p>
        <p><a name="csrf-excluding-uris"></a></p>
        <h3>Excluding URIs From CSRF Protection</h3>
        <p>Sometimes you may wish to exclude a set of URIs from CSRF protection. For example, if you are using <a href="https://stripe.com">Stripe</a> to process payments and are utilizing their webhook system, you will need to exclude your webhook handler route from Laravel's CSRF protection.</p>
        <p>You may exclude URIs by adding them to the <code>$except</code> property of the <code>VerifyCsrfToken</code> middleware:</p>
<pre><code>&lt;?php

        namespace App\Http\Middleware;

        use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

        class VerifyCsrfToken extends BaseVerifier
        {
        /**
        * The URIs that should be excluded from CSRF verification.
        *
        * @var array
        */
        protected $except = [
        'stripe/*',
        ];
        }</code></pre>
        <p><a name="csrf-x-csrf-token"></a></p>
        <h3>X-CSRF-TOKEN</h3>
        <p>In addition to checking for the CSRF token as a POST parameter, the Laravel <code>VerifyCsrfToken</code> middleware will also check for the <code>X-CSRF-TOKEN</code> request header. You could, for example, store the token in a &quot;meta&quot; tag:</p>
        <pre><code>&lt;meta name="csrf-token" content="{{ csrf_token() }}"&gt;</code></pre>
        <p>Once you have created the <code>meta</code> tag, you can instruct a library like jQuery to add the token to all request headers. This provides simple, convenient CSRF protection for your AJAX based applications:</p>
<pre><code>$.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });</code></pre>
        <p><a name="csrf-x-xsrf-token"></a></p>
        <h3>X-XSRF-TOKEN</h3>
        <p>Laravel also stores the CSRF token in a <code>XSRF-TOKEN</code> cookie. You can use the cookie value to set the <code>X-XSRF-TOKEN</code> request header. Some JavaScript frameworks, like Angular, do this automatically for you. It is unlikely that you will need to use this value manually.</p>
        <p><a name="route-model-binding"></a></p>
        <h2>Route Model Binding</h2>
        <p>Laravel route model binding provides a convenient way to inject class instances into your routes. For example, instead of injecting a user's ID, you can inject the entire <code>User</code> class instance that matches the given ID.</p>
        <p>First, use the router's <code>model</code> method to specify the class for a given parameter. You should define your model bindings in the <code>RouteServiceProvider::boot</code> method:</p>
        <h4>Binding A Parameter To A Model</h4>
<pre><code>public function boot(Router $router)
        {
        parent::boot($router);

        $router-&gt;model('user', 'App\User');
        }</code></pre>
        <p>Next, define a route that contains a <code>{user}</code> parameter:</p>
<pre><code>$router-&gt;get('profile/{user}', function(App\User $user) {
        //
        });</code></pre>
        <p>Since we have bound the <code>{user}</code> parameter to the <code>App\User</code> model, a <code>User</code> instance will be injected into the route. So, for example, a request to <code>profile/1</code> will inject the <code>User</code> instance which has an ID of 1.</p>
        <blockquote>
            <p><strong>Note:</strong> If a matching model instance is not found in the database, a 404 exception will be thrown automatically.</p>
        </blockquote>
        <p>If you wish to specify your own &quot;not found&quot; behavior, pass a Closure as the third argument to the <code>model</code> method:</p>
<pre><code>$router-&gt;model('user', 'App\User', function() {
        throw new NotFoundHttpException;
        });</code></pre>
        <p>If you wish to use your own resolution logic, you should use the <code>Route::bind</code> method. The Closure you pass to the <code>bind</code> method will receive the value of the URI segment, and should return an instance of the class you want to be injected into the route:</p>
<pre><code>$router-&gt;bind('user', function($value) {
        return App\User::where('name', $value)-&gt;first();
        });</code></pre>
        <p><a name="form-method-spoofing"></a></p>
        <h2>Form Method Spoofing</h2>
        <p>HTML forms do not support <code>PUT</code>, <code>PATCH</code> or <code>DELETE</code> actions. So, when defining <code>PUT</code>, <code>PATCH</code> or <code>DELETE</code> routes that are called from an HTML form, you will need to add a hidden <code>_method</code> field to the form. The value sent with the <code>_method</code> field will be used as the HTTP request method:</p>
<pre><code>&lt;form action="/foo/bar" method="POST"&gt;
        &lt;input type="hidden" name="_method" value="PUT"&gt;
        &lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;
        &lt;/form&gt;</code></pre>
        <p>To generate the hidden input field <code>_method</code>, you may also use the <code>method_field</code> helper function:</p>
        <pre><code>&lt;?php echo method_field('PUT'); ?&gt;</code></pre>
        <p>Of course, using the Blade <a href="/docs/5.1/blade">templating engine</a>:</p>
        <pre><code>{{ method_field('PUT') }}</code></pre>
        <p><a name="throwing-404-errors"></a></p>
        <h2>Throwing 404 Errors</h2>
        <p>There are two ways to manually trigger a 404 error from a route. First, you may use the <code>abort</code> helper. The <code>abort</code> helper simply throws a <code>Symfony\Component\HttpFoundation\Exception\HttpException</code> with the specified status code:</p>
        <pre><code>abort(404);</code></pre>
        <p>Secondly, you may manually throw an instance of <code>Symfony\Component\HttpKernel\Exception\NotFoundHttpException</code>.</p>
        <p>More information on handling 404 exceptions and using custom responses for these errors may be found in the <a href="/docs/5.1/errors#http-exceptions">errors</a> section of the documentation.</p>
    </article>
@endsection