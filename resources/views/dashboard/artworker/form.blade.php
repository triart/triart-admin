  @extends('layouts.master')
  @section('content')
  <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                   Add Artworker
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Artworker Info</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php if(isset($artworker)): ?>
                                <div class="x_content">
                                    <div class="profile_img">
                                        <!-- end of image cropping -->
                                        <div id="crop-avatar">
                                            <!-- Current avatar -->
                                            <div class="avatar-view center-block" title="Change the avatar">
                                                @if(!empty($artworker->profile_picture))
                                                    <img src="{{ asset($artworker->profile_picture) }}" alt="Avatar">
                                                @else
                                                    <img src="{{ asset('images/profile_none.png') }}" alt="Avatar">
                                                @endif
                                            </div>

                                            <!-- Cropping modal -->
                                            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form class="avatar-form" action="{{ url('avatar', $artworker->id) }}" enctype="multipart/form-data" method="post">

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

                                </div>
                                    <div class="ln_solid"></div>
                                @endif


                                <div class="x_content">
                                    <form action="<?php echo (!isset($artworker) ? '/artworker' : '/artworker/'.$artworker->id) ?>"
                                          class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">

                                        {!! csrf_field() !!}

                                        <?php if(isset($artworker)): ?>
                                         <input type="hidden" name="_method" value="PUT">
                                        <?php endif ?>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="username" name="username" class="form-control col-md-7 col-xs-12" required="required"
                                                        value="<?php echo isset($artworker)? $artworker->username : \Input::old('username') ?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text"
                                                       value="<?php echo isset($artworker)? $artworker->name : \Input::old('name') ?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea style="text-align: left;" class="form-control" id="description" name="description"><?php echo isset($artworker)? trim($artworker->description) : \Input::old('description') ?></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="location" name="location" class="form-control col-md-7 col-xs-12"
                                                        value="<?php echo isset($artworker)? $artworker->location : \Input::old('location') ?>">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <a href="/artworker" class="btn btn-primary">Cancel</a>
                                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>

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
