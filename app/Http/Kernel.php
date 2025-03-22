protected $routeMiddleware = [
    // Laravel default middleware
    'auth' => \App\Http\Middleware\Authenticate::class,
    
    // Custom middleware
    'auth.profile' => \App\Http\Middleware\EnsureProfileIsEditable::class,
    'auth.redirect' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];
