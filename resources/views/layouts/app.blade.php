<x-header />
<x-sidebar />
<div class="content-body">
    @if (session('role_error'))
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger" id="success_message">
                        {{ session('role_error') }}
                    </div>
                </div>
            </div>
        </div>

    </section>
    @endif
    @yield('content')
</div>

<x-footer />