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

    public function create(Request $request)
    {
        $data = [];
        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['location'] = $request->input('location');

        $artworker = $this->artworker_repository->create($data);

        if (!$artworker) {
            \Session::flash('alert-error', 'Error while creating artworker '.$job->name);
            return redirect()->back()->withInput();
        }

        $destination_path = '/images/artworker/';
        $file_name = $artworker->id.'.jpg';
        if ($request->hasFile('profile_picture')) {
            $request->file('profile_picture')->move($destination_path, $file_name);
            $data['profile_picture'] = $destination_path.'_'.$file_name;
        }
        //please check again
        \Session::flash('alert-success', 'Artworker <b>' .$data['name']. '</b> has been created');
        return redirect()->to('/artworker');

    }

    public function view($id)
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}