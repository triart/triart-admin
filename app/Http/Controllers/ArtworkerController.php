<?php
namespace App\Http\Controllers;

use App\Modules\Artworker\ArtworkerRepository;
use Illuminate\Http\Request;

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

        $destination_path = public_path().'/images/artworker/';
        $file_name = $artworker->id.'.jpg';

        if ($request->hasFile('profile_picture')) {
            $request->file('profile_picture')->move($destination_path, $file_name);
            $data['profile_picture'] = $destination_path.$file_name;
        }

        \Session::flash('alert-success', 'Artworker '.$data['name']. ' has been created');
        return redirect()->to('/artworker');
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

        $destination_path = public_path().'/images/artworker/';
        $file_name = $artworker->id.'.jpg';

        if ($request->hasFile('profile_picture')) {
            $request->file('profile_picture')->move($destination_path, $file_name);
            $data['profile_picture'] = $destination_path . $file_name;
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

}