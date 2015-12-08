<?php
namespace App\Http\Controllers;

use App\Modules\Artworker\ArtworkerRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
        $this->deleteAvatar($artworker);

        if (!$this->artworker_repository->delete($artworker)) {
            \Session::flash('alert-error', 'Error while creating artworker '.$artworker->name);
            return redirect()->to('/artworker');
        }

        \Session::flash('alert-success', 'Artworker '.$artworker->name. ' has been deleted');

        return redirect()->to('/artworker');
    }

    public function uploadAvatar(Request $request, $id)
    {
        if (!$request->hasFile('avatar_file')) {
            return response()->setStatusCode(500);
        }

        $artworker = $this->artworker_repository->findById($id);
        $this->deleteAvatar($artworker);

        $artworker_image_path = '/images/artworker/';
        /**
         * Move to storage
         */
        $destination_path = public_path().$artworker_image_path;
        $file_name = $this->provideAvatarFilename($request, $artworker);
        $request->file('avatar_file')->move($destination_path, $file_name);

        /**
         * Update profile picture location to db
         * Provide full url location
         */
        $url = url().$artworker_image_path.$file_name;
        $data['profile_picture'] = $url;
        $this->artworker_repository->update($artworker, $data);

        return response()->json(['result' => $url, 'state' => 200])->setStatusCode(200);
    }

    protected function provideAvatarFilename(Request $request, $artworker)
    {
        $timestamp = Carbon::now()->timestamp;
        return $artworker->username.'_'.$timestamp.'.'.$request->file('avatar_file')->getClientOriginalExtension();
    }

    protected function deleteAvatar($artworker)
    {
        if (!empty($artworker->profile_picture)) {
            $file_location = parse_url($artworker->profile_picture, PHP_URL_PATH);
            File::delete(public_path().$file_location);
        }
    }

}