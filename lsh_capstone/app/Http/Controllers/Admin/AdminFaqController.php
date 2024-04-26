<?php

namespace App\Http\Controllers\Admin; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Faq; // Import the Faq model class
use Illuminate\Http\Request; // Import the Request class

class AdminFaqController extends Controller
{
    // Method to handle viewing a list of all FAQs
    public function index()
    {
        // Retrieve all FAQs from the database
        $faqs = Faq::get();
        // Return a view with the list of FAQs
        return view('admin.faq_view', compact('faqs'));
    }

    // Method to handle displaying the form for adding a new FAQ
    public function add()
    {
        // Return a view for the add form
        return view('admin.faq_add');
    }

    // Method to handle the form submission and storing a new FAQ
    public function store(Request $request)
    {
        // Validate the incoming request data for the required question and answer fields
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        // Create a new FAQ instance and set its properties based on the request data
        $obj = new Faq();
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        // Save the new FAQ to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is added successfully!');
    }

    // Method to handle displaying the form for editing an existing FAQ
    public function edit($id)
    {
        // Retrieve the FAQ data based on the provided ID
        $faq_data = Faq::where('id', $id)->first();
        // Return a view with the FAQ data for the edit form
        return view('admin.faq_edit', compact('faq_data'));
    }

    // Method to handle the form submission and updating an existing FAQ
    public function update(Request $request, $id)
    {
        // Retrieve the existing FAQ based on the provided ID
        $obj = Faq::where('id', $id)->first();

        // Update the question and answer properties of the existing FAQ based on the request data
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        // Save the updated FAQ to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is updated successfully!');
    }

    // Method to handle deleting an existing FAQ
    public function delete($id)
    {
        // Retrieve the FAQ data based on the provided ID
        $single_data = Faq::where('id', $id)->first();
        // Delete the FAQ record from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is deleted successfully!');
    }
}
