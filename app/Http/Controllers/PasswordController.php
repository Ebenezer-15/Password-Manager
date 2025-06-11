<?php

namespace App\Http\Controllers;

// use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use App\Services\WebScraperService;

class PasswordController extends Controller
{
    // Show all passwords for the logged-in user
    public function index()
    {
        // $users = User::where('id', Auth::id())->get();. this fetches all users, not just the logged-in user; a collection
        $users = Auth::user(); // this fetches the logged-in user as a single User object
        // Fetch all passwords for the logged-in user
        $passwords = Password::where('user_id', Auth::id())->get();
        return view('dashboard', compact('passwords', 'users'));
    }

    // Store a new password
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $scraper = new WebScraperService();
        $siteInfo = $scraper->scrapeWebsite($validated['link']);

        // If no title was provided, use the scraped title
        if (empty($validated['title']) && !empty($siteInfo['title'])) {
            $validated['title'] = $siteInfo['title'];
        }


        Password::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'link' => $request->link,
            'username' => $request->username,
            'favicon' => $siteInfo['favicon'],
            'password' => $request->password,
        ]);

        return redirect()->route('dashboard')->with('success', 'Password saved!');
    }

    // update an existing password
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $password = Password::findOrFail($id);
        $password->update($validated);

        return redirect()->route('dashboard')->with('success', 'Password updated!');
    }



    public function destroy($id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $password->delete();

        return redirect()->route('dashboard')->with('success', 'Password deleted successfully.');
    }


    public function create()
    {
        return view('password.create');
    }
}
