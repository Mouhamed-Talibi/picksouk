<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialsRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    // accept testimonal 
    public function accept(Testimonial $testimonial) {
        $testimonial->status = 'accepted';
        $testimonial->save();
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم قبول التقييم بنجاح.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialsRequest $request)
    {
        $validatedFields = $request->validated();
        // save testimonial
        Testimonial::create([
            'full_name' => $validatedFields['full_name'],
            'email' => $validatedFields['email'],
            'rating' => $validatedFields['rating'],
            'comment' => $validatedFields['comment'],
        ]);

        return back()
            ->with('success', 'تم إرسال تقييمك بنجاح. شكرًا لمشاركتك تجربتك معنا!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم حذف التقييم بنجاح.');
    }
}
