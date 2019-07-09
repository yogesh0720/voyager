<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Exception\NotFoundException;
use stdClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TCG\Voyager\Facades\Voyager;
use App\Models\Inquiry;


/**
 * Class InquiryController
 * @package App\Http\Controllers\Voyager
 */
class InquiryController extends Controller {

    /**
     * InquiryController constructor.
     */
    public function __construct () {
        return $this->middleware('admin.user');
    }

    /**
     * @return mixed
     */
    public function index () {
        $inquiry = Inquiry::All();
        return Voyager::view('voyager::inquiry.browse', ['inquiry' => $inquiry]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create () {
        $inquiryData = new stdClass();
        $inquiryData->title = 'Inquiry';
        return Voyager::view('voyager::inquiry.add', compact('inquiryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store (Request $request) {
        $this->validator($request, '');
        $input = $request->all();
        $input['status'] = isset($input['status']) && $input['status'] == 'on' ? '1' : '0';

        $inquiryData = Inquiry::create($input);
        //var_dump($inquiryData);die;
        return redirect()->route('index')
            ->with('success', 'Saved successfully.');
        //return Voyager::view('voyager::inquiry.edit-add', compact('inquiryData'));
    }

    /**
     * Display the specified resource.
     *
     * @param Inquiry $inquiryData
     * @return Response
     */
    public function show ($id) {
        try {
            $inquiryData = Inquiry::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('Inquiry not found by ID ' . $id);
        }
        $inquiryData->title = 'Inquiry';
        return Voyager::view('voyager::inquiry.show', compact('inquiryData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit ($id) {
        try {
            $inquiryData = Inquiry::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('Inquiry not found by ID ' . $id);
        }
        $inquiryData->title = 'Inquiry';
        return Voyager::view('voyager::inquiry.edit', compact('inquiryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Inquiry $inquiryData
     * @param int $id
     * @return Response
     */
    public function update (Request $request, Inquiry $inquiryData, $id) {
        $this->validator($request, $id);
        $inquiryData->update($request->all());

        return redirect()->route('index')
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy (Request $request, Inquiry $inquiryData, $id) {
        $inquiryData->delete();

        return redirect()->route('index')
            ->with('success','Deleted successfully');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator (Request $request, $id) {
        return $request->validate([
            'firstName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'contactNo' => ['required', 'string', 'max:15'],
            'emailID' => ['required',
                Rule::unique('inquiry')->ignore($id,'id'),
            ],
            'occupation' => ['required', 'string', 'max:50'],
            'inquiryFor' => ['required', 'string', 'max:100'],
        ]);
    }

}
