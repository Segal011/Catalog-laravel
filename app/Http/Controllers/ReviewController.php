<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;

class ReviewController extends Controller
{
    protected $reviews;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(review $reviews)
    {
        $this->reviews = $reviews;
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = $this->reviews->all();
        return view('review.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('review.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = array(
            'name'       => 'required',
            'body'      => 'required',
            'product_id'      => 'required',
            'email' => 'required|email'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $this->reviews->create($request->all());     
            Session::flash('message', 'Successfully created review!');
            return Redirect::back();
        }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->reviews->find($id)->delete();
        Session::flash('message', 'Successfully deleted the review!');
        return Redirect::to('reviews');
    }
}
