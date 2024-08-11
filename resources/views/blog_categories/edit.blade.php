@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit <small>Blog Category</small></h3>
                    </div>
                    <div class="card-body">
                    <form method="POST" class="needs-validation" novalidate
                        action="{{ route('blog_categories.blog_category.update',$blogCategory->id) }}" accept-charset="UTF-8"
                        id="create_blog_category_form" name="create_blog_category_form">
                        @csrf
                        @method('PUT')
                        @include ('blog_categories.form', [
                        'blogCategory' => $blogCategory,
                        ])

                        <div class="mb-3 row">
                            <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3"></label>
                            <div class="col-lg-10 col-xl-9">
                                <input style="margin-left: 12px;" class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection