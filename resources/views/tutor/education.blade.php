
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Education</h3>
                    </div>
                    @if(!empty($education))
                        <div class="card-body">
                            <div class="form-group">
                                <label >Highest education</label>
                                <input type="text" class="form-control"  disabled value="{{$education->highest_education}}">
                                
                            </div>
                            <div class="form-group">
                                <label >University</label>
                                <input type="text" class="form-control"  disabled value="{{$education->university}}">
                            </div>

                            <div class="form-group">
                                <label >Linkedin Url</label>
                                <input type="text" class="form-control"  disabled value="{{$education->linkedin_url}}">
                            </div>

                            <div class="form-group">
                                <label >What score did you get in your bachelor's or master's?</label>
                                <input type="text" class="form-control"  disabled value="{{$education->score}}">
                            </div>



                            <div class="form-group">
                                <label >How many years of experience do you have in academic writing? ( Experience is not compulsory if you have a good score. ) </label>
                                <input type="text" class="form-control"  disabled value="{{$education->years_of_experience}}">
                            </div>


                            <div class="form-group">
                                <label>How many tasks can you handle in a month? </label>
                                <input type="text" class="form-control"  disabled value="{{$education->tasks_can_handle_in_month}}">
                            </div>


                            <div class="form-group">
                                <label>What is your turnaround time for a 2000-word essay? </label>
                                <input type="text" class="form-control"  disabled value="{{$education->turnaround_time}}">
                            </div>


                            <div class="form-group">
                                <label>How much do you charge per 1000 words, or how much pay do you expect to get?  </label>
                                <input type="text" class="form-control"  disabled value="{{$education->charges}}">
                            </div>



                            <div class="form-group">
                                <label>Do you know how to write essays, reports, assignments, and dissertations in UK and US education system formats with proper formatting and referencing, such as Harvard, OSCOLA , APA, MLA, etc.?</label>
                                <input type="text" class="form-control"  disabled value="{{$education->know_how_to_write_essays}}">
                            </div>

                            <div class="form-group">
                                <label>Are you familiar with Plagiarism and AI policies and how to avoid them in your writing? </label>
                                <input type="text" class="form-control"  disabled value="{{$education->familiar_with_plagiarism}}">
                            </div>


                            <div class="form-group">
                                <label>Are you comfortable with tight deadlines? </label>
                                <input type="text" class="form-control"  disabled value="{{$education->comfortable_with_tight_deadlines}}">
                            </div>


                            <div class="form-group">
                                <label>Will you provide revisions if the client is not satisfied with the work or if changes are needed according to the tutor's comments? </label>
                                <input type="text" class="form-control"  disabled value="{{$education->provide_revisions}}">
                            </div>


                            <div class="form-group">
                                <label>We have a policy where we either refund the money or redo the work for free if the results are a failure, provided the customer submits proof of failure. Will you offer a refund or redo the work for free in such cases?  </label>
                                <input type="text" class="form-control"  disabled value="{{$education->offer_refund}}">
                            </div>



                            <div class="form-group">
                                <label >Year</label>
                                <input type="text" class="form-control" disabled value="{{$education->year}}">
                                
                            </div>
                            <div class="form-group">
                                <label>Proof</label>
                                <div style="min-height: 20px;">
                                @if(!empty($education->proof))
                                    <a href="<?= env('TUTOT_URL').$education->proof;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;color:blue;">
                                        <i class="nav-icon fas fa-file-download"><span class="nav-text"> </span></i> View</a>
                                @else
                                    <span>No attachment</span>
                                @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label>CV</label>
                                <div style="min-height: 20px;">
                                @if(!empty($education->cv_file))
                                    <a href="<?= env('TUTOT_URL').$education->cv_file;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;color:blue;"><i class="nav-icon fas fa-file-download"><span class="nav-text"> </span></i> View</a>
                                @else
                                    No attachment
                                @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Graduation degree and mark sheet</label> file
                                <div style="min-height: 20px;">
                                @if(!empty($education->graduation_degree))
                                    <a href="<?= env('TUTOT_URL').$education->graduation_degree;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;color:blue;"><i class="nav-icon fas fa-file-download"><span class="nav-text"> </span></i> View</a>
                                @else
                                    No attachment
                                @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label>samples of previous work</label>
                                <div style="min-height: 20px;">
                                @if(!empty($education->samples_of_previous_work))
                                    <a href="<?= env('TUTOT_URL').$education->samples_of_previous_work;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;color:blue;"><i class="nav-icon fas fa-file-download"><span class="nav-text"> </span></i> View</a>
                                @else
                                No attachment
                                @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Anything else</label>
                                <div>
                                <textarea disabled style="width: 100%;">{{$education->anything_else}}</textarea>
                                </div>
                            </div>







                            
                        </div>
                    @else
                        <div class="card-body">
                            <div class="alert alert-error">
                                No record found
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    