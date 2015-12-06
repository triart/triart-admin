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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile_picture">Profile Picture
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                <input type="file" id="profile_picture" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="profile_picture"">
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
                                                <button type="submit" class="btn btn-primary">Cancel</button>
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


