<?php

namespace App\Http\Controllers\Voyager;

use Brian2694\Toastr\Facades\Toastr;
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
        if ($inquiryData instanceof Inquiry) {
            toastr()->success(__('voyager::generic.successfully_added_new'));

            return redirect()->route('index');
        }
        toastr()->error('An error has occurred please try again later.');

        return back();

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
        $validatedData = $this->validator($request, $id);
        Inquiry::whereId($id)->update($validatedData);
        toastr()->success(__('voyager::generic.successfully_updated'));
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy ($id) {
        try {
            $inquiryData = Inquiry::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('Inquiry not found by ID ' . $id);
        }
        $inquiryData->delete();

        toastr()->success(__('voyager::generic.successfully_deleted'));
        return redirect()->route('index');
    }

    /** Multiple delete all records.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll (Request $request) {
        $ids = $request->ids;
        Inquiry::whereIn('id',explode(",",$ids))->delete();
        toastr()->success(__('voyager::generic.successfully_deleted'));
        return redirect()->route('index');
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
                Rule::unique('inquiry')->ignore($id, 'id'),
            ],
            'occupation' => ['required', 'string', 'max:50'],
            'inquiryFor' => ['required', 'string', 'max:100'],
        ]);
    }

}
