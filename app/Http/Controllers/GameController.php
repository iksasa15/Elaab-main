<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories for the filter
        $categories = Category::all();

        // Start with a base query
        $gamesQuery = Game::query()->with('category');

        // Apply category filter if requested
        if ($request->has('category') && $request->category != 'all') {
            $gamesQuery->where('category_id', $request->category);
        }

        // Apply sorting based on request
        $sortBy = $request->input('sort', 'default');

        switch ($sortBy) {
            case 'a-z':
                $gamesQuery->orderBy('name', 'asc');
                break;
            case 'z-a':
                $gamesQuery->orderBy('name', 'desc');
                break;
            case 'newest':
                $gamesQuery->orderBy('created_at', 'desc');
                break;
            case 'popular':
                // For demo purposes - in a real app this would be based on rental counts
                $gamesQuery->inRandomOrder(); // Just for demonstration
                break;
            default:
                $gamesQuery->orderBy('id', 'desc'); // Default sorting
        }

        // Get paginated results
        $games = $gamesQuery->paginate(12);

        return view('games.index', compact('games', 'categories', 'sortBy'));
    }
}