@if(session()->has('status'))
    <section class="alertSection mt-3">
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <ul class="list-unstyled mb-0">
                    <li><em class="bi bi-check-circle fw-bold"></em> {{ session('status') }}</li>
                </ul>
            </div>
        </div>
    </section>
@endif


@if(count($errors))
    <section class="alertSection mt-3">
        <div class="container">
            <div class="alert alert-danger shadow">
                <ul class="list-unstyled mb-0">
                    @foreach($errors->all() as $error)
                        <li><em class="bi bi-exclamation-triangle fw-bold"></em> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endif

<style>
    .alertSection.hide {
        display: none;
    }
</style>

<script type="module">
    setTimeout(function () {
        // Adding the class dynamically
        $('.alertSection').addClass('hide');
    }, 10000);
</script>
