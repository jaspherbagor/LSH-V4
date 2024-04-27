<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Post; // Importing the Post model
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling blog-related requests
class BlogController extends Controller
{
    // Method to display a paginated list of blog posts
    public function index()
    {
        // Retrieve all blog posts ordered by ID in descending order and paginate them (9 posts per page)
        $post_all = Post::orderBy('id', 'desc')->paginate(9);
        
        // Render the 'front.blog' view and pass the paginated list of posts to it
        return view('front.blog', compact('post_all'));
    }

    // Method to display a single blog post based on the given ID
    public function single_post($id)
    {
        // Retrieve the specific blog post based on the provided ID
        $single_post_data = Post::where('id', $id)->first();
        
        // Increment the total view count for the retrieved post
        $single_post_data->total_view += 1;
        
        // Update the post in the database with the new total view count
        $single_post_data->update();
        
        // Render the 'front.post' view and pass the single post data to it
        return view('front.post', compact('single_post_data'));
    }
}
