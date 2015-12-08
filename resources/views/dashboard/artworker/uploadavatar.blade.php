@extends('layouts.master')
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        Upload <small>Profile Picture </small>
                    </h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Click image to upload profile picture</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- content starts here -->

                            <div class="profile_img">
                                <!-- end of image cropping -->
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <div class="avatar-view center-block" title="Change the avatar">
                                        <img src="{{ url('images/picture.jpg') }}" alt="Avatar">
                                    </div>

                                    <!-- Cropping modal -->
                                    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="avatar-form" action="avatar/{{ $artworker_id }}" enctype="multipart/form-data" method="post">

                                                    <div class="modal-header">
                                                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                        <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="avatar-body">
                                                            <!-- Upload image and data -->
                                                            <div class="avatar-upload">
                                                                <input class="avatar-src" name="avatar_src" type="hidden">
                                                                <input class="avatar-data" name="avatar_data" type="hidden">
                                                                <label for="avatarInput">Local upload</label>
                                                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                                            </div>

                                                            <!-- Crop and preview -->
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="avatar-wrapper"></div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="avatar-preview preview-lg"></div>
                                                                    <div class="avatar-preview preview-md"></div>
                                                                    <div class="avatar-preview preview-sm"></div>
                                                                </div>
                                                            </div>

                                                            <div class="row avatar-btns">
                                                                <div class="col-md-9">
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                                                    </div>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="modal-footer">
                                      <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                    </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->

                                </div>
                                <!-- end of image cropping -->

                            </div>
                            <!-- content ends here -->

                             <br />
                            <center><a href="/artworker" class="btn btn-primary">Upload</a></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
        <!-- image cropping -->
    <script src="{{ url('js/cropping/cropper.min.js')}}"></script>
    <script src="{{ url('js/cropping/main.js')}}"></script>
@endsection