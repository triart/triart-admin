<?php
namespace App\Http\Controllers;

use App\Modules\Artworker\ArtworkerRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArtworkerController extends Controller
{
    protected $artworker_repository;

    public function __construct(ArtworkerRepository $artworker_repository)
    {
        $this->artworker_repository = $artworker_repository;
    }

    public function index()
    {
        if (!\Input::has('search')) {
            $data['artworkers'] = $this->artworker_repository->getList(20);
            $data['artworker_title'] = 'Artworker List';
        } else {
            $data['artworker_title'] = 'Search Result';
            $data['artworkers'] = $this->artworker_repository->search(\Input::get('search'));
        }

        return view('dashboard.artworker.index', $data);
    }

    public function createForm()
    {
        return view('dashboard.artworker.form');
    }

    public function store(Request $request)
    {
        $data = [];
        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['description'] = trim($request->input('description'));
        $data['location'] = $request->input('location');
        $data['profile_picture'] = $request->input('profile_picture');

        $artworker = $this->artworker_repository->create($data);

        if (!$artworker) {
            \Session::flash('alert-error', 'Error while creating artworker '.$data['name']);
            return redirect()->to('/artworker')->withInput();
        }
        /**
        $destination_path = public_path().'/images/artworker/';
        $file_name = $artworker->id.'.jpg';

        if ($request->hasFile('profile_picture')) {
            $request->file('profile_picture')->move($destination_path, $file_name);
            $data['profile_picture'] = $destination_path.$file_name;
        }**/

        $data['artworker_id'] = $artworker->id;

        \Session::flash('alert-success', 'Artworker '.$data['name']. ' has been created');
        return view('dashboard.artworker.uploadavatar', $data);
    }

    public function view($id)
    {
        $data['artworker'] = $this->artworker_repository->findById($id);
        return \View::make('dashboard.artworker.form', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [];
        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['location'] = $request->input('location');
        $data['profile_picture'] = $request->input('profile_picture');

        $artworker = $this->artworker_repository->findById($id);
        $artworker = $this->artworker_repository->update($artworker, $data);

        if (!$artworker) {
            \Session::flash('alert-error', 'Error while creating artworker '.$data['name']);
            return redirect()->to('/artworker')->withInput();
        }

        \Session::flash('alert-success', 'Artworker '.$data['name']. ' has been updated');
        return redirect()->to('/artworker');
    }

    public function delete($id)
    {
        $artworker = $this->artworker_repository->findById($id);

        if (!$this->artworker_repository->delete($artworker)) {
            \Session::flash('alert-error', 'Error while creating artworker '.$artworker->name);
            return redirect()->to('/artworker');
        }

        \Session::flash('alert-success', 'Artworker '.$artworker->name. ' has been deleted');

        return redirect()->to('/artworker');
    }

    public function uploadAvatar(Request $request, $id)
    {
        $artworker = $this->artworker_repository->findById($id);
        $timestamp = Carbon::now()->timestamp;

        $destination_path = public_path().'/images/artworker/';

        if ($request->hasFile('avatar_file')) {
            $file_name = $artworker->username.'_'.$timestamp.'.'.$request->file('avatar_file')->getClientOriginalExtension();
            $request->file('avatar_file')->move($destination_path, $file_name);
            $data['profile_picture'] = $destination_path . $file_name;
            $this->artworker_repository->update($artworker, $data);
        }

        $url = url().'/images/artworker/'.$file_name;

        return response()->json(['result' => $url, 'state' => 200])->setStatusCode(200);
    }

}