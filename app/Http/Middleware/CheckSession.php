<?php

// app/Http/Middleware/CheckSession.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }

        $lastActivity = session('last_activity', time());
        if ((time() - $lastActivity) > 900) { // per detik
            session()->flush();
            return redirect('/login')->withErrors(['msg' => 'Silahkan Login kembali']);
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}

