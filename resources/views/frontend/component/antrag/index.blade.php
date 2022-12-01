<section class="antrag" id="antrag">
    <div class="container">

        <div class="row">

            <form action="{{ route('frontend.antrag.store') }}" method="POST" id="antragForm" enctype="multipart/form-data">
                @csrf
                @include('helpers.component.tinymce')
                <div class="col-lg-12 text-bg-dark shadow" data-aos="fade-up" data-aos-delay="100">
                    @include('frontend.component.antrag.partials.formMitglied')
                </div>

                <div class="col-lg-12 text-bg-dark shadow mt-4" data-aos="fade-up" data-aos-delay="100">
                    @include('frontend.component.antrag.partials.formKontaktdaten')
                </div>

                <div class="col-lg-12 text-bg-dark shadow mt-4" data-aos="fade-up" data-aos-delay="100">
                    @include('frontend.component.antrag.partials.formAboutUs')
                </div>

                <div class="col-lg-12 text-bg-dark shadow mt-4" data-aos="fade-up" data-aos-delay="100">
                    @include('frontend.component.antrag.partials.formCarData')
                </div>

                <div class="col-lg-12 text-bg-dark shadow mt-4" data-aos="fade-up" data-aos-delay="100" id="showFahrzeugBilder">
                    @include('frontend.component.antrag.partials.formCarImages')
                </div>

                <div class="col-lg-12 text-bg-dark shadow mt-4">
                    <div class="d-flex justify-content-end px-4 py-3">
                        <button type="submit" class="btn btn-sm btn-primary fw-bold position-relative shadow">Antrag senden</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
