<?php

namespace App\Http\Controllers;

use App\Slider;
use App\User;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where(['status' => 1])->get();
        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'path' => ['required']
        ]);

        try {
            $path = uploadCarouselFile($request->file('path'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        Slider::create([
            'path' => $path
        ]);

        return redirect()->back()->with('flash_message_success', "Image ajoutée avec succès!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders = Slider::where(['status' => 1])->get();
        $slider = Slider::find($id);
        return view('sliders.index', compact('slider', 'sliders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'path' => ['required']
        ]);

        $path = uploadCarouselFile($request->file('path'));

        $slider = Slider::find($id);

        $slider->path = $path;
        $slider->save();

        return redirect()->back()->with('flash_message_success', "Image mise à jour avec succès!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();

        return redirect(route('carousel.index'))->with('flash_message_success', "Image supprimée!");
    }
}
